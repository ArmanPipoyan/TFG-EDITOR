<?php
include_once __DIR__ . "/../Model/Conectar.php";
include_once __DIR__ . "/../Model/get_problems.php";
$connexio=connectaBD();

$data=getSubjects();

include_once __DIR__ . "/../Vista/html/mostraAsignaturas.php";


?>