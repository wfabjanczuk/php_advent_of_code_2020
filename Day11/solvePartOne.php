<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'SeatMapPartOne.php';

use Day11\SeatMapPartOne;

function solvePartOne(string $filepath): int
{
    $seatMap = getInitialSeatMap($filepath);
    while ($seatMap->isModified()) {
        $seatMap = getNextSeatMap($seatMap);
    }
    return $seatMap->getAllOccupiedSeats();
}

function getInitialSeatMap(string $filepath): SeatMapPartOne
{
    $map = [];

    foreach (file($filepath) as $line) {
        $row = str_split(trim($line));
        $map[] = $row;

    }
    return new SeatMapPartOne($map, true);
}

function getNextSeatMap(SeatMapPartOne $seatMap): SeatMapPartOne
{
    $nextMap = $seatMap->getMap();
    $modified = false;

    foreach ($seatMap->getMap() as $y => $row) {
        foreach ($row as $x => $point) {
            $nextMap[$y][$x] = $seatMap->getNextPointState($x, $y);
            if ($nextMap[$y][$x] !== $point) {
                $modified = true;
            }
        }
    }

    return new SeatMapPartOne($nextMap, $modified);
}

echo solvePartOne(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');