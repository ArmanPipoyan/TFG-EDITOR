<?php
session_start();

if (!isset($_SESSION['access_token'])) {
    $_SESSION['prev_page'] = $_SERVER['PHP_SELF'];
    header('Location: http://localhost/Model/githubAuth.php?action=login');
}

// Collect the data of the form
$repoLink = $_POST['repo_link'];
$maxExecutionTime = $_POST['max_execution_time'];
$maxMemoryUsage = $_POST['max_memory_usage'];
$visibility = $_POST['visibility'];
$language = $_POST['language'];
$subject = $_POST['subject'];

