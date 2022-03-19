<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>TFG - Nova assignatura</title>

    <link rel="stylesheet" href="/View/css/style.css"/>
    <link rel="stylesheet" href="/View/css/external/bootstrap.min.css">
    <link rel="stylesheet" href="/View/css/external/all.css">
    <link rel="shortcut icon" href="/View/images/favicon.png">

    <script src="/View/js/global.js"></script>
    <script src="/View/js/subjectValidation.js"></script>
    <script src="/View/js/external/jquery.min.js"></script>
    <script src="/View/js/external/popper.min.js"></script>
    <script src="/View/js/external/bootstrap.min.js"></script>
    <script src="/View/js/external/all.min.js"></script>
</head>


<body class="bg-primary d-flex flex-column min-vh-100">
<?php include_once(__DIR__ . "/header.php") ?>

<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>Crea una nova Assignatura</strong></h2>
                <p>Crea una nova asignautra i comença a pujar nous problemes</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" action="/Controller/subjectNew.php" method="post"
                              onsubmit="return validateSubject();">

                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Detalls</h2>
                                    <label for="title"></label>
                                    <input type="text" name="title" id="title"
                                           placeholder="Títol de l'assignatura"/>
                                    <label for="description"></label>
                                    <textarea type="text" name="description" id="description"
                                               placeholder="Descripció de l'assignatura" rows="3"></textarea>
                                    <label for="course"></label>
                                    <input type="number" name="course" id="course"
                                           placeholder="Curs on es realitzaran"/>
                                </div>
                                <input type="submit" name="next" class="next action-button" value="Crear"/>
                            </fieldset>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <p class="alert alert-danger hide" id="error_mssg">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </p>
</div>

<?php include_once(__DIR__ . "/footer.html") ?>
</body>