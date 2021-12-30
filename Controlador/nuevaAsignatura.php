<?php

session_start();

include_once __DIR__ . "/../Model/Conectar.php";
include_once __DIR__. "/../Model/crearProblema.php";

$s=crear_asignatura($_POST["titol"],$_POST["descripcio"],$_POST["curs"]);

echo $_POST["titol"]. " " . $_POST["descripcio"]. " " . $_POST["curs"]. " ";
header("Location:/../index.php");

?>