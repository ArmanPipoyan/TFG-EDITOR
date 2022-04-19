<?php
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/session.php";

$session_id = $_POST['session_id'];
$session_name = $_POST['session_name'];

duplicateSession(session_name: $session_name, session_id: $session_id);
