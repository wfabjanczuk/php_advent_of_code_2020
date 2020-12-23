<?php

function solvePartOne(string $filepath): int
{
    $reverseDifferenceMap = [];

    foreach (file($filepath) as $line) {
        if (trim($line) === '') {
            throw new \RuntimeException('Incorrect file format.');
        }

        $currentNumber = (int)$line;
        if (array_key_exists($currentNumber, $reverseDifferenceMap)) {
            return $currentNumber * $reverseDifferenceMap[$currentNumber];
        }

        $reverseDifferenceMap[2020 - $currentNumber] = $currentNumber;
    }
    throw new \RuntimeException('No solution.');
}

echo solvePartOne(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');