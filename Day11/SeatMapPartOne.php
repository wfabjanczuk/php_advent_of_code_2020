<?php


namespace Day11;


class SeatMapPartOne
{
    private array $map;
    private bool $modified;

    /**
     * SeatMap constructor.
     * @param array $map
     * @param bool $modified
     */
    public function __construct(array $map, bool $modified)
    {
        $this->map = $map;
        $this->modified = $modified;
    }

    /**
     * @return array
     */
    public function getMap(): array
    {
        return $this->map;
    }

    /**
     * @param array $map
     */
    public function setMap(array $map): void
    {
        $this->map = $map;
    }

    /**
     * @return bool
     */
    public function isModified(): bool
    {
        return $this->modified;
    }

    /**
     * @param bool $modified
     */
    public function setModified(bool $modified): void
    {
        $this->modified = $modified;
    }

    public function getNextPointState(int $x, int $y): string
    {
        switch ($this->map[$y][$x]) {
            case '.':
                return '.';
            case 'L':
                return $this->countAdjacentOccupiedSeats($x, $y) === 0
                    ? '#'
                    : 'L';
            case '#':
                return $this->countAdjacentOccupiedSeats($x, $y) >= 4
                    ? 'L'
                    : '#';
        }
    }

    private function countAdjacentOccupiedSeats(int $x, int $y): int
    {
        $adjacentCoordinatePairs = [
            [$x - 1, $y - 1],
            [$x - 1, $y],
            [$x - 1, $y + 1],
            [$x, $y - 1],
            [$x, $y + 1],
            [$x + 1, $y - 1],
            [$x + 1, $y],
            [$x + 1, $y + 1]
        ];

        $adjacentOccupiedCount = 0;
        foreach ($adjacentCoordinatePairs as $pair) {
            $point = $this->map[$pair[1]][$pair[0]] ?? false;
            if ($point === '#') {
                $adjacentOccupiedCount++;
            }
        }

        return $adjacentOccupiedCount;
    }

    public function getAllOccupiedSeats(): int
    {
        $allOccupiedSeats = 0;
        foreach ($this->map as $row) {
            foreach ($row as $point) {
                $allOccupiedSeats += $point === '#'
                    ? 1
                    : 0;
            }
        }
        return $allOccupiedSeats;
    }
}