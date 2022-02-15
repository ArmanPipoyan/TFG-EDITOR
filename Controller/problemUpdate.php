<?php
session_start();
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/problemsGet.php";


$descripcio = $_POST['descripcio'];
$memory = $_POST['memory'];
$time = $_POST['time'];
$id = $_POST['assignatura'];

echo $id . "<br>";

echo $descripcio . "<br>";
echo $time . "<br>";
echo $memory . "<br>";

$s = updateProblem($descripcio, $memory, $time, $id);


header("Location:/../index.php");
