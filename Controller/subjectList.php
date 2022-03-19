<?php
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/problemsGet.php";

$subjects = getSubjects();

include_once __DIR__ . "/../View/html/subjectsList.php";
