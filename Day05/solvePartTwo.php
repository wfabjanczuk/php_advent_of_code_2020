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

    throw new \Exception('No solution.');
}

function getSeat($code): int
{
    $binary = str_replace('F', '0', $code);
    $binary = str_replace('B', '1', $binary);
    $binary = str_replace('L', '0', $binary);
    $binary = str_replace('R', '1', $binary);

    return bindec($binary);
}

echo solvePartTwo('input.txt');