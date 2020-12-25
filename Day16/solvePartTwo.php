<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'FieldValidator.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'TicketsCleaner.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'ColumnNameMatcher.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Reader.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Data.php';

use Day16\ColumnNameMatcher;
use Day16\Reader;
use Day16\TicketsCleaner;

function solvePartTwo(string $filepath): int
{
    $reader = new Reader();
    $data = $reader->read($filepath);

    $cleaner = new TicketsCleaner($data->getValidators());
    $validNearbyTickets = $cleaner->clean($data->getNearbyTickets());

    $columnNameMatcher = new ColumnNameMatcher($data->getValidators());
    $columnNames = $columnNameMatcher->getColumnNames($validNearbyTickets);

    $product = 1;
    $yourTicket = $data->getYourTicket();

    $departureColumns = findDepartureColumns($columnNames);
    foreach ($departureColumns as $departureColumn => $ignoredName) {
        $product *= (int)$yourTicket[$departureColumn];
    }

    return $product;
}

function findDepartureColumns(array $columnNames): array
{
    $departureColumns = [];
    foreach ($columnNames as $column => $name) {
        if (strpos($name, 'departure') === 0) {
            $departureColumns[$column] = $name;
        }
    }
    return $departureColumns;
}

echo solvePartTwo(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');