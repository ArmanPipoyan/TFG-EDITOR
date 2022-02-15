<?php
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/problemsGet.php";
$connexio = connectaBD();

$data = getSubjects();

include_once __DIR__ . "/../View/html/subjectsList.php";
