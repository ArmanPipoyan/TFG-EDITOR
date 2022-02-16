<?php

function logInEstudiante($connexio, $mail, $password)
{
    try {
        $stmt = $connexio->prepare("SELECT * FROM student WHERE email= :mail");
        $stmt->execute(array(":mail" => $mail));
        $data = $stmt->fetch(PDO::FETCH_ASSOC); //guardamos en la variable data nuestro usuario su ID

        $resspass = $data['password'];
        $ress = password_verify($password, $resspass);
        if ($ress == true) {
            $_SESSION['usuario'] = $data['name'];
            $_SESSION['mail'] = $mail;
            $_SESSION['tipo'] = 1;
        }
        echo $data['name'] . " ";
    } catch (PDOException $e) {
        echo 'Error al fer log-in' . $e->getMessage();
    }
    return $ress;

}


function logInProfesor($connexio, $mail, $password)
{
    try {
        $stmt = $connexio->prepare("SELECT * FROM professor WHERE email= :mail");
        $stmt->execute(array(":mail" => $mail));
        $data = $stmt->fetch(PDO::FETCH_ASSOC); //guardamos en la variable data nuestro usuario su ID

        $resspass = $data['password'];
        $ress = password_verify($password, $resspass);
        if ($ress == true) {
            $_SESSION['usuario'] = $data['name'];
            $_SESSION['mail'] = $mail;
            $_SESSION['tipo'] = 0;
        }
        echo $data['name'] . " ";
    } catch (PDOException $e) {
        echo 'Error al fer log-in' . $e->getMessage();
    }
    return $ress;


}
