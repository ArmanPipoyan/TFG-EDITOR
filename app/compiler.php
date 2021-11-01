<?php
    $language = strtolower($_POST['language']);
    $code = $_POST['code'];

    $random = substr(md5(mt_rand()), 0, 7);
    $filePath = "temp/" . $random . "." . $language;
    $programFile = fopen($filePath, "w");
    fwrite($programFile, $code);
    fclose($programFile);

    if($language == "python") {
        $output = shell_exec("C:\Python39\python.exe $filePath 2>&1");
        echo $output;
    }

    if($language == "cpp") {
        $outputExe = $random . ".exe";
         $errores=exec("g++ $filePath -O3 -o $outputExe" , $result);
        //echo "vacio la ejecucion g++ " . $filePath . " -o " . $outputExe ;

        
        $output = shell_exec(__DIR__ . "//$outputExe");
        unlink($outputExe);
        echo $output . " ". $errores;
    }