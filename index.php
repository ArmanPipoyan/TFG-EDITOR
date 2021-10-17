<?php
session_start();
$s = file_get_contents("app/temp/5db7d3b.cpp");
//$_SESSION['filename']="/app/temp/5db7d3b.cpp";

if (isset($_GET["query"])) {
	$query=$_GET["query"];
}else{
        $query = 1;
}

switch ($query) {
    case 1: //Editor donde se puede editar codigo
        include __DIR__ . "/Vista/html/Header.php"; 
        include __DIR__ . "/Vista/html/Editor.html"; 
        include __DIR__ . "/Vista/html/Footer.html"; 

        break;
	case 2: // Formulario de login
		include __DIR__ . "/Vista/html/Header.php"; 
        include __DIR__ . "/Vista/html/Login.html"; 
        include __DIR__ . "/Vista/html/Footer.html"; 
        break;

    case 3: // Formulario de registro
        include __DIR__ . "/Vista/html/Header.php"; 
        include __DIR__ . "/Vista/html/Registro.html"; 
        include __DIR__ . "/Vista/html/Footer.html"; 
        break;
}


?>