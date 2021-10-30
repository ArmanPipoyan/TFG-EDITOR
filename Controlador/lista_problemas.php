<?php
//session_start();
include_once __DIR__ . "/../Model/Conectar.php";
include_once __DIR__ . "/../Model/get_problems.php";

$conn=connectaBD();

$data=getProblems();

include_once __DIR__ . "/../Vista/html/mostrarProblemas.php";







?>