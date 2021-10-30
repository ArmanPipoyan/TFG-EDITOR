<?php
include_once __DIR__ . "/../Model/Conectar.php";
include_once __DIR__ . "/../Model/get_problems.php";

if (isset($_GET["problem"])) {
	$query=$_GET["problem"];
}else{
    header("Location:/../index.php");
}
$data=getProblemToSolve($query);


include_once __DIR__ . "/../Vista/html/Editor.php";

?>