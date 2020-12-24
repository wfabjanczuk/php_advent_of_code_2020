<?php

function solvePartOne(string $filepath): int
{
    $adapterList = getAdapterList($filepath);

    $differenceCountMap = [
        0 => 0,
        1 => 0,
        2 => 0,
        3 => 1
    ];

    $firstDifference = $adapterList[0] - 0;
    $differenceCountMap[$firstDifference]++;

    $adapterCount = count($adapterList);
    for ($i = 1; $i < $adapterCount; $i++) {
        $difference = $adapterList[$i] - $adapterList[$i - 1];
        $differenceCountMap[$difference]++;
    }

    return $differenceCountMap[1] * $differenceCountMap[3];
}

function getAdapterList(string $filepath): array
{
    $adapterList = [];
    foreach (file($filepath) as $line) {
        $joltage = (int)$line;
        $adapterList[] = $joltage;
    }
    sort($adapterList);
    return $adapterList;
}

echo solvePartOne(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');