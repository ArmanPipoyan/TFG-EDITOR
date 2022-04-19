<?php
session_start();
include_once __DIR__ . "/../Model/constants.php";
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/problemsGet.php";
include_once __DIR__ . "/../Model/session.php";

$session_id = $_GET['session'];
$problems = getProblemsWithSession($session_id);

$user_type = $_SESSION['user_type'];
if ($user_type == STUDENT) {
    $email = $_SESSION['email'];
    addStudentToSession(session_id: $session_id, email:$email);
}

include_once __DIR__ . "/../View/html/sessionProblemsList.php";
