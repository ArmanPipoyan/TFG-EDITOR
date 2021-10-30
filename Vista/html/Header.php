<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>TFG</title>

    <link rel="stylesheet" href="Vista/css/style.css" />
    <link rel="shortcut icon" href="/Vista/imagenes/descarga.png" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="Vista/js/ide.js"></script>
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


        </ul>

    </div>
        
        <?php  if(isset($_SESSION['usuario'])) {
            ?>
            <a class="navbar-brand" href="/Model/Cerrar_sesion.php">Cerrar sesion</a>
            <?php echo $_SESSION['usuario'] ." " . $_SESSION['mail'];} ?>
    </nav>