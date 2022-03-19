<?php
include_once __DIR__ . "/../Model/connection.php";
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

if (isset($_POST['edit'])) {
    header("Location:/../index.php?query=7&edit=1&problem=" . $_POST['problem']);
} else {
    header("Location:/../index.php?query=7&problem=" . $_POST['problem']);
}
