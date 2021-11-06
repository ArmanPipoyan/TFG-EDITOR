
<?php
session_start();
include_once __DIR__ . "/../Model/Conectar.php";
include_once __DIR__. "/../Model/login.php";
$mail=$_POST['email'];
$password=$_POST['password'];
$nombre=$email="";
$connexio=connectaBD();

$comprobacion=logIn($connexio,$mail,$password);
if ($comprobacion==true){
    
    //header("Location:/../index.php?accio=6");
    echo "has iniciado sesion correctamente";
    echo $_SESSION['usuario'] ." " . $_SESSION['mail'];

}else{
    //header("Location:/../index.php?accio=4");
    echo "no has iniciado sesion correctamente";

}
header("Location:/../index.php");

?>