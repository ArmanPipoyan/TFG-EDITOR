<?php
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/session.php";

$subject_id = $_GET['subject'];
$sessions = getActiveSessions(subject_id: $subject_id);

include_once __DIR__ . "/../View/html/sessionList.php";
