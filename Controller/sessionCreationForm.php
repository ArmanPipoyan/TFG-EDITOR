<?php
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/problemsGet.php";

$subject_id = $_GET['subject'];
$problems = getProblemsWithSubject($subject_id);

include_once __DIR__ . "/../View/html/sessionNew.php";
