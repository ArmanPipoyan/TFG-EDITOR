<?php

function logInEstudiante($connexio,$mail,$password)
{
    try{

        $stmt = $connexio->prepare("SELECT * FROM Estudiant WHERE Email= :mail");
        $stmt->execute(array(":mail"=>$mail));
        $data=$stmt->fetch(PDO::FETCH_ASSOC); //guardamos en la variable data nuestro usuario su ID
        $connexio = null;

        $resspass=$data['Pass'];
        $ress=password_verify($password,$resspass);
        if ($ress==true) {
            $_SESSION['usuario']=$data['Nom'];
            $_SESSION['mail']=$mail;
            $_SESSION['tipo']=1;
        }
        
        echo $data['Nom'] . " ";
        

    }catch (PDOException $e) {

        echo 'Error al fer log-in' . $e->getMessage();
    }
return $ress;

}


function logInProfesor($connexio,$mail,$password)
{
    try{

        $stmt = $connexio->prepare("SELECT * FROM profesor WHERE Email= :mail");
        $stmt->execute(array(":mail"=>$mail));
        $data=$stmt->fetch(PDO::FETCH_ASSOC); //guardamos en la variable data nuestro usuario su ID
        $connexio = null;

        $resspass=$data['Pass'];
        $ress=password_verify($password,$resspass);
        if ($ress==true) {
            $_SESSION['usuario']=$data['Nom'];
            $_SESSION['mail']=$mail;
            $_SESSION['tipo']=0;
        }
        
        echo $data['Nom'] . " ";
        

    }catch (PDOException $e) {

        echo 'Error al fer log-in' . $e->getMessage();
    }
return $ress;



}

?>