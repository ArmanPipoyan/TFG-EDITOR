<?php

include_once __DIR__ . "/Conectar.php";
$connexio = connectaBD();
$id = $_POST['cosas'];
$visibilidad = $_POST['code'];

foreach ($_POST as $key => $value) {
    echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
}
echo $id;
echo $visibilidad;
$stmt = $connexio->prepare("UPDATE problema SET Visio=:vis WHERE Id= :dato");
$stmt->bindParam(':vis',$visibilidad);
$stmt->bindParam(':dato',$id);
$stmt->execute();
$data=$stmt->fetch(PDO::FETCH_ASSOC); //guardamos en la variable data nuestro usuario su ID
$connexio = null;


?>