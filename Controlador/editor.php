<?php
include_once __DIR__ . "/../Model/Conectar.php";
include_once __DIR__ . "/../Model/get_problems.php";



if (isset($_GET["problem"])) {
	$query=$_GET["problem"];
}else{
    header("Location:/../index.php");
}
$copiar=False;
if (isset($_GET["reiteratiu"])&&isset($_GET["usuario"])) {
  if ($_GET["reiteratiu"]==1) {
    $usuarioCopiar=$_GET["usuario"];
    $copiar=True;
    $data3=modifySolucionToSolve($query,$usuarioCopiar,1,0);
  }else {
    header("Location:/../index.php");
  }
}
$data=getProblemToSolve($query);
$asignatura=$data["AsignaturaID"];
$ruta=$data["Ruta"];
$dir = str_replace('\\', '/', realpath(__DIR__ . $ruta));
$files = scandir($dir);

$existe = True;
if ($copiar==True) {
  $variable='./../app/solucions/'.$usuarioCopiar;
}else {
  $variable='./../app/solucions/'.$_SESSION['mail'];
}
//$variable='./../app/solucions/'.$_SESSION['mail'];
if (!file_exists(__DIR__ .$variable)) {
  if(mkdir(__DIR__ .$variable)) {
     //echo "La carpeta se ha creado";
     $existe=False;
   }
   else {
      echo 'Failed to create folder';
   }
}

if ($copiar==True) {
  $variable='./../app/solucions/'.$usuarioCopiar."/".$data["Title"];
}else {
  $variable='./../app/solucions/'.$_SESSION['mail']."/".$data["Title"];
}

if (!file_exists(__DIR__ .$variable)) {
  if(mkdir(__DIR__ .$variable)) {
    //echo "La carpeta se ha creado";
    $existe=False;
   }  
} 

//Variale para cargar ruta del archivo
if ($copiar==True) {
  $pegar=str_replace('\\', '/', realpath(__DIR__ . "./../app/solucions/".$usuarioCopiar."/".$data["Title"])); //modificar para cada alumno
}else {
  $pegar=str_replace('\\', '/', realpath(__DIR__ . "./../app/solucions/".$_SESSION['mail']."/".$data["Title"])); //modificar para cada alumno
}

//Si no existe la carpeta con el problema se crea aqui
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
  $usuario=$_SESSION['mail'];
  //ruta donde se guarda, id del problema, id assignatura
  insert_Solution($pegar,$query,$asignatura,$usuario);
}


 
if ($_SESSION['tipo']==0) {
  $datas=getAlumnos($query);
  //var_dump($datas);
}


include_once __DIR__ . "/../Vista/html/Editor.php";

?>