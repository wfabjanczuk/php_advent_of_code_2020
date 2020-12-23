<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'PartTwoSolver.php';

use Day07\PartTwoSolver;

$partTwoSolver = new PartTwoSolver();
echo $partTwoSolver->solve(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');
