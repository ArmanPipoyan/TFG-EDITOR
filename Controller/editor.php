<?php
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/problemsGet.php";


if (isset($_GET["problem"])) {
    $query = $_GET["problem"];
} else {
    header("Location:/../index.php");
}
$copiar = False;
if (isset($_GET["reiteratiu"]) && isset($_GET["usuario"])) {
    if ($_GET["reiteratiu"] == 1) {
        $usuarioCopiar = $_GET["usuario"];
        $copiar = True;
        $data3 = modifySolucionToSolve($query, $usuarioCopiar, 1, 0);
    } elseif ($_GET["reiteratiu"] == 2) {
        $usuarioCopiar = $_GET["usuario"];
        $copiar = True;
    } else {
        header("Location:/../index.php");
    }
}
$data = getProblemToSolve($query);
$asignatura = $data["subject_id"];
$ruta = $data["route"];
$dir = str_replace('\\', '/', realpath(__DIR__ . $ruta));
$files = scandir($dir);

$existe = True;
if ($copiar == True) {
    $variable = './../app/solucions/' . $usuarioCopiar;
} else {
    $variable = './../app/solucions/' . $_SESSION['mail'];
}

if (!file_exists(__DIR__ . $variable)) {
    if (mkdir(__DIR__ . $variable)) {
        //echo "La carpeta se ha creado";
        $existe = False;
    } else {
        echo 'Failed to create folder';
    }
}

if ($copiar == True) {
    $variable = './../app/solucions/' . $usuarioCopiar . "/" . $data["title"];
} else {
    $variable = './../app/solucions/' . $_SESSION['mail'] . "/" . $data["title"];
}

if (!file_exists(__DIR__ . $variable)) {
    if (mkdir(__DIR__ . $variable)) {
        //echo "La carpeta se ha creado";
        $existe = False;
    }
}

//Variale para cargar ruta del archivo
if ($copiar == True) {
    $pegar = str_replace('\\', '/', realpath(__DIR__ . "./../app/solucions/" . $usuarioCopiar . "/" . $data["title"])); //modificar para cada alumno
} else {
    $pegar = str_replace('\\', '/', realpath(__DIR__ . "./../app/solucions/" . $_SESSION['mail'] . "/" . $data["title"])); //modificar para cada alumno
}

//Si no existe la carpeta con el problema se crea aqui
if (!$existe) {
    foreach ($files as $file) {
        if ($file === '.' || $file === "..") {
            continue;
        }
        $path = $dir . '/' . $file;
        $peg = $pegar . '/' . $file;
        if (is_file($path)) {
            copy($path, $peg);
        }
    }
    $usuario = $_SESSION['mail'];
    //ruta donde se guarda, id del problema, id assignatura
    insert_Solution($pegar, $query, $asignatura, $usuario);
}


if ($_SESSION['tipo'] == 0) {
    $datas = getAlumnos($query);
}

$sol = getSolucion($query, $_SESSION['mail']);
include_once __DIR__ . "/../View/html/editor.php";
