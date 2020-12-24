<?php

function solvePartOne(string $filename): int
{
    $lines = file($filename);
    $timestamp = (int)$lines[0];
    $buses = [];

    $timetable = explode(',', $lines[1]);
    foreach ($timetable as $entry) {
        if ($entry === 'x') {
            continue;
        }
        $buses[] = (int)$entry;
    }

    return findEarliestBus($timestamp, $buses);
}

function findEarliestBus(int $timestamp, array $buses): int
{
    $earliestBusId = null;
    $minDelay = null;

    foreach ($buses as $busId) {
        $remainder = ($timestamp + $busId) % $busId;

        if ($remainder === 0) {
            return 0;
        }
        $delay = $busId - $remainder;

        if ($minDelay === null || $delay < $minDelay) {
            $minDelay = $delay;
            $earliestBusId = $busId;
        }
    }

    return $minDelay * $earliestBusId;
}

echo solvePartOne(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');