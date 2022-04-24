<?php

use Github\Client, Github\Exception\RuntimeException;
include_once __DIR__ . '/libs/Github/vendor/autoload.php';
include_once __DIR__ . '/diskManager.php';
include_once __DIR__ . '/exceptions.php';

function retrieveOwnerRepoAndPathFromLink($repoLink): array {
    $returnData = array();
    // ["https:", "", "github.com", "OWNER", "REPO" ((,"tree", "TREE", "PATH", "TO", "FILE"))]
    $explodedRepoLink = explode("/", $repoLink);

    // Remove the useless information from the link
    unset($explodedRepoLink[0], $explodedRepoLink[1], $explodedRepoLink[2]);
    $returnData['owner'] = array_shift($explodedRepoLink);
    $returnData['repository'] = array_shift($explodedRepoLink);
    if ($explodedRepoLink != "") {
        unset($explodedRepoLink[0], $explodedRepoLink[1]);
        $returnData['path'] = implode("/", $explodedRepoLink);
    }

    return $returnData;
}

function downloadDirectoryFromGithub(Client $client, string $repoLink): array {
    // Retrieve the relevant information from the link
    $repositoryInformation = retrieveOwnerRepoAndPathFromLink($repoLink);
    $owner = $repositoryInformation['owner'];
    $repository = $repositoryInformation['repository'];
    $path = $repositoryInformation['path'];

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

    $route = createProblemDirectory($path);

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

    $returnData['title'] = $path;
    $returnData['route'] = $route;
    return $returnData;
}

function uploadDirectoryToGithub(Client $client, string $repoLink, string $userName, string $userEmail,
                                 string $directory): bool {

    $repositoryInformation = retrieveOwnerRepoAndPathFromLink($repoLink);
    $owner = $repositoryInformation['owner'];
    $repository = $repositoryInformation['repository'];
    $committer = array('name' => $userName, 'email' => $userEmail);

    // Get the directory name
    $explodedDirectory = explode("/", $directory);
    $directoryName = array_pop($explodedDirectory);

    // Each file will be committed individually
    $files = getDirectoryFiles($directory);
    foreach ($files as $file) {
        $content = file_get_contents("$directory/$file");
        $path = "$directoryName/$file";

        // If the show raises an exception it's because the file does not exist, and it must be created
        try {
            $githubFile = $client->api('repo')->contents()->show($owner, $repository, $path);
            $commitMessage = "File $file of the problem $directoryName updated";
            $client->api('repo')->contents()->update($owner, $repository, $path, $content, $commitMessage,
                $githubFile['sha'], null, $committer);
        } catch (RuntimeException) {
            $commitMessage = "File $file of the problem $directoryName created";
            $client->api('repo')->contents()->create($owner, $repository, $path, $content, $commitMessage,
                null, $committer);
        }
    }
    return true;
}
