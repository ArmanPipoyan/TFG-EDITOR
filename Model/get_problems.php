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

        echo 'Error al fer log-in' . $e->getMessage();
    }
    return $data;
}



?>