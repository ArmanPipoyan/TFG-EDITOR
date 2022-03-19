<?php
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/problemsGet.php";

$conn = connectDB();

$subject_id = $_GET['subject'];
$problems = getProblems($subject_id);

include_once __DIR__ . "/../View/html/problemsList.php";
