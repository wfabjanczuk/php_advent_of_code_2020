<?php


namespace Day15;


class NumberFinder
{
    private int $lastNumber;
    private array $preLastOccurrences;
    private array $lastOccurrences;

    public function __construct()
    {
        $this->resetState();
    }

    private function resetState(): void
    {
        $this->lastNumber = -1;
        $this->preLastOccurrences = [];
        $this->lastOccurrences = [];
    }

    public function findNumberAtTurn(int $givenTurn, array $startingNumbers): int
    {
        $this->resetState();

        $startingNumbersCount = count($startingNumbers);
        for ($turn = 1; $turn <= $startingNumbersCount; $turn++) {
            $currentNumber = $startingNumbers[$turn - 1];
            $this->lastOccurrences[$currentNumber] = $turn;
            $this->lastNumber = $currentNumber;
        }

        while ($turn < $givenTurn) {
            $currentNumber = $this->findCurrentNumber();
            if (array_key_exists($currentNumber, $this->lastOccurrences)) {
                $this->preLastOccurrences[$currentNumber] = $this->lastOccurrences[$currentNumber];
            }

            $this->lastOccurrences[$currentNumber] = $turn;
            $this->lastNumber = $currentNumber;
            $turn++;
        }

        return $this->findCurrentNumber();
    }

    private function findCurrentNumber(): int
    {
        if (array_key_exists($this->lastNumber, $this->preLastOccurrences)) {
            return $this->lastOccurrences[$this->lastNumber] - $this->preLastOccurrences[$this->lastNumber];
        }
        return 0;
    }
}