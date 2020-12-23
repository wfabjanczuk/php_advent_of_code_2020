<?php

function solvePartTwo(string $filepath): int
{
    $invalidNumber = 756008079;
    $offset = 0;
    $result = 0;

    while ($result === 0) {
        $result = findContiguousSumInFile($filepath, $offset, $invalidNumber);
        $offset++;
    }
    return $result;
}

function findContiguousSumInFile(string $filepath, int $offset, int $sum): int
{
    $partialSum = 0;
    $buffer = [];
    $i = 0;

    foreach (file($filepath) as $line) {
        if ($i++ < $offset) {
            continue;
        }

        $number = (int)$line;
        $buffer[] = $number;
        $partialSum += $number;

        if ($partialSum > $sum) {
            return 0;
        }

        if ($partialSum === $sum) {
            return sumMinMax($buffer);
        }
    }

    if (empty($buffer)) {
        throw new RuntimeException('No solution');
    }
    return 0;
}

function sumMinMax(array $buffer): int
{
    sort($buffer);
    return reset($buffer) + end($buffer);
}

echo solvePartTwo(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');