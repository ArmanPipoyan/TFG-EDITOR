<?php
session_start();
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/problemNew.php";
include_once __DIR__ . "/../Model/addFilesToProblem.php";

$files = array_filter($_FILES['file']['name']);
$title = $_POST['title'];
$description = $_POST['description'];
$max_memory_usage = $_POST['max_memory_usage'];
$max_execution_time = $_POST['max_execution_time'];
$visibility = $_POST['visibility'];
$language = $_POST['language'];
$route = "./../app/problemes/" . $_POST['title'];
$subject = $_POST['subject'];

# If the title already exists redirect the user to the error view.
if (problemTitleExists($title)) {
    header("Location:/../index.php?query=6");
    return;
}

$created = createProblem(route: $route, title: $title, description: $description, max_memory_usage: $max_memory_usage,
    visibility: $visibility, max_execution_time: $max_memory_usage, language: $language, subject: $subject);

# If any problem arises when creating the problem redirect the user to the error view
if (!$created) {
    header("Location:/../index.php?query=6");
    return;
}

# Create the folder of the problem, by default with 0777 permission
mkdir($route);

uploadFiles($route);

header("Location:/../index.php?query=5");
