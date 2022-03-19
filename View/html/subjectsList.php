<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>TFG - Assignatures</title>

    <link rel="stylesheet" href="/View/css/style.css"/>
    <link rel="stylesheet" href="/View/css/subjectsList.css"/>
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

<div class="container">
    <h1 class="font-weight-bold text-center text-uppercase h-25">Assignatures</h1>

    <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 0) { ?>
        <a href="/index.php?query=10" class="btn btn-light btn-sm  mb-1 "> Crear Asignatua </a>
    <?php } ?>

    <?php if (isset($_GET['err'])) { ?>
        <p class="alert alert-danger" id="error_mssg"> Inicia sessió o registra't
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </p>
    <?php } ?>

    <?php if (!empty($subjects)) {
        foreach ($subjects as $subject) { ?>
            <div class="card">
                <h5 class="card-header"> Curs <?php echo $subject['course'] ?></h5>
                <div class="card-body">
                    <h5 class="card-title"> <?php echo $subject['title'] ?> </h5>
                    <p class="card-text"> <?php echo $subject['description'] ?></p>
                    <a href="<?php echo "/index.php?query=1&subject=" . $subject['id'] ?>"
                       class="btn btn-primary">Accedeix</a>
                </div>
            </div>
        <?php }
    } ?>

</div>
<?php include_once(__DIR__ . "/footer.html") ?>
</body>
