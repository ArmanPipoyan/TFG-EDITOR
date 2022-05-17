<?php
session_start();

include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/constants.php";
include_once __DIR__ . "/../Model/redirectionUtils.php";
include_once __DIR__ . "/../Model/register.php";

$name = $_POST["first_name"];
$surname = $_POST["last_name"];
$email = $_POST["email"];
$password = $_POST["password"];
$password2 = $_POST["password_confirmation"];
$hash_password = password_hash($password, PASSWORD_DEFAULT);

$taken = isEmailTaken($email);
if($taken) {
    $params = array(
        "error" => 3,
    );
    if (isset($_POST["token"])) {
        $params += ["token" => $_POST["token"]];
    }
    redirectLocation(query: VIEW_REGISTER_FORM, params: $params);
}

$student = 1;
if (isset($_POST["token"])) {
    $token = $_POST["token"];
    $token_marked = setTokenUsed($token);

    if (!$token_marked) {
        redirectLocation(query: VIEW_REGISTER_FORM, params: array("error" => 2));
    }

    $registered = registerProfessor($name, $surname, $email, $hash_password);
}
$registered = registerStudent($name, $surname, $email, $hash_password);

if (!$registered) {
    echo "The user was not created";
    return;
}

redirectLocation();
