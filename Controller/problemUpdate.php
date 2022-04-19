<?php
session_start();
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/redirectionUtils.php";
include_once __DIR__ . "/../Model/problemsGet.php";


$description = $_POST['description'];
$max_memory_usage = $_POST['max_memory_usage'];
$max_execution_time = $_POST['max_execution_time'];
$problem_id = $_POST["problem_id"];

updateProblem(problem_id: $problem_id,description: $description, max_memory_usage: $max_memory_usage,
    max_execution_time: $max_execution_time);

redirect_location();
