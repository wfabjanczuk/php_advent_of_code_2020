<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'Instruction.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Machine.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'PartTwoSolver.php';

use Day08\PartTwoSolver;

$partTwoSolver = new PartTwoSolver(new \Day08\Machine());

echo $partTwoSolver->solve(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');