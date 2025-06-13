<?php
header('Content-Type: application/json');
ini_set('display_errors', 0);
error_reporting(0);

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!is_array($data) || !isset($data['categories'])) {
    echo json_encode([
        'error' => 'Invalid input or not JSON',
        'raw' => $raw
    ]);
    exit;
}

$html = "";
$fieldKeys = [];

// Add reroll button at the top
$html .= "<button onclick='reroll()' class='reroll-btn'>Reroll</button>";

foreach ($data['categories'] as $catIndex => $category) {
    // Start category wrapper
    $catName = isset($category['name']) ? htmlspecialchars($category['name'], ENT_QUOTES) : '';
    $html .= "<div class='gen-category' data-cat-index='$catIndex'>";
    if ($catName) {
        $html .= "<legend>$catName</legend>";
    }

    // Add reroll category button
    $html .= "<button type='button' class='reroll-category-btn' onclick='rerollCategory($catIndex)'>Reroll Category</button>";

    foreach ($category['fields'] as $field) {
        $key = htmlspecialchars($field['key'], ENT_QUOTES);
        $label = htmlspecialchars($field['label'], ENT_QUOTES);
        $value = htmlspecialchars($field['value'] ?? '', ENT_QUOTES);
        $fieldKeys[] = $key;

        // Always use textarea
        $input_html = "<textarea id='{$key}-input' rows='1' oninput='autoGrow(this)'>{$field['value']}</textarea>";

        // Lock icon (default unlocked)
        $lock_html = "<span class='lock-icon' id='{$key}-lock' data-locked='0' onclick='toggleLock(\"$key\")' title='Lock/unlock'>🔓</span>";

        // Individual reroll button
        $reroll_html = "<span class='field-reroll' onclick='rerollField(\"$key\")' title='Reroll only this'>🔄</span>";

        $html .= "
        <label>
            <span class='field-label'>$label:</span>
            $input_html
            $lock_html
            $reroll_html
        </label>
        ";
    }

    // End category wrapper
    $html .= "</div>";
}

// Add reroll button at the bottom
$html .= "<button onclick='reroll()' class='reroll-btn'>Reroll</button>";
$html .= "<button id='copy-markdown-btn'>📄</button>";
$html .= "<button id='save-sheet-btn'>💾</button>"; // <-- Add Save button

$fieldList = json_encode($fieldKeys);

$js = <<<JS
window.reroll = async function() {
    // Use the active tab's data-url attribute for the generator endpoint
    let url = "api/generators/npc.php";
    const activeTab = document.querySelector('.tab-btn.active');
    if (activeTab && activeTab.dataset.url) {
        url = activeTab.dataset.url;
    }
    const params = new URLSearchParams();
    const fields = $fieldList;
    for (const key of fields) {
        const lockEl = document.getElementById(key + '-lock');
        const inputEl = document.getElementById(key + '-input');
        if (lockEl && inputEl && lockEl.dataset.locked === '1') {
            params.append(key, inputEl.value);
        }
    }
    const res = await fetch(url + '?' + params.toString());
    const newData = await res.json();
    // Update fields based on newData schema
    for (const cat of newData.categories) {
        for (const field of cat.fields) {
            const key = field.key;
            const lockEl = document.getElementById(key + '-lock');
            const inputEl = document.getElementById(key + '-input');
            if (inputEl && (!lockEl || lockEl.dataset.locked !== '1')) {
                if (inputEl.tagName === 'TEXTAREA') {
                    inputEl.value = field.value;
                    autoGrow(inputEl);
                } else {
                    inputEl.value = field.value;
                }
            }
        }
    }
}

// Toggle lock icon
window.toggleLock = function(key) {
    const lockEl = document.getElementById(key + '-lock');
    if (!lockEl) return;
    if (lockEl.dataset.locked === '1') {
        lockEl.dataset.locked = '0';
        lockEl.textContent = '🔓';
    } else {
        lockEl.dataset.locked = '1';
        lockEl.textContent = '🔒';
    }
}

// Individual field reroll
window.rerollField = async function(fieldKey) {
    let url = "api/generators/npc.php";
    const activeTab = document.querySelector('.tab-btn.active');
    if (activeTab && activeTab.dataset.url) {
        url = activeTab.dataset.url;
    }
    const params = new URLSearchParams();
    const fields = $fieldList;
    for (const key of fields) {
        const lockEl = document.getElementById(key + '-lock');
        const inputEl = document.getElementById(key + '-input');
        // Lock all except the one being rerolled
        if (key !== fieldKey && lockEl && inputEl) {
            params.append(key, inputEl.value);
        }
    }
    const res = await fetch(url + '?' + params.toString());
    const newData = await res.json();
    // Only update the rerolled field
    for (const cat of newData.categories) {
        for (const field of cat.fields) {
            if (field.key === fieldKey) {
                const inputEl = document.getElementById(fieldKey + '-input');
                if (inputEl) {
                    inputEl.value = field.value;
                    autoGrow(inputEl);
                }
            }
        }
    }
}

// Reroll entire category, ignoring locks
window.rerollCategory = async function(catIndex) {
    let url = "api/generators/npc.php";
    const activeTab = document.querySelector('.tab-btn.active');
    if (activeTab && activeTab.dataset.url) {
        url = activeTab.dataset.url;
    }
    // Gather locked fields from all categories except the one being rerolled
    const params = new URLSearchParams();
    const fields = $fieldList;
    // Find all fields in the selected category
    const catDivs = document.querySelectorAll('.gen-category');
    let catFields = [];
    if (catDivs[catIndex]) {
        catDivs[catIndex].querySelectorAll('textarea').forEach(textarea => {
            const id = textarea.id;
            if (id.endsWith('-input')) {
                catFields.push(id.replace(/-input$/, ''));
            }
        });
    }
    for (const key of fields) {
        // Only lock fields not in this category and that are locked
        if (!catFields.includes(key)) {
            const lockEl = document.getElementById(key + '-lock');
            const inputEl = document.getElementById(key + '-input');
            if (lockEl && inputEl && lockEl.dataset.locked === '1') {
                params.append(key, inputEl.value);
            }
        }
    }
    const res = await fetch(url + '?' + params.toString());
    const newData = await res.json();
    // Update only the fields in this category
    if (newData.categories && newData.categories[catIndex]) {
        for (const field of newData.categories[catIndex].fields) {
            const key = field.key;
            const inputEl = document.getElementById(key + '-input');
            if (inputEl) {
                inputEl.value = field.value;
                autoGrow(inputEl);
            }
        }
    }
}

// Function to convert an HTML table to Markdown
function tableToMarkdown(table) {
    let md = '';
    const rows = Array.from(table.rows);
    rows.forEach((row, i) => {
        const cells = Array.from(row.cells).map(cell => cell.innerText.trim());
        md += '| ' + cells.join(' | ') + ' |\\n';
        if (i === 0) {
            md += '| ' + cells.map(() => '---').join(' | ') + ' |\\n';
        }
    });
    return md;
}

document.getElementById('copy-markdown-btn').addEventListener('click', function() {
    const form = document.getElementById('generator-form');
    let md = '';
    // For each section
    form.querySelectorAll('.gen-category').forEach(section => {
        // Section header (if any)
        const legend = section.querySelector('legend');
        if (legend) {
            md += '### ' + legend.textContent.trim() + '\\n\\n';
        }
        // Gather all labels and values in this section
        const rows = [];
        section.querySelectorAll('label').forEach(label => {
            const fieldLabel = label.querySelector('.field-label');
            const textarea = label.querySelector('textarea');
            if (fieldLabel && textarea) {
                rows.push([fieldLabel.textContent.replace(/:$/, '').trim(), textarea.value.trim()]);
            }
        });
        if (rows.length) {
            // Markdown table header
            md += '| Field | Value |\\n| --- | --- |\\n';
            rows.forEach(([field, value]) => {
                // Escape pipes in value
                value = value.replace(/\\|/g, '\\\\|');
                md += '| ' + field + '|' + value + ' |\\n';
            });
            md += '\\n';
        }
    });
    navigator.clipboard.writeText(md).then(() => {
        alert('Sheet copied as Markdown!');
    });
});

// Save current sheet to localStorage
document.getElementById('save-sheet-btn').addEventListener('click', function() {
    const form = document.getElementById('generator-form');
    // Gather all fields and their values
    const data = { categories: [] };
    form.querySelectorAll('.gen-category').forEach((section, catIndex) => {
        const cat = { name: '', fields: [] };
        const legend = section.querySelector('legend');
        if (legend) cat.name = legend.textContent.trim();
        section.querySelectorAll('label').forEach(label => {
            const fieldLabel = label.querySelector('.field-label');
            const textarea = label.querySelector('textarea');
            if (fieldLabel && textarea) {
                cat.fields.push({
                    key: textarea.id.replace(/-input$/, ''),
                    label: fieldLabel.textContent.replace(/:$/, '').trim(),
                    value: textarea.value.trim()
                });
            }
        });
        data.categories.push(cat);
    });
    // Save type (from active tab)
    const activeTab = document.querySelector('.tab-btn.active');
    data._type = activeTab ? activeTab.textContent.trim() : '';
    data._url = activeTab ? activeTab.dataset.url : '';
    // Use first field value as preview
    let preview = '';
    if (data.categories.length && data.categories[0].fields.length) {
        preview = data.categories[0].fields[0].value || '';
    }
    data._preview = preview;
    // Load existing saves
    let saves = [];
    try { saves = JSON.parse(localStorage.getItem('pb_saves') || '[]'); } catch {}
    saves.push(data);
    localStorage.setItem('pb_saves', JSON.stringify(saves));
    if (window.updateSavedPanel) window.updateSavedPanel();
    alert('Sheet saved!');
});

// Auto-grow textarea
window.autoGrow = function(element) {
    element.style.height = 'auto';
    element.style.height = (element.scrollHeight) + 'px';
}

reroll();

JS;

echo json_encode([
    'html' => $html,
    'js' => $js
]);