<?php
session_start();
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/problemsGet.php";

$filename = $_POST['filename'];
$edited = $_POST['edited'];
$problem = $_POST['problema'];
$dir = str_replace('\\', '/', realpath(urldecode($_POST['dir'])));

if ($edited == 1) {
    setSolutionAsEdited($problem);
} else {
    echo "There no changes to the root";
}

$dst = $dir . '/' . $filename;
//Check if it should be a folder or file
if (strpos($filename, '.') > 1) {
    if (touch($dst)) {
        echo true;
    } else {
        echo 'Failed to create file';
    }
}
