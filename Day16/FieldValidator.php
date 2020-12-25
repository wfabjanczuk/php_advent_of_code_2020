<?php


namespace Day16;


class FieldValidator
{
    private string $name;
    private array $ranges;

    public function __construct(string $name, array $ranges)
    {
        $this->name = $name;
        $this->ranges = $ranges;
    }

    public function validate(int $value): bool
    {
        foreach ($this->ranges as $range) {
            if ($range[0] <= $value && $value <= $range[1]) {
                return true;
            }
        }
        return false;
    }

    public function getName(): string
    {
        return $this->name;
    }
}