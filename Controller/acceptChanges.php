<?php
session_start();
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/problemsGet.php";

$mail=$_SESSION['mail'];
$id=$_POST["id"];

echo "El email es " . $mail . " y el problema es ". $id ."<br>";

$data=getProblemToSolve($id);
$asignatura=$data["AsignaturaID"];
$ruta=$data["Ruta"];
$dir = str_replace('\\', '/', realpath(__DIR__ . $ruta));
$files = scandir($dir);

echo $dir;

$pegar=str_replace('\\', '/', realpath(__DIR__ . "./../app/solucions/".$_SESSION['mail']."/".$data["Title"])); //modificar para cada alumno

echo "<br>".$pegar;
updateSolucionActualziada($id,$mail);
foreach($files as $file) {
    if($file === '.' || $file === "..") {continue;}
    $path = $dir .'/'. $file;
    $peg=$pegar. '/' .$file;
    if(is_file($path)) {
      copy($path, $peg);
    }
  }


?>