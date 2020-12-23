<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'Validator.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'PartTwoSolver.php';

use Day04\PartTwoSolver;

echo PartTwoSolver::solve(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');