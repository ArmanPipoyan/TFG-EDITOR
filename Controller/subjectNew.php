<?php

session_start();

include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/problemNew.php";

$s = crear_asignatura($_POST["titol"], $_POST["descripcio"], $_POST["curs"]);

echo $_POST["titol"] . " " . $_POST["descripcio"] . " " . $_POST["curs"] . " ";
header("Location:/../index.php");
