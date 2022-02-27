<?php
session_start();
// Sesion tipo 0 es un profesor $_SESSION['tipo']=0;
// Sesio tipo 1 es un estudiante $_SESSION['tipo']=1;

if (isset($_GET["code"])) {
    $_SESSION["code"] = $_GET["code"];
    print_r($_SESSION);
}

if (isset($_GET["query"])) {
    $query = $_GET["query"];
} else {
    $query = 8;
}

if (isset($_SESSION["mail"])) {
    // professor sin restriccion
    $conectado = 1;
    if ($_SESSION['tipo'] == 1) {// alumno  1 8 7
        if ($query != 8 & $query != 1 & $query != 7 & $query != 9) {
            header("Location:/index.php");
        }
    }
} else {
    $conectado = 0;
    if ($query != 8 & $query != 2 & $query != 3) {
        header("Location:/index.php?err=1");
    }
}


switch ($query) {
    case 1: //Lista de problemas de la home
        include __DIR__ . "/View/html/header.php";
        include __DIR__ . "/Controller/problemList.php";
        include __DIR__ . "/View/html/footer.html";
        break;
    case 2: // Formulario de login
        include __DIR__ . "/View/html/header.php";
        include __DIR__ . "/View/html/login.html";
        include __DIR__ . "/View/html/footer.html";
        break;
    case 3: // Formulario de registro
        include __DIR__ . "/View/html/header.php";
        include __DIR__ . "/View/html/register.php";
        include __DIR__ . "/View/html/footer.html";
        break;
    case 4: // Formulario para crear problema
        include __DIR__ . "/View/html/header.php";
        include __DIR__ . "/View/html/problemNew.php";
        include __DIR__ . "/View/html/footer.html";
        break;
    case 5: // Pantalla de prorblema creado OK
        include __DIR__ . "/View/html/header.php";
        include __DIR__ . "/View/html/problemCreationSuccessful.php";
        include __DIR__ . "/View/html/footer.html";
        break;
    case 6: // Pantalla de problema no creado
        include __DIR__ . "/View/html/header.php";
        include __DIR__ . "/View/html/problemCreationError.php";
        include __DIR__ . "/View/html/footer.html";
        break;
    case 7: // Editor de codigo
        include __DIR__ . "/View/html/header.php";
        include __DIR__ . "/Controller/editor.php";
        include __DIR__ . "/View/html/footer.html";
        break;
    case 8: // Mostrar asignaturas
        include __DIR__ . "/View/html/header.php";
        include __DIR__ . "/Controller/subjectList.php";
        include __DIR__ . "/View/html/footer.html";
        break;
    case 9: // Mostrar asignaturas
        include __DIR__ . "/View/html/header.php";
        include __DIR__ . "/View/html/test.php";
        include __DIR__ . "/View/html/footer.html";
        break;
    case 10: // Crear asignaturas
        include __DIR__ . "/View/html/header.php";
        include __DIR__ . "/View/html/subjectNew.php";
        include __DIR__ . "/View/html/footer.html";
        break;
    case 11: // Crear asignaturas
        include __DIR__ . "/View/html/header.php";
        include __DIR__ . "/Model/zipFolder.php";
        include __DIR__ . "/View/html/footer.html";
        break;
    case 12: // Crear asignaturas
        include __DIR__ . "/View/html/header.php";
        include __DIR__ . "/Controller/problemEdit.php";
        include __DIR__ . "/View/html/footer.html";
        break;
}


?>