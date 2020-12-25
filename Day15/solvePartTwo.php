<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'NumberFinder.php';

use Day15\NumberFinder;

function solvePartTwo(string $filepath): int
{
    $input = file($filepath);
    $startingNumbers = explode(',', $input[0]);
    $numberFinder = new NumberFinder();

    return $numberFinder->findNumberAtTurn(30000000, $startingNumbers);
}

echo solvePartTwo(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');