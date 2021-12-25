<?php
    $language = strtolower($_POST['language']);
    $code = $_POST['code'];
    $ruta=$_POST['route'];
    $ejecutable=$_POST['ejecutable'];
    //echo $ejecutable;

    $random = substr(md5(mt_rand()), 0, 7);
    //$filePath = "temp/" . $random . "." . $language;
    $filePath=$ruta."/".$ejecutable;
    $bloqueo = "
    import sys
    sys.modules['os'] = None
    sys.modules['system'] = None ";
    $programFile = fopen($filePath, "w");
    fwrite($programFile, $code);
    fclose($programFile);
    $filePath='"'.$ruta."/".$ejecutable.'"';




    if($language == "python") {
      //echo $filePath;
        $output = shell_exec("C:\Python39\python.exe $filePath 2>&1");
        echo $output;
    }
    $filePath="";

    if($language == "cpp") {
        $dir = str_replace('\\', '/', realpath($ruta));
        $files = scandir($dir);

        foreach($files as $file) {       
            if($file === '.' || $file === '..') {continue;}
            else {
                $path = $dir . '/' . $file;
                //echo $path . " ";
                if(is_file($path)) {
                  if(isset(pathinfo($path)['extension'])){
                    $ext = pathinfo($path)['extension'];
                    if ($ext==="cpp") {
                        $filePath=$filePath.' "'.$path.'"';
                    }
                  }
                }
              }
        }
        $outputExe = $random . ".exe";
        $errores=exec("g++ $filePath -O3 -o $outputExe" , $result);
        //echo "vacio la ejecucion g++ " . $filePath . " -o " . $outputExe ;
        //echo $filePath;


        $output = shell_exec(__DIR__ . "//$outputExe");
        unlink($outputExe);
        //unlink($filePath);
        echo $output . " ". $errores;
    }

?>