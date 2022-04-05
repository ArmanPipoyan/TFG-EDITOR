<?php
include_once __DIR__ . "/../Model/connection.php";
include_once __DIR__ . "/../Model/session.php";

$session_id = $_POST['session_id'];
deleteSession(session_id: $session_id);
