<?php
session_start();
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/problemsGet.php";
$file = $_POST['file'];
$code = $_POST['code'];
$editing = $_POST['editing'];
$problem = $_POST['problem'];
if (file_put_contents($file, $code)) {
    echo $code;
}
if ($editing == 1) {
    updateProblemSolve($problem);
}
