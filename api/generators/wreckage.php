<?php
header('Content-Type: application/json');
ini_set('display_errors', 0);
error_reporting(0);

// --- DATA TABLES ---

$locations = [
    "Shallow waters (submerged at high tide)",
    "Suspended on shoals (half underwater)",
    "Beach wrecked",
    "Adrift at sea",
    "Anchored off the coast",
    "Suspended on rocks or a coastal cliff",
    "Up a dried-up riverbed",
    "In the middle of the jungle, forest, or desert",
    "Drifting into port",
    "Orbiting a maelstrom",
    "Floating the waters that lead to the underworld",
    "In the nightmares of cursed sailors"
];

$ship_types = [
    "Several ships fastened together (roll d2 more times)",
    "Sloop",
    "Tartane",
    "Giant jury-rigged raft",
    "Brigantine",
    "Frigate",
    "Ancient vessel",
    "Galleon",
    "Fluyt",
    "Man-of-war",
    "Ship of the line",
    "Otherworldly"
];

$what_happened = [
    "Demolished during a storm or hurricane",
    "Abandoned for an unknown reason, mostly intact",
    "Ripped in two by a monster from the deep",
    "Run aground or scrapped some shoals",
    "Raided by blood-thirsty undead",
    "Destroyed in naval combat",
    "Wrecked in foggy conditions",
    "Mutiny fueled blood bath"
];

$room_features = [
    "Filled with large eggs",
    "Bodies of former crew, freshly dead, terror on their faces",
    "Indecipherable glyphs carved into the wood beams",
    "Water damaged books and letters",
    "Hundreds of eyeballs hanging from strings",
    "A gaping hole in the hull",
    "Rotting food and animal corpses",
    "Glass bottles filled with: " . ["rum", "potions (pg. 70)", "fortified wine", "blood", "holy water", "excrement (human?)"][random_int(0,5)]
];

$current_occupants = [
    "Ghosts of dead sailors. Their speech sounds like whale song.",
    "Poisonous necro-plague rats, their mother the size of a wolf.",
    "Dormant zombies waiting for fresh brains, their smell detectable for miles.",
    "A starving crew of pirate-turned-cannibals, some with freshly missing limbs.",
    "Skeleton marauders celebrating a recent raid. The captain is an asshole.",
    "Cultists, chanting, summoning Great Old Ones via human sacrifice.",
    "3 beautiful sirens. They lust for pearls and have a hoard hidden nearby.",
    "A tribe of intelligent goblin-like monkeys. They love shiny things and rum.",
    "A necromancer living in exile with a pet undead jaguar or shark.",
    "Deep Ones, lead by a shaman, scouting for valuables. Her magic requires water.",
    "Hundreds of carrion gulls, feasting on a corpse hanging from a mast.",
    "Dozens of blood drained corpses. A weakened vampire hides below deck."
];

$odd_features = [
    "Walls and floor covered in coral and barnacles",
    "Piles of bleached white bones throughout",
    "Hundreds of small crabs nests",
    "Cargo hold is filled with 6\" of blood",
    "Charred wood and fire damage",
    "Faintly glows in the dark",
    "Mysterious slime covers most surfaces",
    "Ornately decorated in gold leaf and velvet",
    "A thick layer of ash coats everything",
    "Gravity behaves as if underwater",
    "Signs of torture, sacrifice, and blood-letting",
    "Bioluminescent plants bloom from hull at night"
];

$original_cargo = [
    "Tea leaves or spices",
    "Art or antiques",
    "Coffee beans",
    "Sugar or sugar cane",
    "Rum or wine",
    "Weapons and ammo",
    "Tobacco or cocoa",
    "Exotic creatures",
    "Rice or crops",
    "Black powder [d100 barrels]",
    "Contraband",
    "Textiles",
    "Sacrificial victims",
    "Prisoners",
    "Lumber",
    "Livestock",
    "A large statue",
    "Hoards of treasure",
    "Native medicine",
    "A cursed relic"
];

$developments = [
    "Sails! Ship spotted.",
    "Derelict starts to sink or collapse.",
    "Adversaries arrive: other pirates, monsters, the military.",
    "Explosion or fire.",
    "Extreme weather.",
    "Thing from the deep complicates things.",
    "Undead floating nearby.",
    "A stowaway emerges."
];

$cargo_condition = [
    "Missing or ruined",
    "Salvageable (x1/2)",
    "Salvageable (x1/2)",
    "Good (x1)",
    "Good (x1)",
    "Rare and valuable (x2)"
];

// --- OUTLINE ---

function derelict_ship_outline() {
    return [
        "categories" => [
            [
                "name" => "Derelict Ship",
                "fields" => [
                    ["key" => "location", "label" => "Where is it?", "type" => "text"],
                    ["key" => "ship_type", "label" => "Type of Ship", "type" => "text"],
                    ["key" => "what_happened", "label" => "What happened here?", "type" => "text"],
                    ["key" => "room_feature", "label" => "In one of the rooms", "type" => "text"],
                    ["key" => "current_occupant", "label" => "Current Occupant", "type" => "text"],
                    ["key" => "odd_feature", "label" => "Odd Feature", "type" => "text"],
                    ["key" => "original_cargo", "label" => "Original Cargo", "type" => "text"],
                    ["key" => "development", "label" => "Development", "type" => "text"],
                    ["key" => "cargo_condition", "label" => "Cargo Condition", "type" => "text"]
                ]
            ]
        ]
    ];
}

function roll_die($sides) {
    return random_int(1, $sides);
}

function generateDerelictShip() {
    global $locations, $ship_types, $what_happened, $room_features, $current_occupants, $odd_features, $original_cargo, $developments, $cargo_condition;
    return [
        "location" => $locations[roll_die(count($locations)) - 1],
        "ship_type" => $ship_types[roll_die(count($ship_types)) - 1],
        "what_happened" => $what_happened[roll_die(count($what_happened)) - 1],
        "room_feature" => $room_features[roll_die(count($room_features)) - 1],
        "current_occupant" => $current_occupants[roll_die(count($current_occupants)) - 1],
        "odd_feature" => $odd_features[roll_die(count($odd_features)) - 1],
        "original_cargo" => $original_cargo[roll_die(count($original_cargo)) - 1],
        "development" => $developments[roll_die(count($developments)) - 1],
        "cargo_condition" => $cargo_condition[roll_die(count($cargo_condition)) - 1]
    ];
}

// --- OUTPUT ---

if (isset($_GET['outline'])) {
    echo json_encode(derelict_ship_outline());
    exit;
}

$outline = derelict_ship_outline();
$values = generateDerelictShip();

foreach ($outline['categories'] as &$cat) {
    foreach ($cat['fields'] as &$field) {
        $key = $field['key'];
        $field['value'] = $values[$key] ?? '';
    }
}

echo json_encode($outline);