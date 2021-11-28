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
$estudiant=1;
$valid=1;

$numero=get_users($email);
if ($numero==0) {
    if(isset($_POST["token"])){
        $token=$_POST["token"];
        $estudiant=0;
        $val= checkToken($token);
    
    }
    $reg=array("options"=>array("regexp"=>"/^[A-Z]+$/i;"));
    if ($estudiant==1) {
        #echo "ENTRAMOS A REGISTRAR ESTUDIANTE DE MAENRA CORRECTA";
        $valid = registrar_estudiant($name,$apellido,$email,$hash_password,$reg);
        header("Location:/../index.php");
    }else {
        if ($val!="") {
            #echo "ENTRAMOS A REGISTRAR PROFESSOR DE MAENRA CORRECTA";
            $valid = registrar_professor($name,$apellido,$email,$hash_password,$reg);
            header("Location:/../index.php");
        }else {
            #echo "NO REGSTRAMOS A PROFESSOR YA QUE TOKEN ES INVALIDO " . $val;
            header("Location:/../index.php?query=3&error=2");
        }
        
        
    }
    
}else {
    #echo "el usuario existe <br>";
    if(isset($_POST["token"])){
        $token=$_POST["token"];
        header("Location:/../index.php?query=3&token=".$token."&error=3");
    }else {
        header("Location:/../index.php?query=3&error=3");
    }
    
}



?>