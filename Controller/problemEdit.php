<?php
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/problemsGet.php";

$problem_id = $_GET["problem"];
$problem = getProblemToSolve($problem_id);
$description = $problem['description'];

include_once __DIR__ . "/../View/html/problemEdit.php";
