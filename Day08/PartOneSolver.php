<?php


namespace Day08;


class PartOneSolver
{
    private Machine $machine;

    /**
     * PartOneSolver constructor.
     * @param Machine $machine
     */
    public function __construct(Machine $machine)
    {
        $this->machine = $machine;
    }

    public function solve(string $filepath): int
    {
        $instructionList = $this->getInstructionListFromFile($filepath);
        return $this->machine->executeInstructionsUntilDuplicate($instructionList);
    }

    private function getInstructionListFromFile(string $filepath): array
    {
        $instructionList = [];
        $instructionId = 0;

        foreach (file($filepath) as $line) {
            $matches = [];
            preg_match('/(\w+) ([+-]\d+)/', $line, $matches);

            $type = $matches[1];
            $argument = (int)$matches[2];

            $instructionList[$instructionId] = new Instruction($instructionId, $type, $argument);
            $instructionId++;
        }
        return $instructionList;
    }
}