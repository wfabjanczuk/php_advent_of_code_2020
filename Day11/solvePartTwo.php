<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'SeatMapPartTwo.php';

use Day11\SeatMapPartTwo;

function solvePartTwo(string $filepath): int
{
    $seatMap = getInitialSeatMap($filepath);
    while ($seatMap->isModified()) {
        $seatMap = getNextSeatMap($seatMap);
    }
    return $seatMap->getAllOccupiedSeats();
}

function getInitialSeatMap(string $filepath): SeatMapPartTwo
{
    $map = [];

    foreach (file($filepath) as $line) {
        $row = str_split(trim($line));
        $map[] = $row;

    }
    return new SeatMapPartTwo($map, true);
}

function getNextSeatMap(SeatMapPartTwo $seatMap): SeatMapPartTwo
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

    return new SeatMapPartTwo($nextMap, $modified);
}

echo solvePartTwo(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');