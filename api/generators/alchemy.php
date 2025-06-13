<?php
header('Content-Type: application/json');
ini_set('display_errors', 0);
error_reporting(0);

// --- DATA TABLES ---

$ingredient1 = [
    "Rum", "Sugar", "Tobacco", "Chicken Flesh", "Oxtail", "Candy", "Flour", "Sassafras Root", "Hyla Tree Frog", "Polychaete Worm",
    "Large Toad", "Pufferfish", "Psilocybin Mushroom", "Pig Blood", "Human Blood", "Whale Blubber", "Monkey Paw", "Chicken Head", 
    "Crocodile Tooth", "Human Remains"
];

$ingredient2 = [
    "Wild Flowers", "Ashes", "Black Powder", "Raisins", "Tree Bark", "Bone Powder", "Graveyard Dirt", "Jaguar Claw", "Bat Wing",
    "Cow's Tongue", "Crow's Foot", "Cacao Seeds", "Tamarind Leaves", "Castor Oil", "Maggots", "Bush Rat", "Kola Nut", "Coconut", 
    "Sage", "Banana Peel"
];

$colour = [
    "Black", "Blue", "Green", "Red", "Purple", "Yellow", "Orange", "White", "Metallic", "Clear", "Glows in the Dark", 
    "Pearlescent", "Iridescence", "Brown", "Gray", "Space-Like", "Pink", "Turquoise", "Opalescent", "Sanguine"
];

$delivery = [
    "Inhalation", "Inhalation", "Inhalation", "Inhalation", "Touch (Skin)", "Touch (Skin)", "Touch (Skin)", "Touch (Skin)", 
    "Touch (Skin)", "Touch (Skin)", "Enter Bloodstream", "Enter Bloodstream", "Enter Bloodstream", "Enter Bloodstream", 
    "Enter Bloodstream", "Ingestion", "Ingestion", "Ingestion", "Ingestion", "Ingestion"
];

$dr = [
    "DR8", "DR8", "DR8", "DR10", "DR10", "DR10", "DR12", "DR12", "DR12", "DR14", "DR14", "DR14", "DR16", "DR16", "DR16", 
    "DR18", "DR18", "DR18", "DR20", "DR20"
];

$effect = [
    "Instant, horrific death or after subject is killed, resurrect with 1 HP.",
    "Death in d6 hours.",
    "Paralysis (d8 hours).",
    "Subject becomes a ghost.",
    "d6 damage and blind for 1 hour.",
    "Berserk: Deal x2 melee damage, must attack closest creature. d6 rounds.",
    "Polymorph into a random beast (d12 hour).",
    "Polymorph into a random beast (permanent).",
    "Polymorph into a horrific monster (permanent).",
    "d8 acidic damage.",
    "Shrink to 1 foot tall (d8 rounds), Agility -4 DR.",
    "Grow to huge size (d8 rounds). x2 melee damage, Agility +2 DR.",
    "Heal d6.",
    "Heal d8.",
    "Heal to max HP.",
    "Strange hallucinations (d4 hours).",
    "Run away in terror (lasts d6 rounds).",
    "All tests are DR -4 for d8 hours.",
    "A random result from the Mystical Mishaps table (pg. 66).",
    "Roll again twice."
];

// --- OUTLINE ---

function potion_outline() {
    return [
        "categories" => [
            [
                "name" => "Potion",
                "fields" => [
                    ["key" => "ingredient1", "label" => "Ingredient 1", "type" => "text"],
                    ["key" => "ingredient2", "label" => "Ingredient 2", "type" => "text"],
                    ["key" => "colour", "label" => "Colour", "type" => "text"],
                    ["key" => "delivery", "label" => "Delivery Method", "type" => "text"],
                    ["key" => "dr", "label" => "DR", "type" => "text"],
                    ["key" => "effect", "label" => "Effect", "type" => "text"]
                ]
            ]
        ]
    ];
}

function roll_die($sides) {
    return random_int(1, $sides);
}

function generatePotion() {
    global $ingredient1, $ingredient2, $colour, $delivery, $dr, $effect;
    $idx = roll_die(count($ingredient1)) - 1;
    $idx2 = roll_die(count($ingredient2)) - 1;
    $idx3 = roll_die(count($colour)) - 1;
    $idx4 = roll_die(count($delivery)) - 1;
    $idx5 = roll_die(count($dr)) - 1;
    $idx6 = roll_die(count($effect)) - 1;
    return [
        "ingredient1" => $ingredient1[$idx],
        "ingredient2" => $ingredient2[$idx2],
        "colour" => $colour[$idx3],
        "delivery" => $delivery[$idx4],
        "dr" => $dr[$idx5],
        "effect" => $effect[$idx6]
    ];
}

// --- OUTPUT ---

if (isset($_GET['outline'])) {
    echo json_encode(potion_outline());
    exit;
}

$outline = potion_outline();
$values = generatePotion();

foreach ($outline['categories'] as &$cat) {
    foreach ($cat['fields'] as &$field) {
        $key = $field['key'];
        $field['value'] = $values[$key] ?? '';
    }
}

echo json_encode($outline);