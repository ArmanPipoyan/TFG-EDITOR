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

try {
    uploadFiles($route, $_FILES);
} catch (WrongFileExtension | FileTooLarge $e) {
    $_SESSION['error'] = $e->getMessage();
    redirectLocation(query: VIEW_PROBLEM_ERROR_CREATING);
    return;
} catch (Exception) {
    $_SESSION['error'] = "Error desconegut";
    redirectLocation(query: VIEW_PROBLEM_ERROR_CREATING);
    return;
}

$params = array(
    "problem" => $_POST['problem'],
);
if (isset($_POST['edit'])) {
    $params += ["edit" => 1];
}

redirectLocation(query:VIEW_EDITOR, params: $params);
