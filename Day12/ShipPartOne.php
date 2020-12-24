<?php


namespace Day12;


class ShipPartOne
{
    private string $direction;
    private int $longitude;
    private int $latitude;

    private const DIRECTIONS = [
        0 => 'E',
        90 => 'S',
        180 => 'W',
        270 => 'N'
    ];

    /**
     * ShipPartOne constructor.
     * @param string $direction
     * @param int $longitude
     * @param int $latitude
     */
    public function __construct(string $direction, int $longitude, int $latitude)
    {
        $this->direction = $direction;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    }

    public function getManhattanDistance()
    {
        return abs($this->longitude) + abs($this->latitude);
    }

    public function navigate(string $instruction, int $argument): void
    {
        if (in_array($instruction, ['N', 'S', 'E', 'W'], true)) {
            $this->sail($instruction, $argument);
            return;
        }

        if ($instruction === 'F') {
            $this->sail($this->direction, $argument);
            return;
        }

        $this->rotate($instruction, $argument);
    }

    private function sail(string $direction, int $argument): void
    {
        switch ($direction) {
            case 'N':
                $this->latitude += $argument;
                break;
            case 'S':
                $this->latitude -= $argument;
                break;
            case 'E':
                $this->longitude += $argument;
                break;
            case 'W':
                $this->longitude -= $argument;
                break;
        }
    }

    private function rotate(string $direction, int $argument): void
    {
        $degrees = $argument;
        if ($direction === 'L') {
            $degrees *= -1;
        }

        $currentDegrees = $this->getCurrentRelativeDegrees();
        $newDegrees = ($currentDegrees + $degrees + 360) % 360;

        $this->direction = self::DIRECTIONS[$newDegrees];
    }

    private function getCurrentRelativeDegrees(): int
    {
        foreach (self::DIRECTIONS as $relativeDegrees => $direction) {
            if ($this->direction === $direction) {
                return $relativeDegrees;
            }
        }
    }
}
