<?php
include_once __DIR__ . "/../Model/dockerUtils.php";
session_start();

$dockerId = $_SESSION['containerId'];
rmJupyterDocker($dockerId);

unset($_SESSION['containerId']);
unset($_SESSION['containerPort']);