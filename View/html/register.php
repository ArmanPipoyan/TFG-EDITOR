<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
      rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<body>
<div id="login">
    <h3 class="text-center text-white pt-3">Formulari Registre</h3>

    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="/Controller/register.php?query=5" method="post"
                          onsubmit="return validarRegistro();">
                        <h3 class="text-center text-info">Registre</h3>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="first_name" id="first_name" class="form-control input-sm"
                                           placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="last_name" id="last_name" class="form-control input-sm"
                                           placeholder="Last Name">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control input-sm"
                                   placeholder="Email Address">
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control input-sm"
                                           placeholder="Password">
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                           class="form-control input-sm" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>
                        <?php if (isset($_GET["token"])) { ?>
                            <div class="form-group">
                                <input type="hidden" name="token" value="<?php echo $_GET["token"] ?>"/>
                            </div>
                        <?php } ?>
                        <div class="form-group">

                            <br>
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
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == 3) { ?>
            <p class="alert alert-danger" id="error_mssg"> El usuari ja existeix
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </p>
        <?php } ?>

        <?php if ($_GET["error"] == 2) { ?>
            <p class="alert alert-danger" id="error_mssg"> Token de registre invalid
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </p>
        <?php } ?>


    <?php } ?>


    <p class="alert alert-danger hide" id="error_mssg">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </p>

</div>
</body>

