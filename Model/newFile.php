<?php
session_start();
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/problemsGet.php";
$file = $_POST['filename'];
$edited = $_POST['edited'];
$problema = $_POST['problema'];
$dir = str_replace('\\', '/', realpath(urldecode($_POST['dir'])));

if ($edited == 1) {
    echo "CAMBIOS EN RAIZ";
    updateProblemSolve($problema);
} else {
    echo "No hay cambios en raiuz";
}
echo $dir;

$dst = $dir . '/' . $file;


//Check if it should be a folder or file
if (strpos($file, '.') > 1) {
    if (touch($dst)) {
        echo true;
    } else {
        echo 'Failed to create file';
    }
}
