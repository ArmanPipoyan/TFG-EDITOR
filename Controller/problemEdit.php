<?php
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/problemsGet.php";
$problema = $_GET["problem"];
$prob = getProblemToSolve($problema);

include_once __DIR__ . "/../View/html/problemEdit.php";
