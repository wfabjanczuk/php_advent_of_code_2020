<?php


namespace Day11;


class SeatMapPartTwo
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
                return $this->countFirstVisibleOccupiedSeats($x, $y) === 0
                    ? '#'
                    : 'L';
            case '#':
                return $this->countFirstVisibleOccupiedSeats($x, $y) >= 5
                    ? 'L'
                    : '#';
        }
    }

    private function countFirstVisibleOccupiedSeats(int $x, int $y): int
    {
        $directionVectors = [
            [-1, -1],
            [-1, 0],
            [-1, 1],
            [0, -1],
            [0, 1],
            [1, -1],
            [1, 0],
            [1, 1]
        ];

        $adjacentOccupiedCount = 0;
        foreach ($directionVectors as $directionVector) {
            $point = $this->findFirstVisibleSeat($x, $y, $directionVector);
            if ($point === '#') {
                $adjacentOccupiedCount++;
            }
        }

        return $adjacentOccupiedCount;
    }

    private function findFirstVisibleSeat($x, $y, $direction): ?string
    {
        $i = 1;
        $point = true;

        while ($point !== false) {
            $point = $this->map[$y + $i * $direction[1]][$x + $i * $direction[0]] ?? false;

            if ($point === false) {
                return '';
            }

            if (in_array($point, ['#', 'L'], true)) {
                return $point;
            }

            $i++;
        }
        return '';
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