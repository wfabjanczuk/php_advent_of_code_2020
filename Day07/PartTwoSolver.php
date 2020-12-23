<?php


namespace Day07;


class PartTwoSolver
{
    private array $colorChildrenMap = [];

    public function solve(string $filepath): int
    {
        $this->readFile($filepath);
        return $this->countIndividualChildren('shiny gold');
    }

    private function readFile(string $filepath): void
    {
        foreach (file($filepath) as $line) {
            $parts = explode('contain', trim($line));
            $currentColor = trim(explode('bags', $parts[0])[0]);
            $this->colorChildrenMap[$currentColor] = [];

            if (strpos($parts[1], 'no other bags.') !== false) {
                continue;
            }

            $colorCounts = preg_split('/ bag[s., ]+/', trim($parts[1]));
            foreach ($colorCounts as $colorCount) {
                if (trim($colorCount) === '') {
                    continue;
                }

                $matches = [];
                preg_match('/^(\d+) ([\w ]+)$/', $colorCount, $matches);

                $ingredientCount = $matches[1];
                $ingredientColor = $matches[2];
                $this->colorChildrenMap[$currentColor][$ingredientColor] = $ingredientCount;
            }
        }
    }

    private function countIndividualChildren(string $chosenColor): int
    {
        $allChildrenCount = -1;
        $lastStepChildren = [$chosenColor => 1];

        while (!empty($lastStepChildren)) {
            $this->doChildSearchStep($allChildrenCount, $lastStepChildren);
        }

        return $allChildrenCount;
    }

    private function doChildSearchStep(&$allChildrenCount, &$lastStepChildren): void
    {
        $currentStepChildren = [];
        foreach ($lastStepChildren as $testedColor => $testedColorCount) {
            foreach ($this->colorChildrenMap[$testedColor] as $color => $colorCount) {
                $currentStepChildren[$color] ??= 0;
                $currentStepChildren[$color] += $testedColorCount * $colorCount;
            }
        }

        $allChildrenCount += array_sum($lastStepChildren);
        $lastStepChildren = $currentStepChildren;
    }
}