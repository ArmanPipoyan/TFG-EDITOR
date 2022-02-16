<?php
session_start();

function rrmdir($src)
{
    echo "Entramos a borrar";
    $dir = opendir($src);
    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            $full = $src . '/' . $file;
            if (is_dir($full)) {
                rrmdir($full);
            } else {
                unlink($full);
            }
        }
    }
    closedir($dir);
    rmdir($src);
}


$id = $_POST['id'];
if (is_dir($id)) {
    echo -1;
} else {
    unlink($id);
}
