<?php

function solvePartOne(string $filepath): int
{
    $correct = 0;
    $checklist = getChecklist();

    foreach (file($filepath) as $line) {
        if (trim($line) === '') {
            $correct += array_sum($checklist) === 7
                ? 1
                : 0;
            $checklist = getChecklist();
            continue;
        }

        $pairs = explode(' ', $line);
        foreach ($pairs as $pair) {
            $key = explode(':', $pair)[0];
            if (array_key_exists($key, $checklist)) {
                $checklist[$key] = 1;
            }
        }
    }
    $correct += array_sum($checklist) === 7
        ? 1
        : 0;

    return $correct;
}

function getChecklist(): array
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

echo solvePartOne('input.txt');