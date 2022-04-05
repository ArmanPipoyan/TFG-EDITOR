<?php
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/constants.php";
include_once __DIR__ . "/../Model/redirectionUtils.php";
include_once __DIR__ . "/../Model/problemsGet.php";
include_once __DIR__ . "/../Model/addFilesToProblem.php";
session_start();

$files = array_filter($_FILES['file']['name']);
$route = str_replace('\\', '/', realpath($_POST['token']));

if (isset($_POST['edit'])) {
    # Set the solution as edited for the students
    setSolutionAsEdited($_POST['problem']);
}

uploadFiles($route, $_FILES);

$params = array(
    "problem" => $_POST['problem'],
);
if (isset($_POST['edit'])) {
    $params += ["edit" => 1];
}

redirect_location(query:VIEW_EDITOR, params: $params);
