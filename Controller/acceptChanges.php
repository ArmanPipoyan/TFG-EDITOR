<?php
session_start();
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/problemsGet.php";

$email = $_SESSION['email'];
$problem_id = $_POST["id"];

$problem = getProblemWithId($problem_id);
$route=$problem["route"];
$full_route = str_replace('\\', '/', realpath(__DIR__ . $route));
$files = scandir($full_route);


$new_route=str_replace('\\', '/', realpath(__DIR__ . "./../app/solucions/$email/".$problem["title"]));
unsetSolutionEdited($problem_id, $email);
foreach($files as $file) {
    if($file === '.' || $file === "..") {continue;}
    $path = $full_route .'/'. $file;
    $peg=$new_route. '/' .$file;
    if(is_file($path)) {
      copy($path, $peg);
    }
  }
