<?php


  $dir = str_replace('\\', '/', realpath($_POST['folder']));
  $files = scandir($dir);
  echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">';
  echo '<ul class="navbar-nav mr-auto">';
  foreach($files as $file) {
    if($file === '.') {continue;}
    if($file === "..") {
      //echo '<li id="'.dirname($dir).'" onclick="openFolder(this.id)" class=" list-group-item file" >Back <div class="image-parent"> <img src="Vista/imagenes/folder.svg" class="img-fluid" alt="quixote"></div> </li>';
      continue;
    }
    $path = $dir . '/' . $file;
    if(is_dir($path)) {
      echo '<li id="'.$path.'" onclick="openFolder(this.id)" class=" list-group-item file">'.$file.' <div class="image-parent"> <img src="Vista/imagenes/folder.svg" class="img-fluid" ></div></li>';
    }
  }
  foreach($files as $file) {
    if($file === '.' || $file === '..') {continue;}
    else {
      $path = $dir . '/' . $file;
      if(is_file($path)) {
        
        if(isset(pathinfo($path)['extension'])){
          $ext = pathinfo($path)['extension'];
        }else{
          $ext="";
        }
        //$ext=".php";
        echo '<li id="'.$path.'" onclick="openFile(this.id)" class="list-group-item file" > '.$file.' <div class="image-parent"> <img src="Vista/imagenes/'.$ext.'.svg" class="img-fluid" ></div></li>';
      }
    }
  }
  echo '</nav>';
?>