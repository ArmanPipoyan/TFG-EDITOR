<?php

function logIn($connexio,$mail,$password)
{
    try{

        $stmt = $connexio->prepare("SELECT * FROM Estudiant WHERE Email= :mail");
        $stmt->execute(array(":mail"=>$mail));
        $data=$stmt->fetch(PDO::FETCH_ASSOC); //guardamos en la variable data nuestro usuario su ID
        $connexio = null;

        $resspass=$data['Pass'];
        $_SESSION['usuario']=$data['Nom'];
        echo $data['Nom'] . " ";
        $ress=password_verify($password,$resspass);

    }catch (PDOException $e) {

        echo 'Error al fer log-in' . $e->getMessage();
    }
return $ress;



}

?>