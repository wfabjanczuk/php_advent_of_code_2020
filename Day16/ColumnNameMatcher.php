<?php


namespace Day16;


class ColumnNameMatcher
{
    private array $validators;

    public function __construct(array $validators)
    {
        $this->validators = $validators;
    }

    public function getColumnNames(array $tickets): array
    {
        $matchedColumnNames = [];
        $possibleColumnNames = [];

        $columns = range(0, count($tickets[0]) - 1);
        foreach ($columns as $column) {
            $possibleColumnNames[$column] = $this->findPossibleColumnNames($column, $tickets);
        }

        while (count($possibleColumnNames) > 0) {
            $this->findCertainMatch($possibleColumnNames, $matchedColumnNames);
        }

        return $matchedColumnNames;
    }

    private function findPossibleColumnNames(int $c, array $tickets): array
    {
        $possibleNames = [];
        foreach ($this->validators as $validator) {
            $validatorMatch = true;
            foreach ($tickets as $ticket) {
                if (!$validator->validate((int)$ticket[$c])) {
                    $validatorMatch = false;
                }
            }
            if ($validatorMatch) {
                $possibleNames[] = $validator->getName();
            }
        }
        return $possibleNames;
    }

    private function findCertainMatch(array &$possibleColumnNames, array &$matchedColumnNames): void
    {
        $matchedColumn = null;
        $matchedName = null;

        foreach ($possibleColumnNames as $column => $possibleNames) {
            if (count($possibleNames) === 1) {
                $matchedColumn = $column;
                $matchedName = reset($possibleNames);

                $matchedColumnNames[$matchedColumn] = $matchedName;
                break;
            }
        }

        unset($possibleColumnNames[$matchedColumn]);
        foreach ($possibleColumnNames as $column => &$possibleNames) {
            $possibleNames = array_diff($possibleNames, [$matchedName]);
        }
        unset($possibleNames);
    }
}