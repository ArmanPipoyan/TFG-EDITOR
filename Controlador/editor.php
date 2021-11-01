<?php
include_once __DIR__ . "/../Model/Conectar.php";
include_once __DIR__ . "/../Model/get_problems.php";



if (isset($_GET["problem"])) {
	$query=$_GET["problem"];
}else{
    header("Location:/../index.php");
}
$data=getProblemToSolve($query);

$ruta=$data["Ruta"];
//echo $ruta . '<br>';
$dir = str_replace('\\', '/', realpath(__DIR__ . $ruta));
//echo $dir .'<br>';
$files = scandir($dir);

$pegar=str_replace('\\', '/', realpath(__DIR__ . "./../app/solucions/")); //modificar para cada alumno
foreach($files as $file) {
    if($file === '.' || $file === "..") {continue;}
    $path = $dir .'/'. $file;
    $peg=$pegar. '/' .$file;
    if(is_file($path)) {
      //echo $path.'<br>';
      copy($path, $peg);
    }
  }   


include_once __DIR__ . "/../Vista/html/Editor.php";

?>