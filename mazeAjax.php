<?php

namespace App;

use Exception;

require 'vendor/autoload.php';

$response = [];

if (isset($_POST['mazeData'])) {
    try {
        $mazeSolver = new Maze($_POST['mazeData']);
    } catch (Exception $e) {
        $response['errors'][] = $e->getMessage();
        echo json_encode($response);
        return;
    }

    $cost = $mazeSolver->findPathCost();

    if ($cost == -1) {
        $response['errors'][] = 'Невозможно добраться до финиша';
    } else {
        $response['cost'] = $cost;
    }

} else {
    $response['errors'][] = 'Данные о лабиринте не были получены';
}

echo json_encode($response);
return;


