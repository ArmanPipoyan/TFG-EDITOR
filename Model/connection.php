<?php
function connectaBD(){
    $servername = "localhost";
    $database = "webtfg";
    $username = "root";
    $password = "";
    try {
        $conn = new PDO('mysql:host=localhost;dbname=webtfg', $username, $password);
        if (mysqli_connect_errno()) {
            echo mysqli_connect_error();
        }
       
        return ($conn);
    }catch (PDOException $e){
        echo 'La connexio falla' . $e->getMessage();
    }

    echo "La connexio connected succefully";
}


?>