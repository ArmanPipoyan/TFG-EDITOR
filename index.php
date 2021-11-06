<?php
session_start();
//$s = file_get_contents("app/temp/5db7d3b.cpp");
//$_SESSION['filename']="/app/temp/5db7d3b.cpp";

if (isset($_GET["query"])) {
	$query=$_GET["query"];
}else{
        $query = 1;
}

switch ($query) {
    case 1: //Lista de problemas de la home
        include __DIR__ . "/Vista/html/Header.php"; 
        include __DIR__ . "/Controlador/lista_problemas.php"; 
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

    case 4: // Formulario para crear problema
        include __DIR__ . "/Vista/html/Header.php"; 
        include __DIR__ . "/Vista/html/NewProblem.php"; 
        include __DIR__ . "/Vista/html/Footer.html"; 
        break;
    case 5: // Pantalla de prorblema creado OK
        include __DIR__ . "/Vista/html/Header.php"; 
        include __DIR__ . "/Vista/html/Problema_satisfactori.php"; 
        include __DIR__ . "/Vista/html/Footer.html"; 
        break;
    case 6: // Pantalla de problema no creado
        include __DIR__ . "/Vista/html/Header.php"; 
        include __DIR__ . "/Vista/html/problema_error.php"; 
        include __DIR__ . "/Vista/html/Footer.html"; 
        break;
    case 7: // Editor de codigo
        include __DIR__ . "/Vista/html/Header.php"; 
        include __DIR__ . "/Controlador/editor.php";
        include __DIR__ . "/Vista/html/Footer.html"; 
        break;
}


?>