<?php
header('Content-Type: application/json');
ini_set('display_errors', 0);
error_reporting(0);

// --- DATA TABLES ---

$male_names = [
    "Esteban",
    "Richard",
    "Hendrik",
    "Raymond",
    "John",
    "Edmund",
    "Charles",
    "Peter",
    "Olivier",
    "Barth",
    "Henry",
    "Roger",
    "Don",
    "Martín",
    "Louis",
    "Fredrick",
    "Willem",
    "Nicholas",
    "Jerry",
    "Edward",
    "Alvaro",
    "Gaspar",
    "Francisco",
    "Johan",
    "Carlos",
    "Francis",
    "Jacques",
    "Jack",
    "François",
    "Silas",
    "Thomas",
    "Jacob",
    "Juan",
    "Philippe",
    "Jean",
    "William",
    "Billy"
];
$female_names = [
    "Bridget",
    "Juliette",
    "Esther",
    "Rose",
    "Beatrice",
    "Olive",
    "Antonia",
    "Charlotte",
    "Isabel",
    "Adine",
    "Angela",
    "Cécile",
    "Edwidge",
    "Catalina",
    "Elizabeth",
    "Madeleine",
    "Anastasia",
    "Emma",
    "Mary",
    "Francisca",
    "Ana",
    "Agnes",
    "Marie",
    "Eleanor",
    "Anne",
    "Henrietta",
    "Alice",
    "Margaret",
    "Jeannette",
    "Camela",
    "Catherine",
    "Ursula",
    "Annette",
    "Gabriel",
    "Esme",
    "Marion"
];
$surnames = [
    "Pérez",
    "Thompson",
    "Jansen",
    "Williams",
    "Alva",
    "Dubois",
    "Leon",
    "Brown",
    "Jones",
    "Johnson",
    "Thatch",
    "Davies",
    "Archer",
    "Blanc",
    "Evans",
    "Wright",
    "Smith",
    "Wilson",
    "Bernard",
    "Roberts",
    "White",
    "Jean",
    "Santiago",
    "Morel",
    "Rodríguez",
    "Garcia",
    "Robinson",
    "López",
    "Baker",
    "Black",
    "Bonnet",
    "Walker",
    "Martin",
    "Jackson",
    "Diaz",
    "Taylor"
];
$nicknames = [
    "Sir/Madam",
    "Sea",
    "Turtle",
    "Siren",
    "Red",
    "One-Eye",
    "One-Arm",
    "One-Leg",
    "Crimson",
    "Blue",
    "Water",
    "Skull",
    "Tall-Tale",
    "Old",
    "Blood",
    "Mr/Mrs/Miss",
    "Gunpowder",
    "King/Queen",
    "Bow-legged",
    "Fish",
    "Whale",
    "Bones",
    "Squid",
    "Scurvy",
    "Bilge",
    "Shark",
    "Heart",
    "The Bride",
    "The Groom",
    "Black",
    "White",
    "Death",
    "Dark",
    "Devil",
    "Knife",
    "Claw",
    "Rat",
    "Green",
    "Planktooth"
];
$classes = [
    "Brute",
    "Rapscallion",
    "Buccaneer",
    "Swashbuckler",
    "Zealot",
    "Sorcerer"
];
$class_mods = [
    "Brute" => ["Strength" => +1, "Toughness" => +1, "Presence" => -1, "Spirit" => -1],
    "Rapscallion" => ["Agility" => +2, "Strength" => -1, "Toughness" => -1],
    "Buccaneer" => ["Presence" => +2, "Agility" => -1, "Spirit" => -1],
    "Swashbuckler" => ["Strength" => +1, "Agility" => +1, "Presence" => -1, "Spirit" => -1],
    "Zealot" => ["Spirit" => +2, "Agility" => -1, "Toughness" => -1],
    "Sorcerer" => ["Spirit" => +2, "Strength" => -1, "Toughness" => -1],
];
$motivations = [
    "Escape",
    "Happiness",
    "Recovery",
    "Pleasure",
    "Exploration",
    "Love/Sex",
    "Revenge",
    "Fear",
    "Wealth",
    "Hunger",
    "Reputation",
    "Aggression",
    "Adventure",
    "Guilt",
    "Leisure",
    "Protection",
    "Intoxication",
    "Family",
    "Religion",
    "Occult"
];
$body_types = ["Gaunt", "Corpulent", "Wiry", "Muscular", "Frail", "Average"];
$accents = ["American", "French", "Italian", "Russian", "Scottish", "German"];
$trademarks = [
    "Part skeleton",
    "Missing eye",
    "Matted hair",
    "Pegleg",
    "Hook hand",
    "Missing ear",
    "Many tattoos",
    "Never blinks",
    "Rotten teeth",
    "Twitchy",
    "Scurvy",
    "Infested with bugs",
    "Scarred",
    "Hideously ugly",
    "Corpulent",
    "Gangrenous",
    "Putrid stench",
    "Contagious",
    "Gaunt & frail",
    "So good looking people are jealous"
];
$idiosyncrasies = [
    "Smokes constantly",
    "Always drunk",
    "Bets on everything",
    "Counting things",
    "Eats rats",
    "Knows every tall tale",
    "Afraid of prime numbers",
    "Murderous when hungry",
    "Procrastinator",
    "Never sleeps",
    "Shoots first",
    "Annoyingly religious",
    "Collects odd things",
    "Prankster",
    "Kleptomaniac",
    "Talks to self",
    "Likes taste of human flesh",
    "Always 'knows the way' (but gets lost)",
    "Blames others",
    "Obsessive"
];
$incidents = [
    "Family burned alive",
    "Known pirate, wanted",
    "Betrayed crew, hunted",
    "Marooned, hears voices",
    "Stole a ship",
    "Escaped captivity",
    "Enemy relative",
    "Last 3 ships sank",
    "Crew killed by undead",
    "Loved ones held hostage",
    "Possessed by spirit",
    "Wronged pirate lord",
    "Escaped cannibals",
    "Slaughtered innocents",
    "Lone survivor of expedition",
    "Mutineer (failed/successful)",
    "Haunted by ghost",
    "Deserted military",
    "No memory before a few days ago",
    "Died once already"
];
// Example loot table (shortened for brevity)
$loot = [
    "Ancient Relic",
    "Skull with glowing green sockets",
    "Nasty-looking knife (d6)",
    "Wanted poster (PC’s face)",
    "Black candle, purple skull flame",
    "Golden manacle, 5 links",
    "Leather journal, 1 sea shanty",
    "Oil lantern, burns green, never runs out",
    "Fine metal flask",
    "Bag of white powder",
    "Box with d12 black pearls (fortune)",
    "Glass dagger (3d4, breaks after 1 use)",
    "Deck of mermaid playing cards",
    "Parrot feather (+1 Devil’s Luck each dawn)",
    "Rotten dried fruit",
    "Treasure map",
    "Dead rat",
    "Jewel encrusted egg (Agility DR18 to open, worth 500s)",
    "Stone ring with engraved rune",
    "Obsidian figurine of a Kraken"
];
$things_of_importance = [
    "animal pelt",
    "oyster pearl",
    "silver locket",
    "conch shell",
    "pipe carved from wood",
    "pipe carved from bone",
    "small jade figurine",
    "ancient gold coin",
    "ruined piece of a treasure map",
    "map of an unknown place",
    "diary written by an ancestor",
    "silver ring",
    "ivory chess piece",
    "sea creature carved from obsidian",
    "spherical prism",
    "jar containing a severed hand",
    "necklace of bones & feathers",
    "book of scripture",
    "novel you loved as a child",
    "bizarre silk handkerchief",
    "pouch containing animal teeth",
    "old fillet knife",
    "fossil of an extinct fish",
    "piece of colorful coral",
    "small ship in a bottle",
    "letter from a loved one",
    "the journal of a dead explorer",
    "stone embossed with a mermaid",
    "vial of holy water from clergy in your hometown",
    "the remains of a small squid in a jar",
    "precious cooking salts in a tiny chest",
    "tankard made from a horn",
    "jar of the finest tobacco",
    "golden letter opener",
    "small, cast bronze owl figurine",
    "collection of sea shells and rocks",
    "necklace carved from jade",
    "a recently deceased relative's will naming you as the sole heir",
    "drawing of a loved one",
    "bag of “magical” white powder",
    "old rusted key with a blue gem that glows in the moonlight",
    "compass that doesn't point north",
    "clay jar you are using as an urn",
    "definitive proof of an enemy's (or loved one's) crime",
    "small golden bell",
    "old bottle of red wine (Bordeaux, incredible vintage)",
    "jar of dried jellyfish dust",
    "multi-colored feather",
    "necklace from a loved one",
    "ring that doesn't fit on your fingers",
    "single diamond earring",
    "finely made leather eye patch",
    "set of gardening tools",
    "dried flower",
    "animal skull",
    "human skull",
    "gem that glows in seawater",
    "dinosaur or monster bone or claw",
    "jar of fireflies",
    "leather-bound tome in a language you don't recognize",
    "blueprints to a new type of ship",
    "carved arrowhead",
    "stone tablet inscribed with ancient pictographs or hieroglyphs",
    "perfect cube made of crystal",
    "tattoo (love, revenge, ancestors, unknown origin)",
    "bottle of perfumed oil",
    "broken set of manacles",
    "broken compass",
    "pistol with one shot meant for someone special",
    "flag of personal significance",
    "broken spyglass with a scroll or map hidden inside",
    "length of rope you made",
    "carved gaming pieces",
    "set of rune stones",
    "twig from a very old tree",
    "noose taken from a corpse",
    "6' length of chain",
    "4d10 scars from lashes on your back",
    "long scar on your face",
    "two coconut shells",
    "dark robe, cape, or cloak",
    "cask of strong sassafras beer",
    "set of keys on a large key ring",
    "small keg of something valuable (rum, powder, ashes, ASH)",
    "magnifying lens (glass only)",
    "cork from a bottle, from a special occasion",
    "cannonball",
    "deck of cards with 1d4 cards missing and 1d6 “extra\" cards",
    "garment from someone special",
    "wanted poster (legend, enemy, loved one, stranger)",
    "fancy wig",
    "letter of political importance",
    "tanned whale skin or jar of blubber",
    "petrified egg",
    "monkey paw extending 1 finger",
    "memorized poem that sounds like a map",
    "medallion that might be the top of a staff",
    "talisman shaped like a snake",
    "glass vial of dark blood",
    "shard of crystal"
];
$distinctive_flaws = [
    "Drunken lush",
    "Stubborn",
    "Mocking sardonic cheer",
    "Way too loud",
    "Stupid",
    "Coward",
    "Cocky",
    "Slightly deranged",
    "Aggressive",
    "Anxious",
    "Cheater",
    "Selfish",
    "Lazy",
    "Hedonistic",
    "Impulsive",
    "Ostentatious",
    "Paranoid",
    "Pretentious",
    "Sadistic",
    "Disloyal"
];
$weapons = [
    "Marlinspike or Belaying Pin [d4]",
    "Knife or Bayonet [d4]",
    "Smallsword or Machete [d4]",
    "Cat O' Nine Tails [d4, 10' reach]",
    "Boarding Axe [d6]",
    "Cutlass [d6]",
    "Flintlock Pistol [2d4, reload 2 actions, range 30', ammo: 10 + Presence rounds of shot]",
    "Finely Crafted Rapier [d8]",
    "Boarding Pike [d10, 10' reach]",
    "Musket [2d6, reload 2 actions, range 150', ammo: 10 + Presence rounds of shot]"
];
$clothing = [
    "Rags (tier 0)",
    "Rags (tier 0)",
    "Common clothes (2s, tier 0)",
    "Common clothes (2s, tier 0)",
    "Old uniform (8s, tier 0)",
    "Fancy clothes (250s, tier 0, you look amazing)",
    "Leather armor (20s, tier 1, -d2 dmg)",
    "Hide armor (25s, tier 1, -d2 dmg)",
    "Chain shirt (100s, tier 2, -d4 dmg, DR+2 AGI)",
    "Conquistador plate (200s, tier 3, -d6 dmg, DR+4 AGI, sink risk)"
];
$hats = [
    "None",
    "None",
    "None",
    "None",
    "Wig (8s)",
    "Bandanna (2s)",
    "Cavalier (15s)",
    "Bicorne (15s)",
    "Plain tricorne (10s)",
    "Fancy tricorne (90s)",
    "Metal lined hat (20s, -1 dmg, breaks to ignore all dmg once)",
    "Morion (90s, -1 dmg, breaks to ignore all dmg once)"
];
$gear = [
    "Backpack (6s)", "Bandolier (4s)", "Blanket & pillow (5s)", "Bucket (3s)", "Candle (1s, 1hr)",
    "Cannon ball (3s)", "Compass (75s)", "Dinghy (250s)", "Dried food (1s, 1 day)", "Fishing rod (25s)",
    "Flask (2s)", "Flint and steel (3s)", "Hammer (8s)", "Ink, quill, parchment (20s)", "Lantern (10s)",
    "Lantern oil (5s, d6hr)", "Livestock (20–200s)", "Lock picks (5s)", "Longboat (500s)", "Manacles (10s)",
    "Medical kit (15s, heals d6 HP, 4 uses)", "Mess kit (8s)", "Metal file (10s)", "Mirror (15s)",
    "Musical instrument (250s+)", "Pegleg (15s)", "Pocket watch (45s)", "Rope (30', 4s)", "Satchel (5s)",
    "Sea chest, large (50s)", "Sea chest, small (20s)", "Shovel (5s)", "Smoking pipe (10s)", "Speaking trumpet (30s)",
    "Spyglass (150s)", "Tankard (2s)", "Tattoo (10–150s)", "Tent (25s)", "Tobacco (10s, d6 uses)",
    "Torch (2s, 1hr)", "Water skin (2s)", "Whetstone (5s)"
];
// --- OUTLINE ---

function npc_outline()
{
    return [
        "categories" => [
            [
                "name" => "Personal",
                "fields" => [
                    ["key" => "name", "label" => "Name", "type" => "text"],
                    ["key" => "age", "label" => "Age", "type" => "number"],
                    ["key" => "motivation", "label" => "Motivation", "type" => "text"],
                    ["key" => "body_type", "label" => "Body Type", "type" => "text"],
                    ["key" => "accent", "label" => "Accent", "type" => "text"],
                    ["key" => "trademark", "label" => "Physical Trademark", "type" => "text"],
                    ["key" => "idiosyncrasy", "label" => "Idiosyncrasy", "type" => "text"],
                    ["key" => "incident", "label" => "Notable Incident", "type" => "text"],
                    ["key" => "distinctive_flaw", "label" => "Distinctive Flaw", "type" => "text"]
                ]
            ],
            [
                "name" => "Stats",
                "fields" => [
                    ["key" => "class", "label" => "Class/Archetype", "type" => "text"],
                    ["key" => "strength", "label" => "Strength", "type" => "number"],
                    ["key" => "agility", "label" => "Agility", "type" => "number"],
                    ["key" => "presence", "label" => "Presence", "type" => "number"],
                    ["key" => "toughness", "label" => "Toughness", "type" => "number"],
                    ["key" => "spirit", "label" => "Spirit", "type" => "number"],
                    ["key" => "hp", "label" => "HP", "type" => "number"],
                    ["key" => "carrying_capacity", "label" => "Carrying Capacity", "type" => "number"],
                ]
            ],
            [
                "name" => "Possessions",
                "fields" => [
                    ["key" => "weapon", "label" => "Weapon", "type" => "text"],
                    ["key" => "loot", "label" => "Loot", "type" => "text"],
                    ["key" => "thing_of_importance", "label" => "Thing of Importance", "type" => "text"],
                    ["key" => "clothing", "label" => "Clothing/Armor", "type" => "text"],
                    ["key" => "hat", "label" => "Hat", "type" => "text"],
                    ["key" => "gear", "label" => "Gear", "type" => "text"]
                ]
            ]
        ]
    ];
}


// --- GENERATOR ---
function roll_clothing($class) {
    // All classes except landlubber roll d10 for clothing
    return $GLOBALS['clothing'][roll_die(10) - 1];
}
function roll_hat($class) {
    // All classes except landlubber roll d12 for hat
    return $GLOBALS['hats'][roll_die(12) - 1];
}
function roll_gear($count) {
    $gear = $GLOBALS['gear'];
    $items = [];
    $used = [];
    $count = roll_die($count)-1;
    for ($i = 0; $i < $count; $i++) {
        do {
            $idx = random_int(0, count($gear) - 1);
        } while (in_array($idx, $used));
        $used[] = $idx;
        $items[] = $gear[$idx];
    }
    return $items;
}
function random_name()
{
    global $male_names, $female_names, $surnames, $nicknames;
    $name_index = random_int(0, count($male_names) - 1);
    $surname = $surnames[random_int(0, count($surnames) - 1)];
    $nickname1 = $nicknames[random_int(0, count($nicknames) - 1)];
    do {
        $nickname2 = $nicknames[random_int(0, count($nicknames) - 1)];
    } while ($nickname2 === $nickname1);
    $nickname = $nickname1 . " " . $nickname2;
    return "(" . $male_names[$name_index] . "/" . $female_names[$name_index] . ") $surname \"$nickname\"";
}

function generate_age()
{
    // Weighted: 60% chance for 18-50, 20% for 14-17, 20% for 51-70
    $roll = random_int(1, 100);
    if ($roll <= 20) {
        return random_int(14, 17);
    } elseif ($roll <= 80) {
        return random_int(18, 50);
    } else {
        return random_int(51, 70);
    }
}

function ability_modifier($score)
{
    if ($score <= 4)
        return -3;
    if ($score <= 6)
        return -2;
    if ($score <= 8)
        return -1;
    if ($score <= 12)
        return 0;
    if ($score <= 14)
        return +1;
    if ($score <= 16)
        return +2;
    return +3;
}

// Roll 3d6
function roll_3d6()
{
    return roll_die(6) + roll_die(6) + roll_die(6);
}

function roll_die($sides)
{
    return random_int(1, $sides);
}

function generate_hp($class, $toughness_mod)
{
    switch ($class) {
        case "Brute":
            return max(1, $toughness_mod + roll_die(12));
        case "Rapscallion":
            return max(1, $toughness_mod + roll_die(8));
        case "Buccaneer":
            return max(1, $toughness_mod + roll_die(8));
        case "Swashbuckler":
            return max(1, $toughness_mod + roll_die(10));
        case "Zealot":
            return max(1, $toughness_mod + roll_die(8));
        case "Sorcerer":
            return max(1, $toughness_mod + roll_die(8));
        default:
            return max(1, $toughness_mod + roll_die(6));
    }
}

// Generate ability scores and apply class modifiers
function generate_abilities($class)
{
    global $class_mods;
    $base = [
        "Strength" => roll_3d6(),
        "Agility" => roll_3d6(),
        "Presence" => roll_3d6(),
        "Toughness" => roll_3d6(),
        "Spirit" => roll_3d6(),
    ];
    $modifiers = [];
    foreach ($base as $k => $v) {
        $mod = ability_modifier($v);
        // Apply class modifier if present
        if (isset($class_mods[$class][$k])) {
            $mod += $class_mods[$class][$k];
            // Clamp between -3 and +6
            $mod = max(-3, min(6, $mod));
        }
        $modifiers[$k] = $mod;
    }
    return $modifiers;
}

function generateNpc()
{
    global $names, $classes, $motivations, $body_types, $accents, $trademarks, $idiosyncrasies, $incidents, $loot, $things_of_importance, $distinctive_flaws, $weapons, $class_mods;
    $class = $classes[random_int(0, count($classes) - 1)];
    $abilities = generate_abilities($class);
    $carrying_capacity = 8 + $abilities["Strength"];
    $hp = generate_hp($class, $abilities["Toughness"]);
    return [
        "name" => random_name(),
        "class" => $classes[random_int(0, count($classes) - 1)],
        "motivation" => $motivations[random_int(0, count($motivations) - 1)],
        "body_type" => $body_types[random_int(0, count($body_types) - 1)],
        "accent" => $accents[random_int(0, count($accents) - 1)],
        "trademark" => $trademarks[random_int(0, count($trademarks) - 1)],
        "idiosyncrasy" => $idiosyncrasies[random_int(0, count($idiosyncrasies) - 1)],
        "incident" => $incidents[random_int(0, count($incidents) - 1)],
        "loot" => $loot[random_int(0, count($loot) - 1)],
        "thing_of_importance" => $things_of_importance[random_int(0, count($things_of_importance) - 1)],
        "distinctive_flaw" => $distinctive_flaws[random_int(0, count($distinctive_flaws) - 1)],
        "weapon" => $weapons[random_int(0, count($weapons) - 1)],
        "strength" => $abilities["Strength"],
        "agility" => $abilities["Agility"],
        "presence" => $abilities["Presence"],
        "toughness" => $abilities["Toughness"],
        "spirit" => $abilities["Spirit"],
        "carrying_capacity" => $carrying_capacity,
        "hp" => $hp,
        "age" => generate_age(),
        "clothing" => roll_clothing($class),
        "hat" => roll_hat($class),
        "gear" => implode(", ", roll_gear($carrying_capacity-3)),
    ];
}

// --- OUTPUT ---

if (isset($_GET['outline'])) {
    echo json_encode(npc_outline());
    exit;
}

$outline = npc_outline();
$values = generateNpc();

foreach ($outline['categories'] as &$cat) {
    foreach ($cat['fields'] as &$field) {
        $key = $field['key'];
        $field['value'] = $values[$key] ?? '';
    }
}

echo json_encode($outline);