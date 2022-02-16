<?php
session_start();

include_once __DIR__ . "/connection.php";
function rrmdir($src)
{
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

$connexio = connectaBD();
$id = $_POST['id'];
try {

    $stmt = $connexio->prepare("SELECT * FROM problem WHERE id= :mail");
    $stmt->execute(array(":mail" => $id));
    $data = $stmt->fetch(PDO::FETCH_ASSOC); //guardamos en la variable data

    $stmt = $connexio->prepare('DELETE FROM problem WHERE id = :mail');
    $stmt->execute(array(":mail" => $id));


    $connexio = null;

} catch (PDOException $e) {

    echo 'Error al fer log-in' . $e->getMessage();
}
echo $data['route'];
$dir = $data['route'];

if (is_dir($data['route'])) {
    rrmdir($dir);
}