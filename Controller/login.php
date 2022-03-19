<?php
session_start();
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/login.php";
include_once __DIR__ . "/../Model/constants.php";

$email = $_POST['email'];
$password = $_POST['password'];

$logged_in = logInStudent($email, $password);

if (!$logged_in) {
    $logged_in = logInProfessor($email, $password);
    if (!$logged_in) {
        echo "Not logged in";
    }
}

header("Location:/../index.php");
