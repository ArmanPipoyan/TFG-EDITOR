<?php
include_once __DIR__ . "/../Model/Conectar.php";
include_once __DIR__. "/../Model/get_problems.php";
session_start();

$files = array_filter($_FILES['file']['name']); //Use something similar before processing files.
echo print_r($files);
$total_count = count($_FILES['file']['name']);
echo '<br>';
echo $total_count;
echo '<br>';
echo $_POST['token'];
echo '<br>';
$target_dir = str_replace('\\', '/', realpath($_POST['token']));
echo $target_dir;
echo '<br>';
echo "El problema es " . $_POST['problem'];
if (isset($_POST['edit'])) {
    echo '<br>';
    echo "Editando el problema";
    //Insertamos en las soluciones un 1 en los estudiantes con solucion
    $s=updateProblemSolve($_POST['problem']);
}


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
  if (isset($_POST['edit'])) {
        header("Location:/../index.php?query=7&edit=1&problem=".$_POST['problem']);
    }else{
        header("Location:/../index.php?query=7&problem=".$_POST['problem']);
    }
  //header("Location:/../index.php?query=7&problem=".$_POST['problem']);
?>