<?php
session_start();

include_once __DIR__ . "/../Model/Conectar.php";
include_once __DIR__ . "/../Model/registrarse.php";
$conn=connectaBD();

$name=$_POST["first_name"];
$apellido=$_POST["last_name"];
$email=$_POST["email"];
$contraseña=$_POST["password"];
$contraseña2=$_POST["password_confirmation"];
$hash_password=password_hash($contraseña,PASSWORD_DEFAULT);
echo ($hash_password);
$reg=array("options"=>array("regexp"=>"/^[A-Z]+$/i;"));
$valid = registrar_estudiant($name,$apellido,$email,$hash_password,$reg)

?>