<?php
include_once __DIR__ . "/connection.php";
$connection = connectDB();

$problem_id = $_POST['problem_id'];
$new_visibility = $_POST['new_visibility'];

$statement = $connection->prepare("UPDATE problem SET visibility=:visibility WHERE id= :problem_id");
$statement->execute(array(':problem_id'=>$problem_id, ':visibility'=>$new_visibility));
$data = $statement->fetch(PDO::FETCH_ASSOC);
$connection = null;
