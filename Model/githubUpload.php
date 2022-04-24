<?php
require_once __DIR__ . '/libs/Github/vendor/autoload.php';
use Github\Client;
$client = new Client();
$client->authenticate('', null,'access_token_header');
$path = 'getFileContent.php';
$content = file_get_contents('D:\xampp\htdocs\Model\getFileContent.php');
$commitMessage = 'Using the api';
$branch = null;
$committer = array('name' => 'ArmanPipoyan', 'email' => 'arman.pipoyan26@gmail.com');
$fileInfo = $client->api('repo')->contents()->create('ArmanPipoyan', 'jupyter_notebook', $path, $content, $commitMessage, $branch, $committer);
