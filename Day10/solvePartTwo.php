<?php

function solvePartTwo(string $filepath): int
{
    $adapterList = getAdapterList($filepath);

    $allSeries = findAllSeriesOfOnes($adapterList);
    $possibilitiesPerSeries = array_map('countAllPaths', $allSeries);

    return array_product($possibilitiesPerSeries);
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

function findAllSeriesOfOnes(array $adapterList): array
{
    $allSeries = [];
    $currentSeries = 1;

    if ($adapterList[0] === 1) {
        $currentSeries++;
    }

    $adapterCount = count($adapterList);
    for ($i = 1; $i < $adapterCount; $i++) {
        $difference = $adapterList[$i] - $adapterList[$i - 1];

        if ($difference === 1) {
            $currentSeries++;
        } else if ($currentSeries > 1) {
            $allSeries[] = $currentSeries;
            $currentSeries = 1;
        }
    }

    if ($currentSeries > 1) {
        $allSeries[] = $currentSeries;
    }

    return $allSeries;
}

function countAllPaths($nodes): int
{
    if ($nodes > 1) {
        return countAllPaths($nodes - 1) + countAllPaths($nodes - 2) + countAllPaths($nodes - 3);
    }

    if ($nodes === 1) {
        return 1;
    }

    return 0;
}

echo solvePartTwo(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');