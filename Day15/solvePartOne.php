<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'NumberFinder.php';

use Day15\NumberFinder;

function solvePartOne(string $filepath): int
{
    $input = file($filepath);
    $startingNumbers = explode(',', $input[0]);
    $numberFinder = new NumberFinder();

    return $numberFinder->findNumberAtTurn(2020, $startingNumbers);
}

echo solvePartOne(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');