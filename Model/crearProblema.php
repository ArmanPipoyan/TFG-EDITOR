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
function crear_problema($ruta,$titol,$descripcio,$memoria,$visio,$execucio,$problema,$asignatura)
{

    
    try {
        $conne = connectaBD();

        $stmt1 = $conne->prepare("INSERT INTO problema (Ruta,Title,Descripcio,Visio,Tiempo,Memoria,Llenguatge,AsignaturaID) 
        VALUES (:ruta, :tit, :descripcio,:visio,:tiempo,:memoria,:programacio,:asignatura)");

        #$stmt1->execute();
        #$val = $stmt1->fetchColumn();
  

        #$resultado = $conne->prepare($sql);
        $stmt1->execute(array(":ruta"=>$ruta, ":tit"=>$titol, ":descripcio"=>$descripcio,
        ":visio"=>$visio,":tiempo"=>$execucio,":memoria"=>$memoria,":programacio"=>$problema,":asignatura"=>$asignatura));
        //$resultado->closeCursor();
        echo "<br> Insertado todo "." <br>";
        $valid=1;

        


    } catch (Exception $e) {
        echo "Linea del error:" . $e->getLine();
        $valid=0;
    }
    return $valid;
}

function crear_asignatura($titol,$descripcio,$curs)
{

    
    try {
        $conne = connectaBD();

        $stmt1 = $conne->prepare("INSERT INTO assignatura (Titol,Descripcio,Curs) 
        VALUES (:tit, :descripcio,:curs)");

        #$stmt1->execute();
        #$val = $stmt1->fetchColumn();
  

        #$resultado = $conne->prepare($sql);
        $stmt1->execute(array(":tit"=>$titol, ":descripcio"=>$descripcio,":curs"=>$curs));
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