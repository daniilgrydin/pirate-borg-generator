<?php
header('Content-Type: application/json');
ini_set('display_errors', 0);
error_reporting(0);

$vessel_data = [
    "Raft" => [
        "HP" => 2, "Hull" => "-", "Agility" => -1, "Speed" => 1,
        "Broadsides" => "-", "Small_Arms" => "-", "Ram" => "none",
        "Crew" => "1/3", "Cargo" => 0, "Special" => "Use passengers stats."
    ],
    "Dinghy" => [
        "HP" => 4, "Hull" => "-", "Agility" => 3, "Speed" => 2,
        "Broadsides" => "-", "Small_Arms" => "d2", "Ram" => "none",
        "Crew" => "1/4", "Cargo" => 0, "Special" => "Use passengers stats. Not affected by wind."
    ],
    "Canoe" => [
        "HP" => 3, "Hull" => "-", "Agility" => 3, "Speed" => 3,
        "Broadsides" => "-", "Small_Arms" => "d2", "Ram" => "none",
        "Crew" => "1/3", "Cargo" => 0, "Special" => "Use passengers stats. Not affected by wind."
    ],
    "Longboat" => [
        "HP" => 5, "Hull" => "-", "Agility" => 3, "Speed" => 3,
        "Broadsides" => "-", "Small_Arms" => "d4", "Ram" => "none",
        "Crew" => "2/10", "Cargo" => 0, "Special" => "Use passengers stats. Not affected by wind."
    ],
    "Piragua" => [
        "HP" => 10, "Hull" => "-", "Agility" => 3, "Speed" => 3,
        "Broadsides" => "-", "Small_Arms" => "d6", "Ram" => "none",
        "Crew" => "2/20", "Cargo" => 0, "Special" => "Use passengers stats."
    ],
    "Tartane" => [
        "HP" => 20, "Hull" => "-d2", "Agility" => 2, "Speed" => 5,
        "Broadsides" => "d4", "Small_Arms" => "d4", "Ram" => "d4",
        "Crew" => "3/9", "Cargo" => 1, "Special" => "Can travel full speed when Close to the Wind."
    ],
    "Sloop" => [
        "HP" => 30, "Hull" => "-d2", "Agility" => 2, "Speed" => 5,
        "Broadsides" => "d6", "Small_Arms" => "d4", "Ram" => "d4",
        "Crew" => "3/10", "Cargo" => 2, "Special" => "Can travel full speed when Close to the Wind."
    ],
    "Brigantine" => [
        "HP" => 40, "Hull" => "-d4", "Agility" => 1, "Speed" => 4,
        "Broadsides" => "d8", "Small_Arms" => "d4", "Ram" => "d6",
        "Crew" => "15/30", "Cargo" => 3, "Special" => "None."
    ],
    "Fluyt" => [
        "HP" => 50, "Hull" => "-d4", "Agility" => -1, "Speed" => 3,
        "Broadsides" => "d10", "Small_Arms" => "d6", "Ram" => "d6",
        "Crew" => "10/40", "Cargo" => 5, "Special" => "None."
    ],
    "Frigate" => [
        "HP" => 60, "Hull" => "-d4", "Agility" => 0, "Speed" => 4,
        "Broadsides" => "2 x d8", "Small_Arms" => "d6", "Ram" => "d6",
        "Crew" => "24/48", "Cargo" => 4, "Special" => "Makes 2 broadsides when > half HP."
    ],
    "Galleon" => [
        "HP" => 65, "Hull" => "-d6", "Agility" => -3, "Speed" => 2,
        "Broadsides" => "2 x d10", "Small_Arms" => "d6", "Ram" => "d8",
        "Crew" => "30/60", "Cargo" => 6, "Special" => "Makes 2 broadsides when > half HP."
    ],
    "Galley" => [
        "HP" => 60, "Hull" => "-d4", "Agility" => 1, "Speed" => 5,
        "Broadsides" => "-", "Small_Arms" => "d10", "Ram" => "d10",
        "Crew" => "80/120", "Cargo" => 3, "Special" => "Moves 3\" regardless of wind."
    ],
    "Man-of-war" => [
        "HP" => 75, "Hull" => "-d6", "Agility" => -2, "Speed" => 3,
        "Broadsides" => "3 x d8", "Small_Arms" => "d8", "Ram" => "d8",
        "Crew" => "50/150", "Cargo" => 4, "Special" => "3 broadsides >2/3 HP, 2 >1/3 HP"
    ],
    "Ship of the Line" => [
        "HP" => 95, "Hull" => "-d6", "Agility" => -3, "Speed" => 3,
        "Broadsides" => "3 x d10", "Small_Arms" => "2 x d8", "Ram" => "d8",
        "Crew" => "150/350", "Cargo" => 4, "Special" => "3 broadsides >2/3 HP; 2 >1/3 HP; 2 small arms >1/2 HP"
    ]
];


function ship_outline() {
    return [
        "categories" => [
            [
                "name" => "Trivia",
                "fields" => [
                    ["key" => "name", "label" => "Ship Name", "type" => "text"],
                    ["key" => "armament", "label" => "Armament", "type" => "text"],
                    ["key" => "crew_quantity", "label" => "Crew Quantity", "type" => "text"],
                    ["key" => "crew_quality", "label" => "Crew Quality", "type" => "text"],
                    ["key" => "plot_twist", "label" => "Plot Twist", "type" => "text"]
                ]
            ],
            [
                "name" => "Ship",
                "fields" => [
                    ["key" => "vessel_class", "label" => "Vessel Class", "type" => "text"],
                    ["key" => "vessel_hp", "label" => "HP", "type" => "text"],
                    ["key" => "vessel_hull", "label" => "Hull", "type" => "text"],
                    ["key" => "vessel_agility", "label" => "Agility", "type" => "text"],
                    ["key" => "vessel_speed", "label" => "Speed", "type" => "text"],
                    ["key" => "vessel_broadsides", "label" => "Broadsides", "type" => "text"],
                    ["key" => "vessel_small_arms", "label" => "Small Arms", "type" => "text"],
                    ["key" => "vessel_ram", "label" => "Ram", "type" => "text"],
                    ["key" => "vessel_crew", "label" => "Vessel Crew", "type" => "text"],
                    ["key" => "vessel_cargo_spaces", "label" => "Cargo Spaces", "type" => "text"],
                    ["key" => "vessel_special", "label" => "Vessel Special", "type" => "text"]
                ]
            ],
            [
                "name" => "Cargo",
                "fields" => [
                    ["key" => "mundane_cargo", "label" => "Mundane Cargo", "type" => "text"],
                    ["key" => "special_cargo", "label" => "Special Cargo", "type" => "text"]
                ]
            ]
        ]
    ];
}

function generateShip($params = []) {
    $names = [
        "Banshee's Wail", "Revenant", "Void Ripper", "Mermaid's Tear", "Carrion Crow", "Executioner's Hand",
        "Poseidon's Rage", "Adventure's Ghost", "Widow's Revenge", "Blood Moon", "Devil's Scorn", "Gilded Parrot",
        "Monolith", "Black Tide", "Raven's Wrath", "Coral Corsair", "Hellspire", "Vendetta",
        "Crimson Tempest", "Royal Tomb", "Guillotine", "Neptune's Maiden", "Cadaver's Call", "Heart of the Sea",
        "Demonwake", "Bride of the Abyss", "Annihilation", "Golden Glaive", "Necrobile", "Grave Witch",
        "Loa's Lament", "Hunsi Kanzo", "Dragon from the Deep", "Leviathan's Flood", "Kraken's Maw", "Harlequin's Curse"
    ];

    $armaments = [
        "Merchant: No weapons.",
        "Lightly armed: reduce damage die size by one.",
        "Normal armament",
        "Normal armament",
        "Normal armament",
        "Warship: Double broadsides."
    ];

    $crew_quantity = [
        "Short-handed: half as many.",
        "Standard crew.",
        "Standard crew.",
        "Ready for war: twice as many.",
        "Ready for war: twice as many.",
        "Ready to raid: as many as possible."
    ];

    $crew_quality = [
        "Near mutiny and/or untrained.",
        "Near mutiny and/or untrained.",
        "Miserable and/or novice.",
        "Miserable and/or novice.",
        "Miserable and/or novice.",
        "Average.",
        "Average.",
        "Fresh from shore leave and/or experienced.",
        "Fresh from shore leave and/or experienced.",
        "Prosperous/loyal and/or military training.",
        "Prosperous/loyal and/or military training."
    ];

    $vessel_classes = [
        "Raft", "Longboat", "Tartane", "Sloop", "Brigantine",
        "Fluyt", "Frigate", "Galleon", "Man-of-war", "Ship of the Line"
    ];

    $mundane_cargo = [
        "Food or crops, 250s",
        "Spices or oils, 350s",
        "Trade goods, 400s",
        "Livestock, 400s",
        "Sugar, 500s",
        "Rum, 1000s",
        "Munitions, 2000s",
        "Tobacco, 1000s",
        "Wine, 2000s",
        "Antiques, 2000s",
        "Lumber, 1000s",
        "Special cargo"
    ];

    $special_cargo = [
        "Raw silver ore, 5000s",
        "Golden coins and treasures, 10000s",
        "Religious leader(s)",
        "Important prisoner(s)",
        "Political or military figure(s)",
        "Relics or a rare artifact, 4000s",
        "Sea monster bones, 2500s",
        "Exotic animals, 2000s",
        "Locked chests, 2d8 x 100s",
        "Crates of ASH (see pg. 25)",
        "Imprisoned undead",
        "A sorcerer with a tome of Arcane Rituals"
    ];

    $plot_twists = [
        "Deadly disease on board.",
        "Crew are impostors.",
        "Crew is mute.",
        "The PCs know this crew.",
        "Everyone on board was thought to be dead.",
        "Ghost ship.",
        "They're all zombies.",
        "Someone on board is related to a PC's backstory."
    ];

    // Vessel class selection
    if (!empty($params['vessel_class']) && in_array($params['vessel_class'], $vessel_classes)) {
        $vessel_class = $params['vessel_class'];
    } else {
        $vessel_class = $vessel_classes[random_int(0, count($vessel_classes) - 1)];
    }

    // Vessel data lookup
    global $vessel_data;
    $vessel_info = $vessel_data[$vessel_class] ?? [];

    // Cargo generation
    $cargo_spaces = $vessel_info['Cargo'] ?? 0;
    $cargo = [];
    for ($i = 0; $i < random_int(0, $cargo_spaces); $i++) {
        // 1 in 8 chance for special cargo, otherwise mundane
        if (random_int(1, 8) === 1) {
            $cargo[] = [
                "type" => "special",
                "value" => $special_cargo[random_int(0, count($special_cargo) - 1)]
            ];
        } else {
            $cargo[] = [
                "type" => "mundane",
                "value" => $mundane_cargo[random_int(0, count($mundane_cargo) - 1)]
            ];
        }
    }

    // If no cargo spaces, still roll one mundane and one special for display
    if ($cargo_spaces === 0) {
        $mundane = $mundane_cargo[random_int(0, count($mundane_cargo) - 1)];
        $special = $special_cargo[random_int(0, count($special_cargo) - 1)];
    } else {
        $mundane = '';
        $special = '';
    }

    // Prepare vessel data fields
    $vessel_fields = [
        "vessel_hp" => $vessel_info['HP'] ?? '',
        "vessel_hull" => $vessel_info['Hull'] ?? '',
        "vessel_agility" => $vessel_info['Agility'] ?? '',
        "vessel_speed" => $vessel_info['Speed'] ?? '',
        "vessel_broadsides" => $vessel_info['Broadsides'] ?? '',
        "vessel_small_arms" => $vessel_info['Small_Arms'] ?? '',
        "vessel_ram" => $vessel_info['Ram'] ?? '',
        "vessel_crew" => $vessel_info['Crew'] ?? '',
        "vessel_cargo_spaces" => $vessel_info['Cargo'] ?? '',
        "vessel_special" => $vessel_info['Special'] ?? ''
    ];

    return array_merge([
        "name" => $names[array_rand($names)],
        "armament" => $armaments[random_int(0, 5)],
        "crew_quantity" => $crew_quantity[random_int(0, 5)],
        "crew_quality" => $crew_quality[random_int(0, 10)],
        "vessel_class" => $vessel_class,
        "cargo" => $cargo,
        "mundane_cargo" => $mundane,
        "special_cargo" => $special,
        "plot_twist" => $plot_twists[random_int(0, 7)]
    ], $vessel_fields);
}

// If ?outline=1 is passed, return the outline
if (isset($_GET['outline'])) {
    echo json_encode(ship_outline());
    exit;
}

// Otherwise, generate a ship and return both outline and values
$outline = ship_outline();
$values = generateShip($_GET);

// Merge outline and values
foreach ($outline['categories'] as &$cat) {
    foreach ($cat['fields'] as &$field) {
        $key = $field['key'];
        if ($key === 'mundane_cargo') {
            $field['value'] = $values['mundane_cargo'] ?: implode(', ', array_filter(array_map(function($c) {
                return $c['type'] === 'mundane' ? $c['value'] : null;
            }, $values['cargo'])));
        } elseif ($key === 'special_cargo') {
            $field['value'] = $values['special_cargo'] ?: implode(', ', array_filter(array_map(function($c) {
                return $c['type'] === 'special' ? $c['value'] : null;
            }, $values['cargo'])));
        } elseif ($key === 'vessel_crew') {
            // Parse "min/max" and generate a random crew count, display both
            $crew_range = $values['vessel_crew'];
            if (preg_match('/(\d+)\s*\/\s*(\d+)/', $crew_range, $matches)) {
                $min = (int)$matches[1];
                $max = (int)$matches[2];
                $crew_num = random_int($min, $max);
                $field['value'] = "{$crew_num} ({$min}/{$max})";
            } else {
                $field['value'] = $crew_range;
            }
        } else {
            $field['value'] = $values[$key] ?? '';
        }
    }
}

echo json_encode($outline);
