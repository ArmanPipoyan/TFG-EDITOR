<?php
$dir = str_replace('\\', '/', realpath(urldecode($_POST['folder'])));
$files = scandir($dir);
echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">';
echo '<ul class="navbar-nav mr-auto">';
foreach ($files as $file) {
    if ($file === '.') {
        continue;
    }
    if ($file === "..") {
        continue;
    }
    $path = $dir . '/' . $file;
}
foreach ($files as $file) {
    if ($file === '.' || $file === '..') {
        continue;
    } else {
        $path = $dir . '/' . $file;
        if (is_file($path)) {

            if (isset(pathinfo($path)['extension'])) {
                $ext = pathinfo($path)['extension'];
            } else {
                $ext = "";
            }
            echo '<li id="' . $path . '" onclick="openFile(this.id)" class="list-group-item file" >
        <div class="row">
         ' . $file . ' <div class="image-parent"> <img src="View/imagenes/' . $ext . '.svg" class="img-fluid "style="height: 30px;" ></div>
          <button id="close" name="' . $path . '" data-toggle="modal" data-target="#my-modal" onclick="setBorrarArchivo(this.name);" >close</button>
         </div>
         </li>';
        }
    }
}
echo '</nav>';
