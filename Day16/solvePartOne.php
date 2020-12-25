<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'FieldValidator.php';

use Day16\FieldValidator;

function solvePartOne(string $filepath): int
{
    $validators = [];
    $errorSum = 0;

    $rangesSection = true;
    $nearbyTicketsSection = false;

    foreach (file($filepath) as $line) {
        if (trim($line) === '') {
            continue;
        }
        if (preg_match('/your ticket:/', $line)) {
            $rangesSection = false;
            continue;
        }
        if (preg_match('/nearby tickets:/', $line)) {
            $nearbyTicketsSection = true;
            continue;
        }
        if ($rangesSection) {
            $validators[] = getValidator($line);
            continue;
        }
        if ($nearbyTicketsSection) {
            $errorSum += getErrorSum($validators, $line);
        }
    }

    return $errorSum;
}

function getValidator(string $line): FieldValidator
{
    $matches = [];
    preg_match('/([\w ]+): (\d+)-(\d+) or (\d+)-(\d+)/', $line, $matches);
    $name = $matches[1];

    return new FieldValidator($name, [
        [(int)$matches[2], (int)$matches[3]],
        [(int)$matches[4], (int)$matches[5]]
    ]);
}

function getErrorSum(array $validators, string $line): int
{
    $errorSum = 0;
    $values = explode(',', $line);
    foreach ($values as $value) {
        $error = true;
        foreach ($validators as $validator) {
            if ($validator->validate((int)$value)) {
                $error = false;
            }
        }
        $errorSum += $error ? (int)$value : 0;
    }
    return $errorSum;
}

echo solvePartOne(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');