<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'ShipPartTwo.php';

use Day12\ShipPartTwo;

function solvePartOne(string $filepath): int
{
    $ship = new ShipPartTwo(10, 1, 0, 0);

    foreach (file($filepath) as $line) {
        $matches = [];
        preg_match('/(\w)(\d+)/', $line, $matches);

        $instruction = $matches[1];
        $argument = (int)$matches[2];
        $ship->navigate($instruction, $argument);
    }

    return $ship->getManhattanDistance();
}

echo solvePartOne(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');