<?php


namespace Day08;


use RuntimeException;

class PartTwoSolver
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

        foreach ($instructionList as &$instruction) {
            if (!$this->toggleInstructionType($instruction)) {
                continue;
            }

            $this->machine->resetMachineState();
            $accumulator = $this->machine->executeInstructionsUntilDuplicate($instructionList);

            if ($this->machine->isSuccess()) {
                return $accumulator;
            }
            $this->toggleInstructionType($instruction);
        }
        unset($instruction);

        throw new RuntimeException('No solution.');
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

    private function toggleInstructionType(Instruction $instruction): bool
    {
        switch ($instruction->getType()) {
            case 'jmp':
                $instruction->setType('nop');
                return true;
            case 'nop':
                $instruction->setType('jmp');
                return true;
        }
        return false;
    }
}