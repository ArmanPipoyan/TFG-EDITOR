<?php
session_start();

include_once __DIR__ . "/Conectar.php";
function rrmdir($src) {
    $dir = opendir($src);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            $full = $src . '/' . $file;
            if ( is_dir($full) ) {
                rrmdir($full);
            }
            else {
                unlink($full);
            }
        }
    }
    closedir($dir);
    rmdir($src);
}

$connexio = connectaBD();
$id = $_GET['problem'];
    try{

        $stmt = $connexio->prepare("SELECT * FROM problema WHERE Id= :mail");
        $stmt->execute(array(":mail"=>$id));
        $data=$stmt->fetch(PDO::FETCH_ASSOC); //guardamos en la variable data

        $stmt = $connexio->prepare('DELETE FROM problema WHERE Id = :mail');
        $stmt->execute(array(":mail"=>$id));







        $connexio = null;

    }catch (PDOException $e) {

        echo 'Error al fer log-in' . $e->getMessage();
    }
    echo $data['Ruta'];
    $dir=$data['Ruta'];

    if (is_dir($data['Ruta'])) {
        rrmdir($dir);
    }
?>
