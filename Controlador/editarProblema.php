<?php
include_once __DIR__ . "/../Model/Conectar.php";
include_once __DIR__ . "/../Model/get_problems.php";
$problema=$_GET["problem"];
$prob=getProblemToSolve($problema);
//print_r($prob);

include_once __DIR__ . "/../Vista/html/editProblem.php";

?>