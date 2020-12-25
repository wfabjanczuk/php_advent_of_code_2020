<?php

function solvePartTwo(string $filepath): int
{
    $lines = file($filepath);

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

            $resultAddresses = applyMaskOnAddress($mask, $address);
            foreach ($resultAddresses as $address) {
                $memory[$address] = $value;
            }
        }
        $i++;
    }

    return array_sum($memory);
}

function applyMaskOnAddress(string $mask, int $address): array
{
    $binValue = decbin($address);
    $paddedBinValue = str_pad($binValue, 36, '0', STR_PAD_LEFT);

    $maskArray = str_split($mask);
    $valueArray = str_split($paddedBinValue);

    $resultAddresses = [$valueArray];

    foreach (range(0, 35) as $b) {
        $resultAddresses = transformAddresses($resultAddresses, $b, $maskArray);
    }

    $resultAddresses = array_map(
        function ($address) {
            return bindec(implode('', $address));
        },
        $resultAddresses
    );

    return $resultAddresses;
}

function transformAddresses(array $resultAddresses, int $b, array $maskArray): array
{
    if ($maskArray[$b] === '1') {
        foreach ($resultAddresses as &$tempAddress) {
            $tempAddress[$b] = '1';
        }
        unset($tempAddress);
    }

    if ($maskArray[$b] === 'X') {
        $duplicate = $resultAddresses;

        foreach ($resultAddresses as &$tempAddress) {
            $tempAddress[$b] = '0';
        }
        unset($tempAddress);

        foreach ($duplicate as &$tempAddress) {
            $tempAddress[$b] = '1';
        }
        unset($tempAddress);

        $resultAddresses = array_merge($resultAddresses, $duplicate);
    }

    return $resultAddresses;
}

echo solvePartTwo(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');