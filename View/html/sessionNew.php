<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>TFG - Nova sessió</title>

    <link rel="stylesheet" href="/View/css/style.css"/>
    <link rel="stylesheet" href="/View/css/external/bootstrap.min.css">
    <link rel="stylesheet" href="/View/css/external/all.css">
    <link rel="shortcut icon" href="/View/images/favicon.png">

    <script src="/View/js/global.js"></script>
    <script src="/View/js/session.js"></script>
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
                <h2><strong>Crea una nova Sessió</strong></h2>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" action="/Controller/sessionNew.php" method="post"
                              onsubmit="return validateSession();">
                            <fieldset>
                                <legend>Session information</legend>
                                <div class="form-card">
                                    <h2 class="fs-title">Detalls</h2>
                                    <label for="subject"></label>
                                    <input type="text" name="subject" id="subject" value="<?php echo $_GET['subject']?>"
                                           hidden/>
                                    <label for="name"></label>
                                    <input type="text" name="name" id="name"
                                           placeholder="Nom de la sessió"/>
                                    <label for="problems"></label>
                                    <select name="problems[]" id="problems" multiple>
                                        <?php if (!empty($problems)) {
                                            foreach ($problems as $problem) { ?>
                                                <option value="<?php echo $problem['id'] ?>">
                                                    <?php echo $problem['title'] ?>
                                                </option>
                                            <?php }
                                        } ?>
                                    </select>
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
    <p class="alert alert-danger hide" id="error_msg">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </p>
</div>

<?php include_once(__DIR__ . "/footer.html") ?>
</body>