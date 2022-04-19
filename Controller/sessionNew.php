<?php
session_start();
include_once __DIR__ . "/../Model/constants.php";
include_once __DIR__ . "/../Model/redirectionUtils.php";
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/professor.php";
include_once __DIR__ . "/../Model/session.php";

$user_type = $_SESSION['user_type'];
if ($user_type != PROFESSOR) {
    redirect_location();
}

$name = $_POST['name'];
$subject_id = $_POST['subject'];
$problem_ids = $_POST['problems'];

$professor_email = $_SESSION['email'];
$professor = getProfessor(professor_email: $professor_email);
$professor_id = $professor['id'];

$session_id = createSession(name:$name, professor_id:$professor_id, subject_id: $subject_id, problem_ids:$problem_ids);
if (!empty($session_id)) {
    redirect_location();
}

redirect_location(VIEW_SESSION_PROBLEMS_LIST, array("session" => $session_id));
