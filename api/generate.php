<?php
header('Content-Type: application/json');

// Basic generators
function generateNPC($params) {
    $names = ["One-Eyed Jack", "Black Bonnie", "Mad Morgan"];
    $traits = ["cunning", "ruthless", "superstitious"];
    return [
        "name" => $params['name'] ?? $names[array_rand($names)],
        "trait" => $params['trait'] ?? $traits[array_rand($traits)]
    ];
}

function generateCrew($count = 3) {
    $crew = [];
    for ($i = 0; $i < $count; $i++) {
        $crew[] = generateNPC([]);
    }
    return $crew;
}

function generateShip($params) {
    $names = ["The Black Barnacle", "Sea Vulture", "Ghostwind"];
    return [
        "name" => $params['name'] ?? $names[array_rand($names)],
        "type" => $params['type'] ?? "Brigantine",
        "crew" => generateCrew($params['crew_count'] ?? 3)
    ];
}

$type = $_GET['type'] ?? 'npc';
$params = $_GET;
unset($params['type']); // Don't pass 'type' to generator

switch ($type) {
    case 'npc':
        echo json_encode(generateNPC($params));
        break;
    case 'crew':
        echo json_encode(generateCrew($params['count'] ?? 3));
        break;
    case 'ship':
        echo json_encode(generateShip($params));
        break;
    default:
        echo json_encode(["error" => "Invalid type"]);
        break;
}
