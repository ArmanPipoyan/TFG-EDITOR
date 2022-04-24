<?php

use Github\Client;
include_once __DIR__ . '/libs/Github/vendor/autoload.php';
include_once __DIR__ . '/exceptions.php';

function downloadDirectoryFromGithub(string $repoLink): array {
    // Authenticate the user
    $client = new Client();
    $accessToken = $_SESSION['access_token'];
    $client->authenticate($accessToken, null,'access_token_header');

    // ["https:", "", "github.com", "OWNER", "REPO", "tree", "TREE", "PATH", "TO", "FILE"]
    $explodedRepoLink = explode("/", $repoLink);

    // Remove the useless information from the link
    unset($explodedRepoLink[0], $explodedRepoLink[1], $explodedRepoLink[2], $explodedRepoLink[5], $explodedRepoLink[6]);
    $owner = array_shift($explodedRepoLink);
    $repository = array_shift($explodedRepoLink);
    $path = implode("/", $explodedRepoLink);

    // Check if the specified url is valid
    $fileExists = $client->api('repo')->contents()->exists($owner, $repository, $path);
    if (!$fileExists) {
        throw new GitHubFileDoesNotExist($path);
    }

    // Check if the path is a directory or a file
    $pathContent = $client->api('repo')->contents()->show($owner, $repository, $path);
    if (isset($pathContent['type'])) {
        throw new SpecifiedUrlNotADirectory($path);
    }

    $directoryName = end($explodedRepoLink);
    $route = createProblemDirectory($directoryName);

    $returnData['description'] = "";
    foreach ($pathContent as $item) {
        // The problems do not contain directories
        if ($item['type'] == 'dir') {
            continue;
        }

        $fileContent = $client->api('repo')->contents()->show($owner, $repository, $item['path']);
        $fileName = $fileContent['name'];
        $fileContentBase64 = $fileContent['content'];

        if ($fileName == 'readme.md') {
            $returnData['description'] = base64_decode($fileContentBase64);
        } else {
            createProblemFile($route, $fileName, $fileContentBase64);
        }
    }

    $returnData['title'] = $directoryName;
    $returnData['route'] = $route;
    return $returnData;
}

function createProblemDirectory(string $directoryName): string {
    $directory = "./../app/problemes/$directoryName";
    if (file_exists($directory)) {
        throw new DirectoryAlreadyExists($directory);
    }
    mkdir($directory);
    return $directory;
}

function createProblemFile(string $directory, string $fileName, string $content) {
    $filePath = "$directory/$fileName";
    $file = fopen($filePath, 'w');
    fwrite($file, base64_decode($content));
}
