<?php

function solvePartTwo(string $filepath): int
{
    $pastNumbers = [];
    $reverseDifferenceMap = [];

    foreach (file($filepath) as $line) {
        if (trim($line) === '') {
            throw new \RuntimeException('Incorrect file format.');
        }

        $currentNumber = (int)$line;
        if (array_key_exists($currentNumber, $reverseDifferenceMap)) {
            return $currentNumber * array_product($reverseDifferenceMap[$currentNumber]);
        }

        foreach ($pastNumbers as $pastNumber) {
            $reverseDifferenceMap[2020 - $pastNumber - $currentNumber] = [$pastNumber, $currentNumber];
        }
        $pastNumbers[] = $currentNumber;
    }
    throw new \RuntimeException('No solution.');
}

echo solvePartTwo(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');