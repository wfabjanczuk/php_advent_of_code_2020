<?php


namespace Day08;


class Instruction
{
    public int $id;
    public string $type;
    public int $argument;

    /**
     * Instruction constructor.
     * @param int $id
     * @param string $type
     * @param int $argument
     */
    public function __construct(int $id, string $type, int $argument)
    {
        $this->id = $id;
        $this->type = $type;
        $this->argument = $argument;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getArgument(): int
    {
        return $this->argument;
    }

    /**
     * @param int $argument
     */
    public function setArgument(int $argument): void
    {
        $this->argument = $argument;
    }
}