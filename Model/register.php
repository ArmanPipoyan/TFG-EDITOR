<?php

function registrar_estudiant($name, $apellido, $email, $hash_password, $reg)
{


    try {
        $conne = connectaBD();

        if ((!filter_var($email, FILTER_VALIDATE_EMAIL))) {


            //header("Location:/../../index.php?accio=7");
            #echo "Registro no insertado";


        } else {
            $valid = true;
            $sql = "INSERT INTO estudiant(Nom,Cognom,Email,Pass) 
            VALUES (:nombre, :apellido, :mail, :password)";

            $resultado = $conne->prepare($sql);


            //comprobar si el usuario en cuestion ya existe


            $resultado->execute(array(":nombre" => $name, ":apellido" => $apellido, ":mail" => $email, ":password" => $hash_password));
            $resultado->closeCursor();
            #echo "Insertado todo";

        }


    } catch (Exception $e) {
        echo "Linea del error:" . $e->getLine();
    }
    return $valid;
}

function checkToken($token)
{


    try {
        $conne = connectaBD();
        $valid = false;
        $stmt1 = $conne->prepare("SELECT * FROM tokens WHERE Valor= :mail and Uso = 0");

        $stmt1->execute(array(":mail" => $token));
        $val = $stmt1->fetchColumn();
        #echo "El id de la columna de ete token es " . $val. "<br>";
        if ($val != "") {
            $sql = "UPDATE tokens  SET Uso=1 WHERE Valor= :mail and Uso = 0";
            $stmt = $conne->prepare($sql);
            $stmt->execute(array(":mail" => $token));
        }


    } catch (Exception $e) {
        echo "Linea del error:" . $e->getLine();
    }
    return $val;

}

function get_users($email)
{

    try {
        $conne = connectaBD();
        $valid = false;
        $stmt1 = $conne->prepare("SELECT COUNT(*) FROM estudiant WHERE Email= :mail");

        $stmt1->execute(array(":mail" => $email));
        $val1 = $stmt1->fetchColumn();

        $stmt1 = $conne->prepare("SELECT COUNT(*) FROM profesor WHERE Email= :mail");

        $stmt1->execute(array(":mail" => $email));
        $val2 = $stmt1->fetchColumn();
        $numero = $val1 + $val2;


    } catch (Exception $e) {
        echo "Linea del error:" . $e->getLine();
    }
    return $numero;

}

function registrar_professor($name, $apellido, $email, $hash_password, $reg)
{

    try {
        $conne = connectaBD();
        if ((!filter_var($email, FILTER_VALIDATE_EMAIL))) {


            //header("Location:/../../index.php?accio=7");
            #echo "Registro no insertado";


        } else {
            $valid = true;
            $sql = "INSERT INTO profesor(Nom,Cognom,Email,Pass) 
            VALUES (:nombre, :apellido, :mail, :password)";

            $resultado = $conne->prepare($sql);


            //comprobar si el usuario en cuestion ya existe


            $resultado->execute(array(":nombre" => $name, ":apellido" => $apellido, ":mail" => $email, ":password" => $hash_password));
            $resultado->closeCursor();
            #echo "Insertado todo";

        }


    } catch (Exception $e) {
        echo "Linea del error:" . $e->getLine();
    }
    return $valid;
}
