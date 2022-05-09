<header class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="/" title="TFG"><img id="logo" src="/View/images/favicon.png" alt="TFG"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-fragment"
            aria-controls="navbar-collapse-fragment" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar-collapse-fragment">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item" title="Pàgina principal">
                <a class="nav-link" href="/">
                    <img class="icon" src="/View/images/home.png" href="/" alt="Pàgina principal">
                </a>
            </li>
            <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == PROFESSOR) { ?>
                <li class="nav-item" title="Invitar professor">
                    <a class="nav-link add-object" onclick="generateToken()" href="" data-toggle="modal"
                       data-target="#inviteProfessorModal">
                        <img class="icon" src="/View/images/professor.png" href="/" alt="Invitar professor">
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>

    <ul class="navbar-nav mr-0">
        <?php if (isset($_SESSION['user'])) { ?>
            <div class="nav-item dropdown">
                <button class="btn dropdown-toggle" type="button" id="user-dropdown" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    Perfil
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="user-dropdown">
                    <h6 class="font-weight-bold">Hola, <?php echo $_SESSION['user']; ?>!</h6>
                    <div class="dropdown-divider"></div>
                    <div class="dark-mode-div">
                        <i id="dark-mode" class="fas fa-moon"></i>
                        <label class="dropdown-item label-dark-mode">
                            <input id="toggle-dark-mode" type="checkbox" data-toggle="toggle">
                            <span id="toggle-ball"></span>
                        </label>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a id="dropdown-item logout-button" class="nav-link text-capitalize" href="/Model/logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                        Tancar Sessió
                    </a>
                </div>
            </div>
        <?php } else { ?>
            <li id="login-button" class="nav-item">
                <a class="nav-link text-capitalize" href="/index.php?query=2">
                    <img class="icon" src="/View/images/user.png" alt="User">
                    Iniciar Sessió
                </a>
            </li>
        <?php } ?>
    </ul>
</header>

<?php
//Generate a random string.
$token = openssl_random_pseudo_bytes(164);

//Convert the binary data into hexadecimal representation.
$token = bin2hex($token);

if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == PROFESSOR) { ?>
    <div class="modal fade" id="inviteProfessorModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content col-12">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Enllaç per invitar un professor</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    Copia el link i passa-li a un professor!
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <label style="font-weight: 600">Link <span class="message"></span></label><br/>
                    <div class="row">
                        <label for="invitation_link"></label>
                        <input class="col-10 ur" type="url" id="invitation_link"
                               aria-describedby="inputGroup-sizing-default" size="30" style="height: 40px;">
                        <button class="cpy" onclick="copyInvitationLink()">
                            <i class="far fa-clone"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>