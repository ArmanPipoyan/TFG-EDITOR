<?php
include_once __DIR__ . '/exceptions.php';

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
    fclose($file);
}

function getDirectoryFiles(string $directory): array {
    // Get all items
    $directoryItems = scandir(realpath($directory));
    // Remove the . and ..
    $dotsRemovedItems = array_diff($directoryItems, array('..', '.'));
    // Remove the directories
    return array_filter($dotsRemovedItems, fn($item) => !is_dir(realpath("$directory/$item")));
}
