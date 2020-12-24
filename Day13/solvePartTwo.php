<?php

function solvePartTwo(string $filename): int
{
    $lines = file($filename);
    $buses = [];

    $timetable = explode(',', $lines[1]);
    $dt = 0;
    foreach ($timetable as $entry) {
        if ($entry === 'x') {
            $dt++;
            continue;
        }
        $buses[$dt++] = (int)$entry;
    }
    return findMatchingTimestamp($buses);
}

function findMatchingTimestamp(array $buses): int
{
    $firstDelay = array_key_first($buses);
    $timestamp = $buses[$firstDelay] - $firstDelay;
    $dt = $buses[$firstDelay];

    $maxSliceLength = count($buses);
    foreach (range(2, $maxSliceLength) as $sliceLength) {
        $busesSlice = array_slice($buses, 0, $sliceLength, true);
        $timestamp = findMatchingTimestampForSlice($busesSlice, $timestamp, $dt);
        $dt = array_product($busesSlice);
    }

    return $timestamp;
}

function findMatchingTimestampForSlice(array $busesSlice, int $timestamp, int $dt): int
{
    $requiredDelay = array_key_last($busesSlice);
    $nextBusId = $busesSlice[$requiredDelay];

    while (!isTimestampValidForNextBus($timestamp, $requiredDelay, $nextBusId)) {
        $timestamp += $dt;
    }

    return $timestamp;
}

function isTimestampValidForNextBus(int $timestamp, $requiredDelay, $nextBusId): bool
{
    $remainder = ($timestamp + $nextBusId) % $nextBusId;
    $delay = ($remainder !== 0)
        ? $nextBusId - $remainder
        : 0;

    while ($delay < $requiredDelay) {
        $delay += $nextBusId;
    }

    return $requiredDelay === $delay;
}

echo solvePartTwo(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');