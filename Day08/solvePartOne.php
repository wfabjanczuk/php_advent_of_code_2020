<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'Instruction.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Machine.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'PartOneSolver.php';

use Day08\PartOneSolver;

$partOneSolver = new PartOneSolver(new \Day08\Machine());

echo $partOneSolver->solve(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');