<header class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">TFG</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
                <a class="nav-link" href="/">Home </a>
            </li>
            <?php if (!isset($_SESSION['user_type'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="/index.php?query=2">Iniciar Sessió</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/index.php?query=3">Registre</a>
                </li>

            <?php }
            if (isset($_SESSION['user_type'])) {
                if ($_SESSION['user_type'] == PROFESSOR) { ?>
                    <li class="nav-item">
                        <a class="nav-link" onclick="generateToken()" href="#" data-toggle="modal"
                           data-target="#myModal">Invitar a un professor</a>
                    </li>
                <?php }
            } ?>
        </ul>
    </div>

    <?php if (isset($_SESSION['user'])) { ?>
    <a class="navbar-brand" href="/Model/logout.php"> <i class="fas fa-sign-out-alt"></i> Tancar Sessió </a>

    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="/"><?php echo $_SESSION['user']; } ?></a>
        </li>
    </ul>
</header>

<?php
//Generate a random string.
$token = openssl_random_pseudo_bytes(164);

//Convert the binary data into hexadecimal representation.
$token = bin2hex($token);
?>
<!-- The Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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