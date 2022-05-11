<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>TFG - Assignatures</title>

    <link rel="stylesheet" href="/View/css/external/bootstrap.min.css">
    <link rel="stylesheet" href="/View/css/external/bootstrap-toggle.min.css">
    <link rel="stylesheet" href="/View/css/external/all.css">
    <link rel="stylesheet" href="/View/css/style.css"/>
    <link rel="stylesheet" href="/View/css/subjectsList.css"/>
    <link rel="shortcut icon" href="/View/images/favicon.png">

    <script src="/View/js/external/jquery.min.js"></script>
    <script src="/View/js/global.js"></script>
    <script src="/View/js/external/popper.min.js"></script>
    <script src="/View/js/external/bootstrap.min.js"></script>
    <script src="/View/js/external/bootstrap-toggle.min.js"></script>
    <script src="/View/js/external/all.min.js"></script>
</head>

<body class="d-flex flex-column min-vh-100" <?php echo $_SESSION['theme'] ?>>
    <?php include_once(__DIR__ . "/header.php") ?>

    <div class="container">
        <div class="content-header">
            <h1 class="text-capitalize">Assignatures</h1>

            <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == PROFESSOR) { ?>
                <a href="/index.php?query=10" class="btn add-object">
                    <img class="icon" src="/View/images/subject.png" alt="Afegir assignatura">
                </a>
            <?php } ?>
        </div>

        <?php if (isset($_GET['err'])) { ?>
            <p class="alert alert-danger" id="error_msg"> Inicia sessió o registra't
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </p>
        <?php } ?>

        <?php if (!empty($classified_subjects)) {
            foreach ($classified_subjects as $course => $subjects) { ?>
                <button class="collapsible"><h5>Curs <?php echo $course ?></h5></button>
                <div class="content">
                <?php foreach ($subjects as $subject) { ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"> <?php echo $subject['title'] ?> </h5>
                            <p class="card-text"> <?php echo $subject['description'] ?></p>
                            <a href="<?php echo "/index.php?query=1&subject=" . $subject['id'] ?>" class="btn">
                                <img class="icon" src="/View/images/problems.png" alt="Problemes">
                            </a>
                            <?php if ($subject['has_active_sessions']) { ?>
                                <a href="<?php echo "/index.php?query=14&subject=" . $subject['id'] ?>" class="btn">
                                    <img class="icon" src="/View/images/session.png" alt="Sessions actives">
                                </a>
                            <?php }
                            if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == PROFESSOR) { ?>
                                <a href="<?php echo "/index.php?query=13&subject=" . $subject['id']?>"
                                   class="btn add-object">
                                    <img class="icon" src="/View/images/session.png" alt="Crear sessió">
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                </div>
            <?php }
        } ?>
    </div>

    <?php include_once(__DIR__ . "/footer.html") ?>
</body>
