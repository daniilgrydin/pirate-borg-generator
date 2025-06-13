<?php
header('Content-Type: application/json');
ini_set('display_errors', 0);
error_reporting(0);

// --- TABLES ---

$hook = [
    "Capture a prize.",
    "Raid a port.",
    "Treasure hunt.",
    "Find someone/something.",
    "Capture, interrogate, or kill someone.",
    "Establish a new safe house, base, or hideout.",
    "Sink a ship.",
    "Steal an item.",
    "Spy on someone.",
    "Scavenge a wreck.",
    "Explore or defend a location.",
    "Sneak into somewhere.",
    "Steal something.",
    "Meet someone.",
    "Establish trading or fencing relations with someone.",
    "Free or rescue a person or group from a location.",
    "Sabotage something.",
    "Defend a location.",
    "Free captives or prisoners.",
    "Escape."
];

$time_restraint = [
    "Immediately!",
    "Within the hour.",
    "By tonight.",
    "By tomorrow.",
    "Next week.",
    "This month."
];

$requirement = [
    "Stay out of combat.",
    "Kill only one person.",
    "Kill everyone.",
    "Make it look like someone else did it.",
    "Bring a hostage back alive.",
    "Vital information must be obtained."
];

$complication = [
    "It's a setup.",
    "The intel is wrong.",
    "Another crew is already on the job.",
    "Someone who's not supposed to be there is.",
    "The reward is suspiciously big.",
    "Everything is proceeding as planned."
];

$patron = [
    "A government leader.",
    "A famous pirate captain.",
    "The governor's daughter or son.",
    "The local drunk.",
    "A shady figure.",
    "Some cultists.",
    "An old friend.",
    "Important looking pirates.",
    "A love interest.",
    "A mermaid."
];

$rumor = [
    "A nation's navy is coming in [3d6] days. Everyone is on edge.",
    "A rich group of merchants are hiring mercenaries to escort them.",
    "A treasure fleet is rumored to be departing soon.",
    "An important NPC is recruiting people to explore or scout an area.",
    "A group of leaders is meeting soon. The PCs have been summoned.",
    "Someone the PCs know has been killed or captured.",
    "[2d12] pirates are in town spending the earnings from their latest prize.",
    "Pirates, marines, or revolutionaries are planning to raid a port.",
    "There are rumors of a rich prize nearby. Crews are recruiting.",
    "Someone uncovered a clue or map to a fabled treasure and need brains, muscle, or both.",
    "A corpse has been found in an alley or on the beach. Everyone is suspicious.",
    "A ship with valuable cargo wrecked nearby.",
    "A lonely widow ([20+d50] years old) is looking for a date to the Governor's Ball.",
    "It is not safe here at night. The reasons given sound like tall tales or ghost stories.",
    "A recent fire destroyed a ship, a port, or a farmstead.",
    "Two allied factions are now at war.",
    "There is a party tonight to honor a deceased NPC.",
    "The governor's adult daughter/son is the most beautiful person ever seen.",
    "A group of cultists have been up to some unusual activity recently.",
    "Undead have destroyed yet another settlement."
];

// --- OUTLINE ---

function job_outline() {
    return [
        "categories" => [
            [
                "name" => "Job or Quest",
                "fields" => [
                    ["key" => "hook", "label" => "Hook", "type" => "text"],
                    ["key" => "time_restraint", "label" => "Time Restraint", "type" => "text"],
                    ["key" => "requirement", "label" => "Requirement", "type" => "text"],
                    ["key" => "complication", "label" => "Complication", "type" => "text"],
                    ["key" => "patron", "label" => "Patron or Key NPC", "type" => "text"],
                    ["key" => "rumor", "label" => "Rumor", "type" => "text"]
                ]
            ]
        ]
    ];
}

function roll_die($sides) {
    return random_int(1, $sides);
}

function roll_dice($notation) {
    // Supports d6, d8, 2d6, 3d6, d8x10, d50, etc.
    if (preg_match('/(\d*)d(\d+)(\s*x\s*(\d+))?/i', $notation, $m)) {
        $num = $m[1] ? intval($m[1]) : 1;
        $sides = intval($m[2]);
        $mult = isset($m[4]) ? intval($m[4]) : 1;
        $total = 0;
        for ($i = 0; $i < $num; $i++) {
            $total += roll_die($sides);
        }
        return $total * $mult;
    } elseif (preg_match('/(\d+)\s*\+\s*d(\d+)/i', $notation, $m)) {
        // e.g. 20+d50
        $base = intval($m[1]);
        $sides = intval($m[2]);
        return $base + roll_die($sides);
    }
    return $notation;
}

function generateJob() {
    global $hook, $time_restraint, $requirement, $complication, $patron, $rumor;

    $rumor_template = $rumor[roll_die(count($rumor)) - 1];
    // Replace dice notation in rumor
    $rumor_filled = $rumor_template;
    if (strpos($rumor_filled, '[3d6]') !== false) {
        $rumor_filled = str_replace('[3d6]', roll_dice('3d6'), $rumor_filled);
    }
    if (strpos($rumor_filled, '[2d12]') !== false) {
        $rumor_filled = str_replace('[2d12]', roll_dice('2d12'), $rumor_filled);
    }
    if (strpos($rumor_filled, '[20+d50]') !== false) {
        $rumor_filled = str_replace('[20+d50]', roll_dice('20+d50'), $rumor_filled);
    }

    return [
        "hook" => $hook[roll_die(count($hook)) - 1],
        "time_restraint" => $time_restraint[roll_die(count($time_restraint)) - 1],
        "requirement" => $requirement[roll_die(count($requirement)) - 1],
        "complication" => $complication[roll_die(count($complication)) - 1],
        "patron" => $patron[roll_die(count($patron)) - 1],
        "rumor" => $rumor_filled
    ];
}

// --- OUTPUT ---

if (isset($_GET['outline'])) {
    echo json_encode(job_outline());
    exit;
}

$outline = job_outline();
$values = generateJob();

foreach ($outline['categories'] as &$cat) {
    foreach ($cat['fields'] as &$field) {
        $key = $field['key'];
        $field['value'] = $values[$key] ?? '';
    }
}

echo json_encode($outline);