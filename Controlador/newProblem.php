<?php
session_start();
include_once __DIR__ . "/../Model/Conectar.php";
include_once __DIR__. "/../Model/crearProblema.php";
$conn=connectaBD();

//$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
//$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$files = array_filter($_FILES['file']['name']); //Use something similar before processing files.
// Count the number of uploaded files in array
$total_count = count($_FILES['file']['name']);



$titulo=$_POST['title'];
$descripcio=$_POST['descripcio'];
$memory=$_POST['memory'];
$time=$_POST['time'];
$visio=$_POST['visio'];
$problema=$_POST['programacio'];
$target_dir = "./../app/problemes/" . $_POST['title']; // directorio donde guardamos los archivos
$asignatura=$_POST['assignatura'];
echo "<br> La assignatura es ". $asignatura ." <br>";
if (verificar_problema($titulo)==0) {
  echo "El problema no existe por lo tanto se crea";
  $s=crear_problema($target_dir,$titulo,$descripcio,$memory,$visio,$time,$problema,$asignatura);
}else {
  echo "El problema ya existe por lo tanto no se crea";
  $uploadOk=0;
  header("Location:/../index.php?query=6");
}

if ($uploadOk==1) {
  
  mkdir($target_dir, 0777); // Creamos carpeta para guardar archivos
  for( $i=0 ; $i < $total_count ; $i++ ) {
    //The temp file path is obtained
    $uploadOk=1;
    $tmpFilePath = $_FILES['file']['tmp_name'][$i];
    //A file path needs to be present
    $tmpFileName=basename($_FILES["file"]["name"][$i]);
    $imageFileType = strtolower(pathinfo($tmpFileName,PATHINFO_EXTENSION));
    echo "La extension es " . $imageFileType . "<br>";
    if($imageFileType != "cpp" && $imageFileType != "h" && $imageFileType != "py" && $imageFileType != "python" && $imageFileType != "txt" ) {
      echo "Sorry, only .cpp, .py, .h & .python files are allowed.";
      $uploadOk = 0;
      header("Location:/../index.php?query=6");
    }
    if ($_FILES["file"]["size"][$i] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
      header("Location:/../index.php?query=6");
    }
    if ($uploadOk == 1){
       //Setup our new file path
       $newFilePath = $target_dir ."/". $_FILES['file']['name'][$i];
       //File is uploaded to temp dir
       if(move_uploaded_file($tmpFilePath, $newFilePath)) {
  
        echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"][$i])). " has been uploaded.";
          //Other code goes here
       }
    }else {
      echo "Sorry, there was an error uploading your file."; 
      header("Location:/../index.php?query=6"); 
    }
  }
}

header("Location:/../index.php?query=5");





?>