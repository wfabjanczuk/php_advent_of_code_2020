<?php

function solvePartTwo(string $filepath): int
{
    $map = [];

    foreach (file($filepath) as $line) {
        $row = str_split(trim($line));
        $map[] = $row;
    }

    $slopeVectors = [
        [1, 1],
        [3, 1],
        [5, 1],
        [7, 1],
        [1, 2]
    ];

    $product = 1;
    foreach ($slopeVectors as $slopeVector) {
        $product *= solveSlope($map, $slopeVector[0], $slopeVector[1]);
    }
    return $product;
}

function solveSlope($map, $xStep, $yStep): int
{
    $trees = 0;

    $xMax = count($map[0]);
    $yMax = count($map);

    $x = 0;
    $y = 0;

    while (($y += $yStep) < $yMax) {
        $x = ($x + $xStep) % $xMax;
        $trees += $map[$y][$x] === '#'
            ? 1
            : 0;
    }

    return $trees;
}

echo solvePartTwo(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');