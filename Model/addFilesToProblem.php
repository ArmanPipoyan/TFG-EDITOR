<?php

function uploadFile(string $fileExtension, int $i, string $route, mixed $tmpFilePath, array $files): void
{
    if ($fileExtension != "cpp" && $fileExtension != "h" && $fileExtension != "py" && $fileExtension != "python"
        && $fileExtension != "txt") {
        header("Location:/../index.php?query=6");
    }
    if ($files["file"]["size"][$i] > 500000) {
        header("Location:/../index.php?query=6");
    }

    //Set up our new file path
    $newFilePath = $route . "/" . $files['file']['name'][$i];
    //File is uploaded to temp dir
    if (move_uploaded_file($tmpFilePath, $newFilePath)) {
        echo "The file " . htmlspecialchars(basename($files["file"]["name"][$i])) . " has been uploaded.";
    }
}

# Count the number of uploaded files in array
function uploadFiles(string $route, array $files): void
{
    $files_count = count($files['file']['name']);

    for ($i = 0; $i < $files_count; $i++) {
        //The temp file path is obtained
        $tmpFilePath = $files['file']['tmp_name'][$i];
        //A file path needs to be present
        $tmpFileName = basename($files["file"]["name"][$i]);
        $fileExtension = strtolower(pathinfo($tmpFileName, PATHINFO_EXTENSION));

        uploadFile($fileExtension, $i, $route, $tmpFilePath, $files);
    }
}
