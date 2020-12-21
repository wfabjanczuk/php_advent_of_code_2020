<?php


namespace Day04;


class Validator
{
    public static function validateField($key, $value): bool
    {
        switch ($key) {
            case 'byr':
                return self::validateYear($value, 1920, 2002);
            case 'iyr':
                return self::validateYear($value, 2010, 2020);
            case 'eyr':
                return self::validateYear($value, 2020, 2030);
            case 'hgt':
                return self::validateHeight($value);
            case 'hcl':
                return self::validateHairColor($value);
            case 'ecl':
                return self::validateEyeColor($value);
            case 'pid':
                return self::validatePassportId($value);
            default:
                return false;
        }
    }

    private static function validateYear($value, int $minYear, int $maxYear): bool
    {
        return preg_match('/^\d{4}$/', $value) && $minYear <= (int)$value && (int)$value <= $maxYear;
    }

    private static function validateHeight($value): bool
    {
        $matchResult = [];
        if (preg_match('/^(\d+)(cm|in)$/', $value, $matchResult) !== 1) {
            return false;
        }

        $number = (int)$matchResult[1];
        $unit = $matchResult[2];

        if ($unit === 'cm') {
            return 150 <= $number && $number <= 193;
        }
        return 59 <= $number && $number <= 76;
    }

    private static function validateHairColor($value): bool
    {
        return preg_match('/^#([\da-f]{6})$/', $value) === 1;
    }

    private static function validateEyeColor($value): bool
    {
        return in_array($value, ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'], true);
    }

    private static function validatePassportId($value): bool
    {
        return preg_match('/^\d{9}$/', $value) === 1;
    }
}