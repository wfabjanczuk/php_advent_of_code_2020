<?php

function solvePartTwo(string $filepath): int
{
    $correct = 0;
    $matchResult = [];

    foreach (file($filepath) as $line) {
        if (preg_match('/(\d+)-(\d+) (\w): (\w+)/', $line, $matchResult) !== 1) {
            throw new \RuntimeException('Incorrect file format.');
        }

        $firstPosition = (int)$matchResult[1] - 1;
        $secondPosition = (int)$matchResult[2] - 1;
        $letter = $matchResult[3];
        $password = str_split($matchResult[4]);

        $isFirstPositionOK = ($password[$firstPosition] ?? false) === $letter;
        $isSecondPositionOK = ($password[$secondPosition] ?? false) === $letter;

        $correct += ($isFirstPositionOK xor $isSecondPositionOK)
            ? 1
            : 0;
    }

    return $correct;
}

echo solvePartTwo(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');