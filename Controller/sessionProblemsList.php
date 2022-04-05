<?php
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/problemsGet.php";

$session_id = $_GET['session'];
$problems = getProblemsWithSession($session_id);

include_once __DIR__ . "/../View/html/sessionProblemsList.php";
