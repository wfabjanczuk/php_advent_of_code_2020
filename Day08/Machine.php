<?php


namespace Day08;


class Machine
{
    private int $accumulator;
    private bool $success;
    private array $executedInstructionList;

    public function __construct()
    {
        $this->resetMachineState();
    }

    public function resetMachineState(): void
    {
        $this->success = false;
        $this->accumulator = 0;
        $this->executedInstructionList = [];
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function executeInstructionsUntilDuplicate(array $instructionList): int
    {
        $instructionListCount = count($instructionList);
        $nextInstructionId = 0;

        /** @var Instruction $currentInstruction */
        while (0 <= $nextInstructionId && $nextInstructionId < $instructionListCount) {
            $currentInstruction = $instructionList[$nextInstructionId];
            if (in_array($currentInstruction->getId(), $this->executedInstructionList, true)) {
                return $this->accumulator;
            }

            switch ($currentInstruction->getType()) {
                case 'jmp':
                    $nextInstructionId = $currentInstruction->getId() + $currentInstruction->getArgument();
                    break;
                case 'acc':
                    $this->accumulator += $currentInstruction->getArgument();
                case 'nop':
                    $nextInstructionId = $currentInstruction->getId() + 1;
            }
            $this->executedInstructionList[] = $currentInstruction->getId();
        }

        if ($nextInstructionId === $instructionListCount) {
            $this->success = true;
        }
        return $this->accumulator;
    }
}