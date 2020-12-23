<?php

function solvePartTwo(string $filepath): int
{
    $sumOfAllCounts = 0;
    $currentGroupPositives = [];
    $partialSumOfPeople = 0;

    foreach (file($filepath) as $line) {
        if (trim($line) === '') {
            $sumOfAllCounts += getUnanimousPositivesCount($currentGroupPositives, $partialSumOfPeople);

            $currentGroupPositives = [];
            $partialSumOfPeople = 0;
            continue;
        }

        foreach (str_split(trim($line)) as $question) {
            $currentGroupPositives[$question] ??= 0;
            $currentGroupPositives[$question]++;
        }
        $partialSumOfPeople++;
    }

    $sumOfAllCounts += getUnanimousPositivesCount($currentGroupPositives, $partialSumOfPeople);
    return $sumOfAllCounts;
}

function getUnanimousPositivesCount($currentGroupPositives, $partialSumOfPeople): int
{
    $unanimousPositivesCount = 0;
    foreach ($currentGroupPositives as $positiveCount) {
        if ($positiveCount === $partialSumOfPeople) {
            $unanimousPositivesCount++;
        }
    }
    return $unanimousPositivesCount;
}

echo solvePartTwo('input.txt');