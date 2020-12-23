<?php

require_once 'Validator.php';
require_once 'PartTwoSolver.php';

use Day04\PartTwoSolver;

echo PartTwoSolver::solve(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');