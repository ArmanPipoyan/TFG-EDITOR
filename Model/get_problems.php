<?php

function getProblems() {

    try{
        $conn=connectaBD();
        $stmt = $conn->prepare("SELECT * FROM problema");
        $stmt->execute();
        $data=$stmt->fetchAll(); //guardamos en la variable data nuestro usuario su ID
        $conn = null;

        

    }catch (PDOException $e) {

        echo 'Error al fer log-in' . $e->getMessage();
    }
    return $data;
}

function getProblemToSolve($id) {
    try{
        $conn=connectaBD();
        $stmt = $conn->prepare("SELECT * FROM problema WHERE Id= :dato");
        $stmt->execute(array(":dato"=>$id));
        $data=$stmt->fetch(PDO::FETCH_ASSOC); //guardamos en la variable data nuestro usuario su ID
        $conn = null;

        

    }catch (PDOException $e) {

        echo 'Error al recuperar el problema algo ha fallado' . $e->getMessage();
    }
    return $data;
}

function getSubjects() {

    try{
        $conn=connectaBD();
        $stmt = $conn->prepare("SELECT * FROM assignatura");
        $stmt->execute();
        $data=$stmt->fetchAll(); //guardamos en la variable data nuestro usuario su ID
        $conn = null;

        

    }catch (PDOException $e) {

        echo 'Error al fer log-in' . $e->getMessage();
    }
    return $data;
}

function insert_Solution($pegar,$query,$asignatura,$usuario){
    try {
        $conne = connectaBD();
        $valid=true;
        //echo $pegar.$query.$asignatura.$usuario;
        $sql = "INSERT INTO solucio(Ruta,Id_problema ,Id_asignatura ,Usuario ) 
        VALUES (:nombre, :apellido, :mail, :password)";
        $resultado = $conne->prepare($sql);
        //comprobar si el usuario en cuestion ya existe
        $resultado->execute(array(":nombre" => $pegar, ":apellido" => $query, ":mail" => $asignatura, ":password" => $usuario));
        $resultado->closeCursor();
        #echo "Insertado todo";

    } catch (Exception $e) {
        echo "Linea del error:" . $e->getLine();
    }
    return $valid; 
}

function getAlumnos($query){

    try{
        $connexio = connectaBD();
        $stmt = $connexio->prepare("SELECT * FROM solucio WHERE Id_problema= :mail");
        $stmt->execute(array(":mail"=>$query));
        $datas=$stmt->fetchAll(PDO::FETCH_ASSOC); //guardamos en la variable data nuestro usuario su ID
        $connexio = null;  
        //echo $data["Usuario"];

    }catch (PDOException $e) {

        echo 'Error al fer log-in' . $e->getMessage();
    }
return $datas;


}


function getSolucionToSolve($id,$usuarioCopiar) {
    try{
        $conn=connectaBD();
        $stmt = $conn->prepare("SELECT * FROM solucio WHERE Id_problema= :dato");
        $stmt->execute(array(":dato"=>$id));
        $data=$stmt->fetch(PDO::FETCH_ASSOC); //guardamos en la variable data nuestro usuario su ID
        $conn = null;

        

    }catch (PDOException $e) {

        echo 'Error al recuperar al solucion algo ha fallado' . $e->getMessage();
    }
    return $data;
}

function modifySolucionToSolve($id,$usuarioCopiar) {
    try{
        $conn=connectaBD();
        $stmt = $conn->prepare("UPDATE solucio SET Editing=1 WHERE Id_problema= :dato and Editing = 0");
        $stmt->execute(array(":dato"=>$id));
        $data=$stmt->fetch(PDO::FETCH_ASSOC); //guardamos en la variable data nuestro usuario su ID
        $conn = null;

        

    }catch (PDOException $e) {

        echo 'Error al recuperar al solucion algo ha fallado' . $e->getMessage();
    }
    return $data;
}

?>