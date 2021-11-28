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

$existe = True;
$variable='./../app/solucions/'.$_SESSION['mail'];
if (!file_exists(__DIR__ .$variable)) {
  
  if(mkdir(__DIR__ .$variable)) {
     echo "La carpeta se ha creado";
     $existe=False;
   }
   else {
     echo 'Failed to create folder';
   }
  
} else {
  echo "The directory $variable exists. <br>";
}
//Creamos carpeta alumno

//creamos carpeta problema dentro del alumno
$variable=$variable.'/'.$data["Title"];


$variable='./../app/solucions/'.$_SESSION['mail']."/".$data["Title"];
if (!file_exists(__DIR__ .$variable)) {
  
  if(mkdir(__DIR__ .$variable)) {
    echo "La carpeta se ha creado";
    $existe=False;
   }
   else {
    echo 'Failed to create folder';
   }
  
} else {
  echo "The directory $variable exists.";
}

$pegar=str_replace('\\', '/', realpath(__DIR__ . "./../app/solucions/".$_SESSION['mail']."/".$data["Title"])); //modificar para cada alumno
echo $existe." La variable existe <br>";
if (!$existe) {
  foreach($files as $file) {
    if($file === '.' || $file === "..") {continue;}
    $path = $dir .'/'. $file;
    $peg=$pegar. '/' .$file;
    if(is_file($path)) {
      //echo $path.'<br>';
      copy($path, $peg);
    }
  }  
}
 


include_once __DIR__ . "/../Vista/html/Editor.php";

?>