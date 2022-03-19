<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>TFG - Login</title>

    <link rel="stylesheet" href="/View/css/style.css"/>
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

<body>
<?php include_once(__DIR__ . '/header.php') ?>

<div id="login">
    <div class="container">
        <h3 class="text-center text-white pt-5">Formulari d'inici de sessió</h3>
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="/Controller/login.php" method="post"
                          onsubmit="return validateLogin();">
                        <h3 class="text-center text-info">Iniciar sessió</h3>
                        <div class="form-group">
                            <label for="email" class="text-info">Email:</label><br>
                            <input type="email" name="email" id="email" class="form-control input-sm"
                                   placeholder="exemple@gmail.com" value="punyetazo@gmail.com">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Contrasenya:</label><br>
                            <input type="password" name="password" id="password" class="form-control" value="123456789">
                        </div>
                        <div class="form-group">
                            <label for="remember-me" class="text-info"><span>Recorda'm</span> <span><input
                                    id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                            <input type="submit" name="submit" class="btn btn-info btn-md" value="Login">
                        </div>
                        <div id="register-link" class="text-right">
                            <a href="/index.php?query=3" class="text-info">Registra't</a>
                        </div>
                    </form>
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

<?php include_once(__DIR__ . '/footer.html') ?>
</body>