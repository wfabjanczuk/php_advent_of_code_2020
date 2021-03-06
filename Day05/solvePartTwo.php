<?php

function solvePartTwo(string $filepath): int
{
    $allSeats = [];
    foreach (file($filepath) as $line) {
        $allSeats[] = getSeat(trim($line));
    }

    sort($allSeats);
    $allSeatsCount = count($allSeats);

    for ($i = 1; $i < $allSeatsCount; $i++) {
        if ($allSeats[$i - 1] === $allSeats[$i] - 2) {
            return $allSeats[$i] - 1;
        }
    }

    throw new RuntimeException('No solution.');
}

function getSeat($code): int
{
    $binary = str_replace(['F', 'B', 'L', 'R'], ['0', '1', '0', '1'], $code);
    return bindec($binary);
}

echo solvePartTwo(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');