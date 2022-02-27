<?php
    $language = strtolower($_POST['language']);
    $code = $_POST['code'];
    $ruta=$_POST['route'];
    $ejecutable=$_POST['ejecutable'];
    //echo $ejecutable;


    $random = substr(md5(mt_rand()), 0, 7);
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
        $output = shell_exec("py $filePath 2>&1");
        echo "<pre>";
          print_r($output);
        echo "</pre>";
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
        $outputExe = '"'.$dir."/".$random . ".exe".'"';
        $finalDir= $dir."/";
        $ejecutar=$random . ".exe";
        $errores=exec("g++  $filePath -O3 -Wall -o $outputExe 2>&1" , $result);
        //echo "vacio la ejecucion g++ " . $filePath . " -o " . $outputExe ;
        //echo $filePath;
        if (empty($result)) {
          chdir($finalDir);
          
          $output = shell_exec("$ejecutar");
          unlink($ejecutar);
          echo "<pre>";
            print_r($output);
        echo "</pre>";
        }else{
          echo "<pre>";
            print_r($result);
          echo "</pre>";
        }

    }

?>