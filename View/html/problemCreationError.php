<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>TFG - Error al crear el problema</title>

    <link rel="stylesheet" href="/View/css/style.css"/>
    <link rel="stylesheet" href="/View/css/external/bootstrap.min.css">
    <link rel="stylesheet" href="/View/css/external/all.css">
    <link rel="shortcut icon" href="/View/images/favicon.png">

    <script src="/View/js/global.js"></script>
    <script src="/View/js/external/jquery.min.js"></script>
    <script src="/View/js/external/popper.min.js"></script>
    <script src="/View/js/external/bootstrap.min.js"></script>
    <script src="/View/js/external/all.min.js"></script>
</head>


<body class="bg-primary d-flex flex-column min-vh-100">
<?php include_once(__DIR__ . "/header.php") ?>

<div class="jumbotron text-center">
    <h1 class="display-3">Hi ha hagut un error amb el problema.</h1>
    <p class="lead"><strong>El problema no s'ha creat </strong> verifica que el tamany dels arxius es adecuat i que les
        extensions dels fichers son correctes.</p>
    <p class="lead">
        <a class="btn btn-primary btn-sm" href="/" role="button">Anar a la pagina principal</a>
    </p>
</div>

<?php include_once(__DIR__ . "/footer.html") ?>
</body>