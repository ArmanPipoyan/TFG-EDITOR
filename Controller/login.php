<?php
session_start();
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/login.php";
$mail = $_POST['email'];
$password = $_POST['password'];
$nombre = $email = "";
$connexio = connectaBD();

$comprobacion = logInEstudiante($connexio, $mail, $password);
if ($comprobacion == true) {

    echo "has iniciado sesion correctamente";
    echo $_SESSION['usuario'] . " " . $_SESSION['mail'];

} else {

    $comprobacion = logInProfesor($connexio, $mail, $password);
    if ($comprobacion == true) {

        echo "has iniciado sesion correctamente";
        echo $_SESSION['usuario'] . " " . $_SESSION['mail'];

    } else {
        echo "no has iniciado sesion correctamente";
    }

}
header("Location:/../index.php");
