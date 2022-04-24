<?php
session_start();
include_once __DIR__ . '/../Model/githubAuthClient.php';
include_once __DIR__ . '/../Model/github.php';
include_once __DIR__ . '/../Model/problemsGet.php';

if (!isset($_SESSION['access_token'])) {
    $_SESSION['prev_page'] = $_SERVER['PHP_SELF'];
    $_SESSION['repo_link'] = $_POST['repo_link'];
    $_SESSION['solution_path'] = $_POST['solution_path'];
    header('Location: /Model/githubAccessToken.php');
}

$client = authClient();
// Collect the data of the form
$lookupArray = isset($_SESSION['repo_link'])? $_SESSION: $_POST;
$repoLink = $lookupArray['repo_link'];
$solutionPath = $lookupArray['solution_path'];

$userName = $_SESSION['user'];
$userEmail = $_SESSION['email'];

// Clear the session variables
if ($lookupArray == $_SESSION) {
    unset($_SESSION['repo_link']);
    unset($_SESSION['solution_path']);
}

uploadDirectoryToGithub(client: $client, repoLink: $repoLink, userName: $userName, userEmail: $userEmail,
    directory: $solutionPath);
