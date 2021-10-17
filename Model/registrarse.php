<?php

function registrar_estudiant($name,$apellido,$email,$hash_password,$reg)
{


    try {
        $conne = connectaBD();
        $valid=false;
        $stmt1 = $conne->prepare("SELECT COUNT(*) FROM estudiant WHERE Email= :mail");

        $stmt1->execute(array(":mail" => $email));
        $val = $stmt1->fetchColumn();
        if (($val > 0)||(!filter_var($email,FILTER_VALIDATE_EMAIL)))
        {

            
            //header("Location:/../../index.php?accio=7");
            echo "Registro no insertado";



        }else {
            $valid=true;
            $sql = "INSERT INTO estudiant(Nom,Cognom,Email,Pass) 
            VALUES (:nombre, :apellido, :mail, :password)";

            $resultado = $conne->prepare($sql);


            //comprobar si el usuario en cuestion ya existe


            $resultado->execute(array(":nombre" => $name, ":apellido" => $apellido, ":mail" => $email, ":password" => $hash_password));
            $resultado->closeCursor();
            echo "Insertado todo";

        }


    } catch (Exception $e) {
        echo "Linea del error:" . $e->getLine();
    }
    return $valid;
}

?>