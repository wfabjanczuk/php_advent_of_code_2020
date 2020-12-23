<?php

function solvePartOne(string $filepath): int
{
    $trees = 0;
    $map = [];

    foreach (file($filepath) as $line) {
        $row = str_split(trim($line));
        $map[] = $row;
    }

    $xMax = count($map[0]);
    $yMax = count($map);

    $x = 0;
    $y = 0;

    while (++$y < $yMax) {
        $x = ($x + 3) % $xMax;
        $trees += $map[$y][$x] === '#'
            ? 1
            : 0;
    }

    return $trees;
}

echo solvePartOne(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');