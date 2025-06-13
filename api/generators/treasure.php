<?php
header('Content-Type: application/json');
ini_set('display_errors', 0);
error_reporting(0);

// --- TREASURE MAP TABLES ---

$treasure = [
    "The Black Spot on a folded piece of paper. Whoever unfolds it dies in d8 days (unless they find a way to lift the curse).",
    "A Spanish gold treasure hoard worth 50,000s. They want it back NOW.",
    "3 flags: British, Spanish, French. One torn, one blood spattered, one outdated.",
    "Freshly decapitated head. It looks exactly like one of the PCs. In its mouth is a pearl the size of a plum.",
    "Emerald the size of a coconut.",
    "6 stylized animal heads carved from wood, one on top of the next.",
    "7 rare gold coins worth d100 silver each.",
    "Each player rolls all of the dice they have with them: the total in silver.",
    "An enormous dinosaur bone.",
    "2 black flintlocks, the name 'Blackwood' engraved on both. DR -1 to hit.",
    "A bag of marbles.",
    "Thick leather belt, an iron kraken buckle. Wearer gets +1 strength.",
    "A pure white flintlock pistol. It crits on 18+ but shatters on a fumble.",
    "Half of a metal medallion.",
    "15 dead men on a dead man's chest. The crew learns 1 random Shanty (pg. 68).",
    "An elaborate brass anchor.",
    "An ancient circular stone calendar. Its last entry is the day after tomorrow...",
    "5,000 gold coins (they are painted wood).",
    "d6 black candles. Burning them makes all other light sources dim by half.",
    "d20 silver bars (50s each).",
    "8' marble statue of a sea monster with rubies for eyes.",
    "Detailed journal with drawings and descriptions of the local flora and fauna.",
    "Golden crown and scepter.",
    "a flute carved from a femur.",
    "d6 bladders from some sea creature. Each contains a potion (pg. 70).",
    "Jet black sphere.",
    "Mother of pearl encrusted lobster shell.",
    "Black cannon in the shape of a dragon. A ship with it always deals +1 damage.",
    "Book written in an ancient script. It contains the best recipes known to man.",
    "300 dead monkeys.",
    "Dead pirate captain. There is a 2,000s reward for his head.",
    "32 golden teeth and a set of silver pliers.",
    "Skeleton of a small animal.",
    "Single golden arrow.",
    "35' of hempen rope that will (almost) never break.",
    "Small sandstone pyramid. Smashing it reveals a black diamond worth 2,000s.",
    "Mesoan coin on a necklace.",
    "703 pieces of eight in a wooden crate.",
    "Dark gemstones. Looking into them reveals an underwater location.",
    "Ornate model frigate inside a bottle.",
    "Large fang the size of a femur.",
    "A fine wooden armoire. Inside are d12 outfits fit for royalty.",
    "Iron scarab. On sand it explodes for d6 damage, underwater it swims to treasure.",
    "Large jar filled with 2d20 dried seahorses. Eating one recovers 1 HP. Don't eat too many...",
    "Pair of finely crafted boots. +1 agility.",
    "Bloody leather bag with 3 silver rings, 7 stone rings, and 9 iron rings.",
    "Polished obsidian disc. If you look at the sun through it you immediately gain experience, then it shatters.",
    "4' x 8' stone slab covered in glyphs. It depicts a woman entering a portal.",
    "Carved ivory sailing ship.",
    "Sarcophagus (5,000s). Inside is a scepter that turns human ashes into silver dust.",
    "Dark green cloak. +1 presence.",
    "d20 bottles of the finest rum ever made.",
    "Barrel-sized egg. The inside stirs...",
    "Taxidermy dog. In its belly is a severed hand holding a set of keys.",
    "Severed finger. If rested on a map it will point to a lost city of gold.",
    "d4 barrels filled with blood.",
    "Smoking pipe shaped like a galleon.",
    "Hollow cannonball. Inside: a map.",
    "Clay dagger with glyphs carved in the blade. Read them: learn one random ritual (pg. 64) then it crumbles.",
    "Chest with 4 different colored vials.",
    "A figurehead of a gorgeous woman. If attached to a ship, it comes alive and screams in terror.",
    "Clay jar filled with 13 snakes.",
    "A skeleton key, pg. 63.",
    "Locked iron box. Inside is a rotten head that can speak. It knows the way to Hell.",
    "Set of 6 jade goblets.",
    "Everything within 66' dies immediately. (Optional: all PCs gain the Haunted Soul: Skeleton class until the treasure is reburied.)",
    "Silver bracelet of a snake eating its tail.",
    "Handheld crystal mirror.",
    "3d20 large pearls.",
    "Collection of exotic bird feathers (300s).",
    "Shriveled heart. It starts beating if submerged in sea water.",
    "Wood coffin. Inside is (d4): 1 a skeleton 2 a mummy 3 a vampire 4 1,000s.",
    "Map of the Dark Caribbean. A trail of blood appears along your path.",
    "Jaguar skull made of diamond.",
    "Key made of water. Glows if submerged.",
    "Jade gecko wrapped around a coconut sized granite globe.",
    "Vial of water. Drinking it secretly gives d100 HP.",
    "Satchel of hauntingly poetic love letters.",
    "Chess set carved from onyx and jade.",
    "Wood tube with d6 scrolls, each with a different Ritual (pg. 64). They always succeed but burn up once used.",
    "Stone tankard, covered with Mesoan glyphs. It never runs out of ale.",
    "Golden pegleg.",
    "Gold ship's bell. Ringing it changes the wind's direction.",
    "Plain gold ring with no signs of wear (in fire it projects a clue, pg. 121).",
    "A chest inside a chest. Roll again.",
    "Necklace of bones, each with a different engraved rune. +1 toughness.",
    "Gray, pointy hat. Wearer gets +1 spirit.",
    "Trident etched with antediluvian runes.",
    "Bronze skull with d2 gems for eyes.",
    "Bullwhip. Hits on dr8, d6 dmg, 10' range.",
    "Amulet of the Sun. Elaborately carved, Ancient, and extremely valuable.",
    "A large crate. d100 skulls are inside.",
    "Volcanic glass sculpture of an island. Holding it to the sun reveals a small ruby inside. It's a map.",
    "Spyglass. It seems broken, but actually peers 24 hours into the past.",
    "Book of 7 maps in 7 different languages. Each is of a different small island.",
    "3 turtles shells of different colors. Each is filled with gems worth d100 silver.",
    "Go. A bag of black stones, a bag of white stones, and a bamboo game board.",
    "Oil lamp. (The genie inside will grant one wish, but in the worst way possible).",
    "A wooden box with 24 stacks of 20 gold coins (500s each) and 6 loaded flintlocks.",
    "1 million pieces of eight. Good luck."
];

$type = [
    "Simple. A geographic area, X marks the spot.",
    "Point Crawl. The map shows several icons, but they must be traveled to sequentially to find the next one.",
    "Scavenger Hunt. The map has only one point of interest or one clue, but finding it reveals more maps or clues.",
    "Arcane. The map only reveals the next step when the previous one is completed."
];

$material = [
    "Parchment paper.",
    "Parchment paper.",
    "Parchment paper.",
    "Parchment paper.",
    "In an old book.",
    "Only in someone's mind or memories.",
    "Burnt into leather.",
    "Whittled into a bone or skull.",
    "Minted on a unique coin.",
    "Embossed into a sea turtle shell.",
    "Scratched into driftwood.",
    "Etched into a glass bottle."
];

$geography = [
    "Island",
    "Coast",
    "Peninsula",
    "Cove",
    "Archipelago",
    "River",
    "Lake",
    "Inland"
];

$start = [
    "at a totally unknown location.",
    "nearby.",
    "within a mile.",
    "a day's walk away.",
    "a day's sail away.",
    "near a well known place."
];

$ink = [
    "with heat or fire.",
    "under star or moon light.",
    "during an eclipse.",
    "when underwater.",
    "if soaked in alcohol.",
    "with magic or a ritual.",
    "when you speak the password.",
    "when near a key location or object.",
    "during the solstice or equinox.",
    "at a certain time of day."
];

$complication = [
    "Another crew is there when the PCs arrive.",
    "Monsters guard it.",
    "It has already been found or is missing.",
    "It's cursed.",
    "There are hundreds of corpses.",
    "The PCs become incredibly lost on the way.",
    "The whole thing is a setup.",
    "There is so much treasure everyone becomes murderously paranoid."
];

$clue_container = [
    "Note in a scroll case.",
    "Small stone, instructions carved underneath.",
    "Coconut shell.",
    "Message in a bottle.",
    "Metal plaque.",
    "Letter in a small box.",
    "Etched cannon ball.",
    "Burnt or carved into wood.",
    "Dried blood on a skull.",
    "A potion. The drinker “knows\" the next clue, but toughness DR12 or becomes poisoned."
];

$marker = [
    "Large boulder",
    "Dead man's bones",
    "Makeshift grave",
    "Old anchor",
    "Ruined rowboat",
    "Lone palm tree",
    "Ship's wheel",
    "Painted rock",
    "Cannonball",
    "Pile of skulls",
    "Volcanic glass",
    "Rusty cutlass",
    "Broken oar",
    "Broken barrel",
    "Ruined cannon",
    "Tallest tree",
    "Strange sea shell",
    "Rotting crate",
    "Stone statue",
    "Tombstone"
];

$direction = [
    "north",
    "northeast",
    "east",
    "southeast",
    "south",
    "southwest",
    "west",
    "northwest"
];

$icon = [
    "Rope bridge",
    "Waterfall",
    "Volcano caldera",
    "Skull rock",
    "Wicked tree",
    "Jungle",
    "Beach caves",
    "Whale graveyard",
    "White sand beach",
    "Lagoon",
    "Ancient ruins",
    "Burnt down cabin",
    "Swamp",
    "Shipwreck",
    "Cliff side",
    "Large hill",
    "Quicksand",
    "Mountain's peak",
    "Highest point",
    "Lowest point"
];

$riddle = [
    "Arrive at the [icon] but you won't see the [marker] in the light, travel [2d6] paces to the [direction] and wait until day turns to night. The marker only appears in the dark. (The marker appears at night.)",
    "Set your course for the [icon] and ready a shanty, for singing near the [marker] will turn “none\" into “plenty\". The treasure or clue appears once music is played. (Music activates the clue/treasure.)",
    "Find the [marker] by the [icon], ye soothsayers and witches, for only magic or prayers can lead to these riches. Using a Relic, Ritual, Spell, or Prayer magically reveals the clue or treasure. (A spell or ritual is required.)",
    "Look not high for salvation, but low for an X, crossed trees you will find, but beware of the hex. Two fallen trees cover the clue or treasure; it's booby trapped. (Watch out for a trap.)",
    "In shallow waters near [icon] the [marker] rests under waves, it points in the direction of nearby caves. The marker has a carved or painted arrow that points to a nearby cave with the clue/treasure. (The marker points to the cave.)",
    "Head [d8 x 10] paces [direction] of the [icon] then dig a hole, under the [marker] lies the key to your goal. Dig for the clue/treasure. (The clue is underground.)",
    "Make for the [icon] before the sun hits the sea, the secret lies between the [marker] and a tree. Can't be found during the night. (Clue/treasure only found before sunset.)",
    "Only dead men know this hidden locale, for of all who've seen the [marker] by the [icon] none have lived to tell. Tragedy, a trap, or both haunt this location. (Dangerous trap or curse involved.)",
    "Near [icon] at midnight the dead rise from their graves, but the one near the [marker] is a crooked-nosed knave. Harmless ghosts rise here at midnight, but one near the marker knows the location of the clue/treasure. (He will only reveal it if his body, hanging from a nearby noose, is laid to rest. Ghost's knowledge revealed after ritual.)",
    "Travel [direction] for 2d2 miles, find the [icon] then rest, only candlelight will reveal the [marker] over the chest. The marker only appears in candle light. The clue/treasure is under it. (Candlelight reveals the marker.)",
    "From the [icon] at low tide you will be able to see, the [marker] just [direction] of a large fruit tree. The clue/treasure is buried in the shadow of the tree. (Clue/treasure is buried in the shadow.)",
    "[Direction] of the [icon] you will find a sight rarely seen, find the [marker] that's hidden under a blanket of green. The marker is hidden under foliage, moss, or grass growing in an odd place. (The marker is hidden under plants.)"
];

// --- OUTLINE ---

function treasure_map_outline() {
    return [
        "categories" => [
            [
                "name" => "Treasure",
                "fields" => [
                    ["key" => "treasure", "label" => "Treasure", "type" => "text"],
                ]
            ],
            [
                "name" => "Map",
                "fields" => [
                    ["key" => "type", "label" => "Type of Map", "type" => "text"],
                    ["key" => "material", "label" => "Material", "type" => "text"],
                    ["key" => "geography", "label" => "Geography", "type" => "text"],
                    ["key" => "start", "label" => "It starts...", "type" => "text"],
                    ["key" => "ink", "label" => "Invisible Ink is Revealed...", "type" => "text"],
                    ["key" => "complication", "label" => "Complication", "type" => "text"],
                    ["key" => "clue_container", "label" => "Clue Container", "type" => "text"],
                    // ["key" => "marker", "label" => "Marker", "type" => "text"],
                    // ["key" => "direction", "label" => "Direction", "type" => "text"],
                    // ["key" => "icon", "label" => "Icon", "type" => "text"],
                    ["key" => "riddle", "label" => "Riddle", "type" => "text"]
                ]
            ]
        ]
    ];
}

function roll_die($sides) {
    return random_int(1, $sides);
}

function roll_dice($notation) {
    // Supports d6, d8, 2d6, d8x10, 2d2, etc.
    if (preg_match('/(\d*)d(\d+)(\s*x\s*(\d+))?/i', $notation, $m)) {
        $num = $m[1] ? intval($m[1]) : 1;
        $sides = intval($m[2]);
        $mult = isset($m[4]) ? intval($m[4]) : 1;
        $total = 0;
        for ($i = 0; $i < $num; $i++) {
            $total += roll_die($sides);
        }
        return $total * $mult;
    }
    return $notation;
}

function generateTreasureMap() {
    global $treasure, $type, $material, $geography, $start, $ink, $complication, $clue_container, $marker, $direction, $icon, $riddle;

    $chosen_marker = $marker[roll_die(count($marker)) - 1];
    $chosen_direction = $direction[roll_die(count($direction)) - 1];
    $chosen_icon = $icon[roll_die(count($icon)) - 1];

    // Pick a riddle and fill in placeholders
    $riddle_template = $riddle[roll_die(count($riddle)) - 1];
    $riddle_filled = $riddle_template;
    $riddle_filled = str_replace('[marker]', $chosen_marker, $riddle_filled);
    $riddle_filled = str_replace('[direction]', $chosen_direction, $riddle_filled);
    $riddle_filled = str_replace('[icon]', $chosen_icon, $riddle_filled);
    // Dice rolls in riddle
    if (strpos($riddle_filled, '[2d6]') !== false) {
        $riddle_filled = str_replace('[2d6]', roll_dice('2d6'), $riddle_filled);
    }
    if (strpos($riddle_filled, '[d8 x 10]') !== false) {
        $riddle_filled = str_replace('[d8 x 10]', roll_dice('d8x10'), $riddle_filled);
    }
    if (strpos($riddle_filled, '[2d2]') !== false) {
        $riddle_filled = str_replace('[2d2]', roll_dice('2d2'), $riddle_filled);
    }
    if (strpos($riddle_filled, '[Direction]') !== false) {
        $riddle_filled = str_replace('[Direction]', ucfirst($chosen_direction), $riddle_filled);
    }

    return [
        "type" => $type[roll_die(count($type)) - 1],
        "material" => $material[roll_die(count($material)) - 1],
        "geography" => $geography[roll_die(count($geography)) - 1],
        "start" => $start[roll_die(count($start)) - 1],
        "ink" => $ink[roll_die(count($ink)) - 1],
        "complication" => $complication[roll_die(count($complication)) - 1],
        "clue_container" => $clue_container[roll_die(count($clue_container)) - 1],
        "marker" => $chosen_marker,
        "direction" => $chosen_direction,
        "icon" => $chosen_icon,
        "riddle" => $riddle_filled,
        "treasure" => $treasure[roll_die(count($treasure)) - 1]
    ];
}

// --- OUTPUT ---

if (isset($_GET['outline'])) {
    echo json_encode(treasure_map_outline());
    exit;
}

$outline = treasure_map_outline();
$values = generateTreasureMap();

foreach ($outline['categories'] as &$cat) {
    foreach ($cat['fields'] as &$field) {
        $key = $field['key'];
        $field['value'] = $values[$key] ?? '';
    }
}

echo json_encode($outline);