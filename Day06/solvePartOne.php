<?php

function solvePartOne(string $filepath): int
{
    $sumOfAllCounts = 0;
    $currentPositives = [];

    foreach (file($filepath) as $line) {
        if (trim($line) === '') {
            $sumOfAllCounts += array_sum($currentPositives);
            $currentPositives = [];
            continue;
        }

        foreach (str_split(trim($line)) as $question) {
            $currentPositives[$question] = 1;
        }
    }

    $sumOfAllCounts += array_sum($currentPositives);
    return $sumOfAllCounts;
}

echo solvePartOne(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');