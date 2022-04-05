<?php

session_start();

include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/redirectionUtils.php";
include_once __DIR__ . "/../Model/problemNew.php";

$title = $_POST["title"];
$description = $_POST["description"];
$course = $_POST["course"];

$created = createSubject($title, $description, $course);

if (!$created) {
    echo "Error creating the subject";
    return;
}

redirect_location();
