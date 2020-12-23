<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'PartOneSolver.php';

use Day07\PartOneSolver;

$partOneSolver = new PartOneSolver();
echo $partOneSolver->solve(__DIR__ . DIRECTORY_SEPARATOR . 'input.txt');
