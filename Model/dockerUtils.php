<?php
require_once __DIR__ . '/constants.php';
include_once __DIR__ . "/connection.php";


function runJupyterDocker($user): array {
    // Find a port that is not being used by any other container
    do {
        $port = rand(1024, 49151);
        exec("docker ps -la | grep $port", $result);
    } while($result === "");

    // Create the container with the used and port values
    $scriptPath = exec("realpath " . __DIR__ . "/../jupyter/runJupyterDocker.sh");
    $containerId = shell_exec("$scriptPath $user $port");
    sleep(2);

    return array('containerId' => $containerId, 'containerPort' => $port);
}

function rmJupyterDocker($id) {
    $scriptPath = exec("realpath " . __DIR__ . "/../jupyter/rmJupyterDocker.sh");
    shell_exec("$scriptPath $id");
}
