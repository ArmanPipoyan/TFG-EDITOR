<?php
session_start();
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/constants.php";
include_once __DIR__ . "/../Model/redirectionUtils.php";
include_once __DIR__ . "/../Model/problemNew.php";
include_once __DIR__ . "/../Model/addFilesToProblem.php";

$title = $_POST['title'];
$description = $_POST['description'];
$max_memory_usage = $_POST['max_memory_usage'];
$max_execution_time = $_POST['max_execution_time'];
$visibility = $_POST['visibility'];
$language = $_POST['language'];
$route = "./../app/problemes/" . $_POST['title'];
$subjectId = $_POST['subject'];

# If the title already exists redirect the user to the error view.
if (problemTitleExists($title)) {
    $_SESSION['error'] = "Un problema amb el mateix nom ja existeix: $title";
    redirectLocation(query: VIEW_PROBLEM_ERROR_CREATING);
    return;
}

$created = createProblem(route: $route, title: $title, description: $description, max_memory_usage: $max_memory_usage,
    visibility: $visibility, max_execution_time: $max_execution_time, language: $language, subject: $subjectId);

# If any problem arises when creating the problem redirect the user to the error view
if (!$created) {
    $_SESSION['error'] = "Error desconegut al crear el problema a la BDD";
    redirectLocation(query: VIEW_PROBLEM_ERROR_CREATING);
    return;
}

# Create the folder of the problem, by default with 0777 permission
mkdir($route);

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

redirectLocation(query: VIEW_PROBLEM_CREATED);
