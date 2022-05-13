<?php
function runJupyterDocker($user): array {
    $scriptPath = realpath(__DIR__ . "/../jupyter/runJupyterDocker.bat");
    // Find a port that is not being used by any other container
    do {
        $port = rand(1024, 49151);
        exec("docker ps -la | findstr '0.0.0.0:' . $port", $result);
    } while($result === "");

    // Create the container with the used and port values
    $handle = popen("start /B ". $scriptPath . ' ' . $user . ' ' . $port, "r");
    $containerId = fread($handle, 2096);
    pclose($handle);
    // Wait 2 seconds for the container to start
    sleep(2);
    return array('containerId' => $containerId, 'containerPort' => $port);
}

function rmJupyterDocker($id) {
    $scriptPath = realpath(__DIR__ . "/../jupyter/rmJupyterDocker.bat");
    pclose(popen("start /B ". $scriptPath . ' ' . $id, "r"));
}
