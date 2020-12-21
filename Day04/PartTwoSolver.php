<?php


namespace Day04;


class PartTwoSolver
{
    public static function solve(string $filepath): int
    {
        $correct = 0;
        $checklist = self::getChecklist();

        foreach (file($filepath) as $line) {
            if (trim($line) === '') {
                $correct += array_sum($checklist) === 7
                    ? 1
                    : 0;
                $checklist = self::getChecklist();
                continue;
            }

            $pairs = explode(' ', $line);
            foreach ($pairs as $pair) {
                [$key, $value] = explode(':', $pair);

                if (array_key_exists($key, $checklist) && Validator::validateField($key, trim($value))) {
                    $checklist[$key] = 1;
                }
            }
        }
        $correct += array_sum($checklist) === 7
            ? 1
            : 0;

        return $correct;
    }

    private static function getChecklist(): array
    {
        return [
            'byr' => 0,
            'iyr' => 0,
            'eyr' => 0,
            'hgt' => 0,
            'hcl' => 0,
            'ecl' => 0,
            'pid' => 0
        ];
    }
}