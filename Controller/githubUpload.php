<?php
session_start();
include_once __DIR__ . '/../Model/constants.php';
include_once __DIR__ . '/../Model/redirectionUtils.php';
include_once __DIR__ . '/../Model/githubAuthClient.php';
include_once __DIR__ . '/../Model/github.php';
include_once __DIR__ . '/../Model/problemsGet.php';

if (!isset($_SESSION['access_token'])) {
    $_SESSION['prev_page'] = $_SERVER['PHP_SELF'];
    $_SESSION['repo_link'] = $_POST['repo_link'];
    $_SESSION['solution_path'] = $_POST['solution_path'];
    $_SESSION['problem_id'] = $_POST['problem_id'];
    header('Location: /Model/githubAccessToken.php');
}

$client = authClient();
// Collect the data of the form
$lookupArray = isset($_SESSION['repo_link'])? $_SESSION: $_POST;
$repoLink = $lookupArray['repo_link'];
$solutionPath = $lookupArray['solution_path'];
$problemId = $lookupArray['problem_id'];

$userName = $_SESSION['user'];
$userEmail = $_SESSION['email'];

// Clear the session variables
if ($lookupArray == $_SESSION) {
    unset($_SESSION['repo_link']);
    unset($_SESSION['solution_path']);
    unset($_SESSION['problem_id']);
}

try{
    uploadDirectoryToGithub(client: $client, repoLink: $repoLink, userName: $userName, userEmail: $userEmail,
        directory: $solutionPath);
    $uploaded = 1;
}catch (Exception) {
    $uploaded = 0;
}

redirect_location(VIEW_EDITOR, array("problem"=>$problemId, "uploaded"=>$uploaded));
