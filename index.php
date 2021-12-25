<?php
session_start();
//$s = file_get_contents("app/temp/5db7d3b.cpp");
//$_SESSION['filename']="/app/temp/5db7d3b.cpp";
// Sesion tipo 0 es un profesor $_SESSION['tipo']=0;
// Sesio tipo 1 es un estudiante $_SESSION['tipo']=1;

if (isset($_GET["query"])) {
	$query=$_GET["query"];
}else{
        $query = 8;
}


if (isset($_SESSION["mail"])) {
    // professor sin restriccion
    $conectado=1;
    if ($_SESSION['tipo']==1) {// alumno  1 8 7
        if ($query!=8&$query!=1&$query!=7&$query!=9) {
            header("Location:/index.php");
        }
    }
    
}else {
    $conectado=0;
    if ($query!=8&$query!=2&$query!=3) {
        header("Location:/index.php?err=1");
    }
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
        include __DIR__ . "/Vista/html/Registro.php"; 
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

    case 8: // Mostrar asignaturas
        include __DIR__ . "/Vista/html/Header.php"; 
        include __DIR__ . "/Controlador/lista_asignaturas.php";
        include __DIR__ . "/Vista/html/Footer.html"; 
        break;
    case 9: // Mostrar asignaturas
        include __DIR__ . "/Vista/html/Header.php"; 
        include __DIR__ . "/Vista/html/test.php";
        include __DIR__ . "/Vista/html/Footer.html"; 
        break;
    case 10: // Crear asignaturas
        include __DIR__ . "/Vista/html/Header.php"; 
        include __DIR__ . "/Vista/html/crearAsignatura.php";
        include __DIR__ . "/Vista/html/Footer.html"; 
        break;
}


?>