<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>TFG - Editar problema</title>

    <link rel="stylesheet" href="/View/css/style.css"/>
    <link rel="stylesheet" href="/View/css/external/bootstrap.min.css">
    <link rel="stylesheet" href="/View/css/external/all.css">
    <link rel="shortcut icon" href="/View/images/favicon.png">

    <script src="/View/js/global.js"></script>
    <script src="/View/js/problemValidation.js"></script>
    <script src="/View/js/external/jquery.min.js"></script>
    <script src="/View/js/external/popper.min.js"></script>
    <script src="/View/js/external/bootstrap.min.js"></script>
    <script src="/View/js/external/all.min.js"></script>
</head>

<body class="bg-primary d-flex flex-column min-vh-100">
<?php include_once(__DIR__ . "/header.php") ?>

<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>Formulari editar problema</strong></h2>
                <p>Recorda que a l'hora d'editar el problema els canvis es guardaran automaticament! </p>
                <p> No es podra editar el titol ja que forma part de les rutes de les solucions.</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" action="/Controller/problemUpdate.php" method="post"
                              onsubmit="return validateProblem();" enctype="multipart/form-data">
                            <fieldset>
                                <legend>Information to edit</legend>
                                <div class="form-card">
                                    <h2 class="fs-title">Detalls</h2>

                                    <label for="description">Descripcio</label>
                                    <textarea type="text" name="description" id="description"
                                              placeholder="Descripció del problema"
                                              rows="3"><?php if (!empty($description)) {
                                                            echo $description;
                                                        } ?>
                                    </textarea>
                                    <div class="form-group">
                                        <label for="max_execution_time">Temps execució en segons</label>
                                        <select class="form-control" name="max_execution_time" id="max_execution_time">
                                            <option>5</option>
                                            <option>10</option>
                                            <option>20</option>
                                            <option>60</option>
                                            <option>120</option>
                                            <option>Ilimitat</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="max_memory_usage">Memoria per utilitzar en Mb</label>
                                        <select class="form-control" name="max_memory_usage" id="max_memory_usage">
                                            <option>50</option>
                                            <option>100</option>
                                            <option>200</option>
                                            <option>600</option>
                                            <option>1200</option>
                                            <option>Il·limitat</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="problem_id" value="<?php echo $_GET["problem"] ?>"/>
                                    </div>

                                </div>
                                <input type="submit" name="next" class="next action-button" value="Editar"/>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <p class="alert alert-danger hide" id="error_msg">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </p>
</div>

<?php include_once(__DIR__ . "/footer.html") ?>
</body>
