<?php


namespace Day12;


class ShipPartTwo
{
    private int $waypointLongitude;
    private int $waypointLatitude;
    private int $longitude;
    private int $latitude;

    /**
     * ShipPartTwo constructor.
     * @param int $waypointLongitude
     * @param int $waypointLatitude
     * @param int $longitude
     * @param int $latitude
     */
    public function __construct(int $waypointLongitude, int $waypointLatitude, int $longitude, int $latitude)
    {
        $this->waypointLongitude = $waypointLongitude;
        $this->waypointLatitude = $waypointLatitude;
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
            $this->moveWaypoint($instruction, $argument);
            return;
        }

        if ($instruction === 'F') {
            $this->sail($argument);
            return;
        }

        $this->rotate($instruction, $argument);
    }

    private function moveWaypoint(string $direction, int $argument): void
    {
        switch ($direction) {
            case 'N':
                $this->waypointLatitude += $argument;
                break;
            case 'S':
                $this->waypointLatitude -= $argument;
                break;
            case 'E':
                $this->waypointLongitude += $argument;
                break;
            case 'W':
                $this->waypointLongitude -= $argument;
                break;
        }
    }

    private function sail(int $argument): void
    {
        $this->longitude += $this->waypointLongitude * $argument;
        $this->latitude += $this->waypointLatitude * $argument;
    }

    private function rotate(string $direction, int $argument): void
    {
        $degrees = $argument;
        if ($direction === 'L') {
            $degrees = 360 - $degrees;
        }

        $newLongitude = $this->waypointLongitude;
        $newLatitude = $this->waypointLatitude;

        switch ($degrees) {
            case 0:
                break;
            case 90:
                $newLongitude = $this->waypointLatitude;
                $newLatitude = -$this->waypointLongitude;
                break;
            case 180:
                $newLongitude = -$this->waypointLongitude;
                $newLatitude = -$this->waypointLatitude;
                break;
            case 270:
                $newLongitude = -$this->waypointLatitude;
                $newLatitude = $this->waypointLongitude;
                break;
        }

        $this->waypointLongitude = $newLongitude;
        $this->waypointLatitude = $newLatitude;
    }
}
