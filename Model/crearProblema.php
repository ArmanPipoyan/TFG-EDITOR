<?php

function verificar_problema($titol){
    try{
        $connexio = connectaBD();
        $stmt = $connexio->prepare("SELECT COUNT(*) FROM problema WHERE Title= :titol");
        $stmt->execute(array(":titol"=>$titol));
        $val = $stmt->fetchColumn(); 
        $connexio = null;
        if ($val > 0){
            return 1;
        }else {
            return 0;
        }

     

    }catch (PDOException $e) {

        echo 'Error al fer log-in' . $e->getMessage();
    }
    return $ress;
}
function crear_problema($ruta,$titol,$descripcio,$memoria,$visio,$execucio)
{

    
    try {
        $conne = connectaBD();

        $stmt1 = $conne->prepare("INSERT INTO problema (Ruta,Title,Descripcio,Visio,Tiempo,Memoria) 
        VALUES (:ruta, :tit, :descripcio,:visio,:tiempo,:memoria)");

        #$stmt1->execute();
        #$val = $stmt1->fetchColumn();
        $sql = "INSERT INTO problema (Public,Title,Descripcio,Exec_time,Memory) 
        VALUES (:publ, :tit, :descripcio,  :exec_time, :memory)";

        #$resultado = $conne->prepare($sql);
        $stmt1->execute(array(":ruta"=>$ruta, ":tit"=>$titol, ":descripcio"=>$descripcio,":visio"=>$visio,"tiempo"=>$execucio,"memoria"=>$memoria));
        //$resultado->closeCursor();
        echo "<br> Insertado todo "." <br>";
        $valid=1;

        


    } catch (Exception $e) {
        echo "Linea del error:" . $e->getLine();
        $valid=0;
    }
    return $valid;
}

?>