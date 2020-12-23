<?php

function solvePartOne(string $filepath): int
{
    $bufferSize = 25;
    $buffer = [];
    $i = 0;

    foreach (file($filepath) as $line) {
        $number = (int)$line;

        if ($i >= $bufferSize) {
            if (!areComponentsInBuffer($number, $buffer)) {
                return $number;
            }
            unset($buffer[$i - $bufferSize]);
        }

        $buffer[$i++] = $number;
    }
    throw new RuntimeException('No solution');
}

function areComponentsInBuffer(int $number, array $buffer): bool
{
    foreach ($buffer as $i) {
        foreach ($buffer as $j) {
            if (($i !== $j) && ($i + $j === $number)) {
                return true;
            }
        }
    }
    return false;
}

echo solvePartOne(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');