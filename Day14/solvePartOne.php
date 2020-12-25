<?php

function solvePartOne(string $filename): int
{
    $lines = file($filename);

    $i = 0;
    $iMax = count($lines);
    $mask = null;
    $memory = [];

    while ($i < $iMax) {
        $matches = [];
        $isMask = preg_match('/mask = ([X\d]{36})/', $lines[$i], $matches);

        if ($isMask === 1) {
            $mask = $matches[1];
        } else {
            preg_match('/mem\[(\d+)\] = (\d+)/', $lines[$i], $matches);
            $address = (int)$matches[1];
            $value = (int)$matches[2];
            $memory[$address] = applyMaskOnValue($mask, $value);
        }
        $i++;
    }

    return array_sum($memory);
}

function applyMaskOnValue(string $mask, int $value): int
{
    $binValue = decbin($value);
    $paddedBinValue = str_pad($binValue, 36, '0', STR_PAD_LEFT);

    $maskArray = str_split($mask);
    $valueArray = str_split($paddedBinValue);

    foreach (range(0, 35) as $b) {
        if ($maskArray[$b] !== 'X') {
            $valueArray[$b] = $maskArray[$b];
        }
    }
    return bindec(implode('', $valueArray));
}

echo solvePartOne(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');