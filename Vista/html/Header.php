<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>TFG</title>

    <link rel="stylesheet" href="Vista/css/style.css" />
    <link rel="shortcut icon" href="/Vista/imagenes/descarga.png" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="Vista/js/ide.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body class="bg-primary" >

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">TFG</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/index.php?query=2">Login</a>
        </li>
         <li class="nav-item">
            <a class="nav-link" href="/index.php?query=3">Registre</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/index.php?query=4">Crear Problema</a>
        </li>

        <?php  if(isset($_SESSION['tipo'])) {
            if ($_SESSION['tipo']==0) {?>
            <li class="nav-item">
                <a class="nav-link" onclick="generateToken()" href="#"  data-toggle="modal" data-target="#myModal">Invitar a un professor</a>
            </li>
            <?php }} ?>

        </ul>

    </div>
        
        <?php  if(isset($_SESSION['usuario'])) {
            ?>
            <a class="navbar-brand" href="/Model/Cerrar_sesion.php">Cerrar sesion</a>
            <?php echo $_SESSION['usuario'] ." " . $_SESSION['mail'];} ?>
    </nav>



  <!-- The Modal -->

  
</div>
<?php

    //Generate a random string.
    $token = openssl_random_pseudo_bytes(164);

    //Convert the binary data into hexadecimal representation.
    $token = bin2hex($token);

    //Print it out for example purposes.
    //echo $token;
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content col-12">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Enllaç per invitar un professor</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Copia el link i passa-li a un professor!
        </div>     
        <!-- Modal footer -->     
        <div class="modal-footer"> 

                <label style="font-weight: 600">Link <span class="message"></span></label><br/>
                    <div class="row">
                            <input class="col-10 ur" type="url" value=<?php echo "http://localhost/index.php?query=3&token=0000" ?> id="myInput" aria-describedby="inputGroup-sizing-default" size="30" style="height: 40px;"> 
                            <button class="cpy" onclick="copiado()">
                            <i class="far fa-clone"></i>
                            </button> 
                        
                    </div>
        </div>
        
      </div>
    </div>
  </div>