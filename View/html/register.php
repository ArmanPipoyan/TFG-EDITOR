<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>TFG - Registre</title>

    <link rel="stylesheet" href="/View/css/style.css"/>
    <link rel="stylesheet" href="/View/css/subjectsList.css"/>
    <link rel="stylesheet" href="/View/css/external/bootstrap.min.css">
    <link rel="stylesheet" href="/View/css/external/all.css">
    <link rel="shortcut icon" href="/View/images/favicon.png">

    <script src="/View/js/global.js"></script>
    <script src="/View/js/userManagement.js"></script>
    <script src="/View/js/external/jquery.min.js"></script>
    <script src="/View/js/external/popper.min.js"></script>
    <script src="/View/js/external/bootstrap.min.js"></script>
    <script src="/View/js/external/all.min.js"></script>
</head>

<body class="bg-primary d-flex flex-column min-vh-100">
<?php include_once(__DIR__ . "/header.php") ?>

<body>
<div id="login">
    <h3 class="text-center text-white pt-3">Formulari Registre</h3>

    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="/Controller/register.php?query=5" method="post"
                          onsubmit="return validateRegister();">
                        <h3 class="text-center text-info">Registre</h3>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="first_name"></label>
                                    <input type="text" name="first_name" id="first_name" class="form-control input-sm"
                                           placeholder="Nom">
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="last_name"></label>
                                    <input type="text" name="last_name" id="last_name" class="form-control input-sm"
                                           placeholder="Cognoms">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email"></label>
                            <input type="email" name="email" id="email" class="form-control input-sm"
                                   placeholder="Email">
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="password"></label>
                                    <input type="password" name="password" id="password" class="form-control input-sm"
                                           placeholder="Contrasenya">
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation"></label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                           class="form-control input-sm" placeholder="Confirmació Contrasenya">
                                </div>
                            </div>
                        </div>
                        <?php if (isset($_GET["token"])) { ?>
                            <div class="form-group">
                                <input type="hidden" name="token" value="<?php echo $_GET["token"] ?>"/>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-info btn-md" value="Registra't">
                        </div>
                        <div id="register-link" class="text-right">
                            <a href="/index.php?query=2" class="text-info">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <?php if (isset($_GET["error"])) {
        if ($_GET["error"] == 3) { ?>
            <p class="alert alert-danger" id="error_msg"> El usuari ja existeix
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </p>
        <?php } ?>

        <?php if ($_GET["error"] == 2) { ?>
            <p class="alert alert-danger" id="error_msg"> Token de registre invalid
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </p>
        <?php } ?>
    <?php } ?>

    <p class="alert alert-danger hide" id="error_msg">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </p>
</div>

<?php include_once(__DIR__ . "/footer.html") ?>
</body>

