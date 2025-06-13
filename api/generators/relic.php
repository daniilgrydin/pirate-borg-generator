<?php
header('Content-Type: application/json');
ini_set('display_errors', 0);
error_reporting(0);

// --- RELIC TABLE ---

$relics = [
    [
        "name" => "Cross of the Paragon",
        "effect" => "One ally gets +1 to attack and +1 to damage for d6 turns."
    ],
    [
        "name" => "Conch Shell from the Abyss",
        "effect" => "Ask a nearby corpse (or any creature that died at sea within 100 miles) one question."
    ],
    [
        "name" => "Map Inked in Ectoplasm",
        "effect" => "Learn the location of all traps and secret doors within 30' for d4+SPIRIT rounds."
    ],
    [
        "name" => "Will-o'-the-Wisp Lantern",
        "effect" => "Emit 15' of light or darkness for d6+SPIRIT rounds."
    ],
    [
        "name" => "Pages from the Necronomicon",
        "effect" => "All creatures that can hear your voice test DR14 or lose d4+SPIRIT HP (ignore armor)."
    ],
    [
        "name" => "Rune Encrusted Flintlock Pistol",
        "effect" => "One creature you see loses d6+SPIRIT HP (ignore armor). Takes 1 action to reload."
    ],
    [
        "name" => "Jade Die",
        "effect" => "Roll a die. Odd: you gain d8 temporary HP. Even: Choose a creature. It gets +d8 on its next damage roll."
    ],
    [
        "name" => "Undead Bird",
        "effect" => "It can speak with animals (dead or alive) for d6+SPIRIT rounds."
    ],
    [
        "name" => "Mermaid Scales",
        "effect" => "Eat a scale: breathe underwater for d4 hours."
    ],
    [
        "name" => "Charon's Obol",
        "effect" => "If you are killed, return to life the next round with 1 HP. Disappears after one use."
    ],
    [
        "name" => "Cup of the Carpenter",
        "effect" => "Choose a creature to regain d6+SPIRIT HP."
    ],
    [
        "name" => "Heart of the Sea",
        "effect" => "Create or destroy 15 gallons water or 30 square feet of fog."
    ],
    [
        "name" => "Necklace of Eyeballs",
        "effect" => "Become invisible for d6+SPIRIT rounds or until you attack or take damage. Attack and defend with DR6."
    ],
    [
        "name" => "Crown of the Sunken Lord",
        "effect" => "A water shield surrounds you. -d2 protection for d2+SPIRIT rounds (in addition to armor)."
    ],
    [
        "name" => "Crystalline Skull",
        "effect" => "The skull can hear & repeat the thoughts of a nearby creature for d6+SPIRIT minutes."
    ],
    [
        "name" => "Codex Tablet",
        "effect" => "Read and understand any language, glyphs, or runes for 1+SPIRIT rounds."
    ],
    [
        "name" => "Skeleton Key",
        "effect" => "Open any door or lock. Crumbles after 1 use."
    ],
    [
        "name" => "Mummified Monkey Head",
        "effect" => "The head speaks: 1 creature tests SPIRIT DR12 or must obey a 1 word command."
    ],
    [
        "name" => "Great Old One Figurine",
        "effect" => "One human is terrorized for d4 rounds unless they succeed a PRESENCE DR14 test. They can test each round."
    ],
    [
        "name" => "Broken Compass",
        "effect" => "The compass points in the direction of an object you know of for 1+SPIRIT rounds."
    ]
];

// --- OUTLINE ---

function relic_outline() {
    return [
        "categories" => [
            [
                "name" => "Relic",
                "fields" => [
                    ["key" => "name", "label" => "Name", "type" => "text"],
                    ["key" => "effect", "label" => "Effect", "type" => "text"]
                ]
            ]
        ]
    ];
}

function roll_die($sides) {
    return random_int(1, $sides);
}

function generateRelic() {
    global $relics;
    $relic = $relics[roll_die(count($relics)) - 1];
    return [
        "name" => $relic["name"],
        "effect" => $relic["effect"]
    ];
}

// --- OUTPUT ---

if (isset($_GET['outline'])) {
    echo json_encode(relic_outline());
    exit;
}

$outline = relic_outline();
$values = generateRelic();

foreach ($outline['categories'] as &$cat) {
    foreach ($cat['fields'] as &$field) {
        $key = $field['key'];
        $field['value'] = $values[$key] ?? '';
    }
}

echo json_encode($outline);