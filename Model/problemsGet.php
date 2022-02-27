<?php

function getProblems()
{

    try {
        $conn = connectaBD();
        $stmt = $conn->prepare("SELECT * FROM problem");
        $stmt->execute();
        $data = $stmt->fetchAll(); //guardamos en la variable data nuestro usuario su ID
        $conn = null;


    } catch (PDOException $e) {

        echo 'Error al fer log-in' . $e->getMessage();
    }
    return $data;
}

function getProblemToSolve($id)
{
    try {
        $conn = connectaBD();
        $stmt = $conn->prepare("SELECT * FROM problem WHERE id= :dato");
        $stmt->execute(array(":dato" => $id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC); //guardamos en la variable data nuestro usuario su ID
        $conn = null;


    } catch (PDOException $e) {

        echo 'Error al recuperar el problema algo ha fallado' . $e->getMessage();
    }
    return $data;
}

function getSubjects()
{
    try {
        $conn = connectaBD();
        $stmt = $conn->prepare("SELECT * FROM subject");
        $stmt->execute();
        $data = $stmt->fetchAll(); //guardamos en la variable data nuestro usuario su ID
        $conn = null;


    } catch (PDOException $e) {

        echo 'Error al fer log-in' . $e->getMessage();
    }
    return $data;
}

function insert_Solution($pegar, $query, $asignatura, $usuario)
{
    try {
        $conne = connectaBD();
        $valid = true;
        $sql = "INSERT INTO solution(route, problem_id, subject_id, user) VALUES (:nombre, :apellido, :mail, :password)";
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

function getAlumnos($query)
{

    try {
        $connexio = connectaBD();
        $stmt = $connexio->prepare("SELECT * FROM solution WHERE problem_id= :mail");
        $stmt->execute(array(":mail" => $query));
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC); //guardamos en la variable data nuestro usuario su ID
        $connexio = null;
        //echo $data["Usuario"];

    } catch (PDOException $e) {

        echo 'Error al fer log-in' . $e->getMessage();
    }
    return $datas;


}


function getSolucionToSolve($id, $usuarioCopiar)
{
    try {
        $conn = connectaBD();
        $stmt = $conn->prepare("SELECT * FROM solution WHERE problem_id= :dato and user = :usuario");
        $stmt->execute(array(":dato" => $id, ":usuario" => $usuarioCopiar));
        $data2 = $stmt->fetch(PDO::FETCH_ASSOC); //guardamos en la variable data nuestro usuario su ID
        $conn = null;

    } catch (PDOException $e) {

        echo 'Error al recuperar al solucion algo ha fallado' . $e->getMessage();
    }
    return $data2;
}

function modifySolucionToSolve($id, $usuarioCopiar, $estado, $segundoEstado)
{
    try {
        $conn = connectaBD();
        $stmt = $conn->prepare("UPDATE solution SET editing=$estado WHERE problem_id= :dato and editing = :segundoEstado and user = :usuario");
        $stmt->execute(array(":dato" => $id, ":segundoEstado" => $segundoEstado, ":usuario" => $usuarioCopiar));
        $data3 = $stmt->fetch(PDO::FETCH_ASSOC); //guardamos en la variable data nuestro usuario su ID
        $conn = null;

    } catch (PDOException $e) {

        echo 'Error al recuperar al solucion algo ha fallado' . $e->getMessage();
    }
    return $data3;
}


function updateProblemSolve($id)
{
    try {
        $conn = connectaBD();
        $stmt = $conn->prepare("UPDATE solution SET edited=1 WHERE problem_id= :dato");
        $stmt->execute(array(":dato" => $id));
        $data3 = $stmt->fetch(PDO::FETCH_ASSOC); //guardamos en la variable data nuestro usuario su ID
        $conn = null;
    } catch (PDOException $e) {
        echo 'Error al recuperar al solucion algo ha fallado' . $e->getMessage();
    }
    return $data3;
}


function getSolucion($id, $mail)
{
    try {
        $conn = connectaBD();
        $stmt = $conn->prepare("SELECT * FROM solution WHERE problem_id= :dato and user= :mail");
        $stmt->execute(array(":dato" => $id, ":mail" => $mail));
        $sol = $stmt->fetch(PDO::FETCH_ASSOC); //guardamos en la variable data nuestro usuario su ID
        $conn = null;
    } catch (PDOException $e) {
        echo 'Error al recuperar el problema algo ha fallado' . $e->getMessage();
    }
    return $sol;
}


function updateSolucionActualziada($id, $mail)
{
    try {
        $conn = connectaBD();
        $stmt = $conn->prepare("UPDATE solution SET edited=0 WHERE problem_id= :dato and user= :mail");
        $stmt->execute(array(":dato" => $id, ":mail" => $mail));
        $data3 = $stmt->fetch(PDO::FETCH_ASSOC); //guardamos en la variable data nuestro usuario su ID
        $conn = null;

    } catch (PDOException $e) {

        echo 'Error al recuperar al solucion algo ha fallado' . $e->getMessage();
    }
    return $data3;
}


function updateProblem($descripcio, $memory, $time, $id)
{
    try {
        $conn = connectaBD();
        $stmt = $conn->prepare("UPDATE problem SET  description=:descripcion, memory=:memoria, time=:tiempo WHERE id= :mail");
        $stmt->bindParam(':descripcion', $descripcio);
        $stmt->bindParam(':memoria', $memory);
        $stmt->bindParam(':tiempo', $time);
        $stmt->bindParam(':mail', $id);

        $stmt->execute();
        $data3 = $stmt->fetch(PDO::FETCH_ASSOC); //guardamos en la variable data nuestro usuario su ID
        $conn = null;
        print_r($data3);

    } catch (PDOException $e) {

        echo 'Error al recuperar al solucion algo ha fallado' . $e->getMessage();
    }

}
