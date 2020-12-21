<?php

function solvePartOne(string $filepath): int
{
    $correct = 0;
    $matchResult = [];

    foreach (file($filepath) as $line) {
        if (preg_match('/(\d+)-(\d+) (\w): (\w+)/', $line, $matchResult) !== 1) {
            throw new \RuntimeException('Incorrect file format.');
        }

        $min = (int)$matchResult[1];
        $max = (int)$matchResult[2];
        $letter = $matchResult[3];
        $password = str_split($matchResult[4]);

        $letterOccurrences = 0;
        foreach ($password as $passwordLetter) {
            $letterOccurrences += ($passwordLetter === $letter)
                ? 1
                : 0;
        }

        $correct += ($min <= $letterOccurrences && $letterOccurrences <= $max)
            ? 1
            : 0;
    }

    return $correct;
}

echo solvePartOne('input.txt');