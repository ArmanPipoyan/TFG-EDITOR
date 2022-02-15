<?php
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/problemsGet.php";

$conn = connectaBD();

$data = getProblems();
$asignatura = $_GET['assignatura'];

include_once __DIR__ . "/../View/html/problemsList.php";
