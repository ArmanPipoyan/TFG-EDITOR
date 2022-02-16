<?php
include_once __DIR__ . "/connection.php";
//Generate a random string.
$token = openssl_random_pseudo_bytes(32);

//Convert the binary data into hexadecimal representation.
$token = bin2hex($token);

echo $token;

$conne = connectaBD();

$sql = "INSERT INTO tokens(valor) VALUES (:valor)";

$resultado = $conne->prepare($sql);
$resultado->execute(array(":valor" => $token));
$resultado->closeCursor();
