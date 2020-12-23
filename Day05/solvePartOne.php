<?php

function solvePartOne(string $filepath): int
{
    $maxSeat = 0;

    foreach (file($filepath) as $line) {
        $seat = getSeat(trim($line));
        $maxSeat = $seat > $maxSeat
            ? $seat
            : $maxSeat;
    }

    return $maxSeat;
}

function getSeat($code): int
{
    $binary = str_replace(['F', 'B', 'L', 'R'], ['0', '1', '0', '1'], $code);
    return bindec($binary);
}

echo solvePartOne(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');