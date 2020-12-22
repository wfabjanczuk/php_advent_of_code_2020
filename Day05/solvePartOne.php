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
    $binary = str_replace('F', '0', $code);
    $binary = str_replace('B', '1', $binary);
    $binary = str_replace('L', '0', $binary);
    $binary = str_replace('R', '1', $binary);

    return bindec($binary);
}

echo solvePartOne('input.txt');