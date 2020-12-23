<?php


namespace Day07;


class PartOneSolver
{
    private array $colorAncestorsMap = [];

    public function solve(string $filepath): int
    {
        $this->readFile($filepath);
        return $this->countAncestors('shiny gold');
    }

    private function readFile(string $filepath): void
    {
        foreach (file($filepath) as $line) {
            $parts = explode('contain', trim($line));
            $currentColor = trim(explode('bags', $parts[0])[0]);

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

                $ancestorColor = $matches[2];
                $this->colorAncestorsMap[$ancestorColor] ??= [];
                $this->colorAncestorsMap[$ancestorColor][$currentColor] = true;
            }
        }
    }

    private function countAncestors(string $chosenColor): int
    {
        $allAncestors = [];
        $lastStepAncestors = [$chosenColor => true];

        while (!empty($lastStepAncestors)) {
            $this->doAncestorSearchStep($allAncestors, $lastStepAncestors);
        }

        return count($allAncestors);
    }

    private function doAncestorSearchStep(&$allAncestors, &$lastStepAncestors): void
    {
        $currentStepAncestors = [];
        foreach ($lastStepAncestors as $testedColor => $ignored) {
            if (!isset($this->colorAncestorsMap[$testedColor])) {
                continue;
            }

            foreach ($this->colorAncestorsMap[$testedColor] as $ancestorColor => $ignored2) {
                $allAncestors[$ancestorColor] = true;
                $currentStepAncestors[$ancestorColor] = true;
            }
        }
        $lastStepAncestors = $currentStepAncestors;
    }
}