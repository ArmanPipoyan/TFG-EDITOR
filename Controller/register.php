<?php
session_start();

include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/register.php";

$name = $_POST["first_name"];
$surname = $_POST["last_name"];
$email = $_POST["email"];
$password = $_POST["password"];
$password2 = $_POST["password_confirmation"];
$hash_password = password_hash($password, PASSWORD_DEFAULT);

$taken = isEmailTaken($email);
if($taken) {
    if (isset($_POST["token"])) {
        $token = $_POST["token"];
        header("Location:/../index.php?query=3&token=" . $token . "&error=3");
    } else {
        header("Location:/../index.php?query=3&error=3");
    }
    return;
}

$student = 1;
if (isset($_POST["token"])) {
    $token = $_POST["token"];
    $token_marked = setTokenUsed($token);

    if (!$token_marked) {
        header("Location:/../index.php?query=3&error=2");
    }

    $registered = registerProfessor($name, $surname, $email, $hash_password);
}
$registered = registerStudent($name, $surname, $email, $hash_password);

if (!$registered) {
    echo "The user was not created";
    return;
}

header("Location:/../index.php");
