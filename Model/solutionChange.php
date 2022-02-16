<?php
session_start();

include_once __DIR__ . "/connection.php";
$connexio = connectaBD();
$carpeta = $_POST['carpeta'];
$variable = 1;

$stmt = $connexio->prepare("UPDATE solution SET editing=0 WHERE route= :dato");
$stmt->execute(array(":dato" => $carpeta));
$data = $stmt->fetch(PDO::FETCH_ASSOC); //guardamos en la variable data nuestro usuario su ID
$connexio = null;

echo $data['editing'];
