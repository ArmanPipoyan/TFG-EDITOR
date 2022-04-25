<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>TFG - Editor</title>

    <link rel="stylesheet" href="/View/css/style.css"/>
    <link rel="stylesheet" href="/View/css/editor.css"/>
    <link rel="stylesheet" href="/View/css/external/w3.css">
    <link rel="stylesheet" href="/View/css/external/bootstrap.min.css">
    <link rel="stylesheet" href="/View/css/external/all.css">
    <link rel="shortcut icon" href="/View/images/favicon.png">

    <script src="/View/js/external/jquery.min.js"></script>
    <script src="/View/js/external/popper.min.js"></script>
    <script src="/View/js/external/bootstrap.min.js"></script>
    <script src="/View/js/external/all.min.js"></script>
    <script src="/View/js/external/editor/ace.js"></script>
    <script src="/View/js/external/editor/theme-monokai.js"></script>
    <script src="/View/js/editor.js"></script>
    <script src="/View/js/global.js"></script>
</head>

<body>
<?php include_once(__DIR__ . '/header.php') ?>
<p id="user_type" hidden><?php echo $_SESSION['user_type'] ?></p>
<p id="view_mode" hidden><?php echo $_SESSION['view_mode'] ?></p>
<?php if ($_SESSION['user_type'] == PROFESSOR && isset($_GET["edit"]) && !empty($cleaned_problem_route)) { ?>
    <p id="folder_route" hidden><?php echo $cleaned_problem_route ?></p>
<?php } else if (!empty($cleaned_user_solution_route)) { ?>
    <p id="folder_route" hidden><?php echo $cleaned_user_solution_route ?></p>
<?php } ?>

<?php if ($_SESSION['user_type'] == PROFESSOR) { ?>
    <!-- Student sidebar used for the professors -->
    <?php if (!empty($students)) { ?>
        <div class="w3-teal ">
            <button id="menu-button" class="w3-button w3-teal w3-xlarge w3-right">Estudiants &#9776;</button>
            <?php if (isset($_GET["view-mode"])) { ?>
                <a class="w3-button w3-teal w3-xlarge w3-right"
                   href=<?php echo"/index.php?query=7&problem=".$_GET["problem"]."&session=".$_GET['session']?>>
                    Tornar enrere</a>
            <?php } ?>
        </div>
    <?php } ?>

    <div class="w3-sidebar w3-bar-block w3-card  w3-animate-right mt-5" id="student-menu">
        <ul class="list-group list-group-flush">
            <?php if (!empty($students)) {
                foreach ($students as $student) { ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center ">
                        <a href=<?php echo "/index.php?query=7&problem=".$_GET["problem"]."&view-mode=1&user=".
                            $student["user"]."&session=".$_GET['session'] ?>
                           class="w3-bar-item  w3-button"><?php echo $student["user"] ?></a>
                        <a href=<?php echo "/index.php?query=7&problem=".$_GET["problem"]."&view-mode=2&user=".
                            $student["user"]."&session=".$_GET['session'] ?>
                           class="btn btn-success btn-sm rounded-0" title="Veure"><i class="fas fa-eye"></i></a>
                    </li>
                <?php }
            } ?>
        </ul>
    </div>
<?php } ?>

<?php if ((!empty($solution)) && ($solution["edited"] == 1)) { ?>
    <div class="container">
        <p class="alert alert-info " id="edition_msg"><strong> Vols obtenir els canvis del professor </strong>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <button type="button" class="close" data-toggle="modal" data-target="#my-modal3">Si</button>
    </div>
<?php } ?>

<?php if ($_SESSION['user_type'] == PROFESSOR && isset($_GET["edit"])) { ?>
    <div class="container">
        <p class="alert alert-warning" id="error_msg"><strong> Estas modificant el problema arrel </strong>
    </div>
<?php } ?>

<?php if (isset($_GET["uploaded"])) { ?>
    <?php $string = $_GET["uploaded"]? "s'ha": "no s'ha"; ?>
    <div class="container">
        <p class="alert alert-warning"><strong> <?php echo "El problema $string pujat a GitHub." ?> </strong>
    </div>
<?php } ?>

<div class="container">
    <p class="alert alert-warning hide" id="root_modified"><strong>El professor esta editant </strong>
</div>

<div class="container">
    <p class="alert alert-danger hide" id="error_msg_libraries"><strong>Les llibreries que s'estan utilitzant no estan
            soportades </strong>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </p>
</div>
<div class="container bg-dark ">
    <?php if (!empty($problem)) { ?>
        <p class="text-center text-white font-weight-bold"><?php echo $problem["title"]; ?></p>
        <p id="programming_language" hidden><?php echo $problem["language"]; ?></p>
        <button type="button" class="collapsible bg-dark"><i class="fas fa-expand"></i>Descripció</button>
        <div class="content bg-dark text-white"><p><?php echo htmlspecialchars($problem["description"]); ?></p></div>
    <?php } ?>

    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#my-modal2">New file <i class="fas fa-file"></i></button>
    <button class="btn btn-primary btn-sm" onclick="executeCode()"> Executa <i class="fas fa-play" aria-hidden="true"></i></button>

    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#upload-to-github-modal"><i class="fas fa-arrow-up"></i></button>
    <button class="btn btn-primary btn-sm"><i class="fas fa-arrow-down"></i></button>
    <img id="save" class="mr-0" onclick="save()" src="/View/images/save.svg" alt=""/>

    <div id="files" class="mt-1"></div>
    <div id="editor" contenteditable="true"></div>

    <div class="output bg-light" id="answer"></div>
</div>

<!--  MODALS -->
<div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="modal-body p-0">
                <div class="card border-0 p-sm-3 p-2 justify-content-center">
                    <div class="card-header pb-0 bg-white border-0 ">
                        <div class="row">
                            <div class="col ml-auto">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                            </div>
                        </div>
                        <p class="font-weight-bold mb-2"> Estas segur d'esborrar aquest arxiu ?</p>
                        <p class="text-muted "> Si l'esborres no tindras opció a recuperar-lo i serà immediat.</p>
                    </div>
                    <div class="card-body px-sm-4 mb-2 pt-1 pb-0">
                        <div class="row justify-content-end no-gutters">
                            <div class="col-auto mr-1">
                                <button type="button" class="btn btn-light text-muted" data-dismiss="modal">Cancelar
                                </button>
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-danger px-4" onclick="deleteArchivo()"
                                        data-dismiss="modal">Eliminar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="my-modal2" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="modal-body p-0">
                <div class="card border-0 p-sm-3 p-2 justify-content-center">
                    <div class="card-header pb-0 bg-white border-0 ">
                        <div class="row">
                            <div class="col ml-auto">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                            </div>
                        </div>
                        <p class="font-weight-bold mb-2"> Crear una nova fulla</p>
                        <p class="text-muted "> Importar fulla des de l'ordinador o un full en blanc.</p>
                    </div>
                    <div class="card-body px-sm-4 mb-2 pt-1 pb-0">
                        <div class="row justify-content-end no-gutters">
                            <form action="/Controller/addFileFromPC.php" method="post" enctype="multipart/form-data">
                                <div class="col-auto mr-1">
                                    <button type="submit" onclick="recibirFichero()" class="btn btn-light text-muted"
                                            data-dismiss="modal">Importar desde l'ordinador
                                    </button>
                                </div>
                                <input type="file" name="file[]" style="display:none;" id="my_file" multiple>
                                <div class="form-group">
                                    <input type="hidden" name="token"
                                           value="<?php if (!empty($cleaned_user_solution_route))
                                               echo $cleaned_user_solution_route; ?>"/>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="problem" value="<?php echo $_GET['problem']; ?>"/>
                                </div>
                                <?php if ($_SESSION['user_type'] == PROFESSOR && isset($_GET["edit"])) { ?>
                                    <div class="form-group">
                                        <input type="hidden" name="edit" value="1"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="token"
                                               value="<?php if (!empty($cleaned_problem_route))
                                                   echo $cleaned_problem_route; ?>"/>
                                    </div>
                                <?php } ?>
                            </form>
                            <?php if ($_SESSION['user_type'] == PROFESSOR && isset($_GET["edit"])) { ?>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-danger px-4"
                                            onclick="newFile(1,<?php echo $_GET['problem']; ?>)" data-dismiss="modal">
                                        Arxiu en blanc
                                    </button>
                                </div>
                            <?php } else { ?>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-danger px-4"
                                            onclick="newFile(0,<?php echo $_GET['problem']; ?>)" data-dismiss="modal">
                                        Arxiu en blanc
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="my-modal3" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="modal-body p-0">
                <div class="card border-0 p-sm-3 p-2 justify-content-center">
                    <div class="card-header pb-0 bg-white border-0 ">
                        <div class="row">
                            <div class="col ml-auto">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                            </div>
                        </div>
                        <p class="font-weight-bold mb-2"> Estas segur de sobreescriure les dades del professor?</p>
                        <p class="text-muted "> Si acceptes no tindras opció a recuperar-lo i serà immediat.</p>
                    </div>
                    <div class="card-body px-sm-4 mb-2 pt-1 pb-0">
                        <div class="row justify-content-end no-gutters">
                            <div class="col-auto mr-1">
                                <button type="button" class="btn btn-light text-muted" data-dismiss="modal">Cancelar
                                </button>
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-danger px-4"
                                        id="<?php echo $_GET['problem']; ?>"
                                        onclick="acceptChanges(<?php echo $_GET['problem']; ?>)"
                                        data-dismiss="modal">Obtenir canvis
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="upload-to-github-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="modal-body p-0">
                <div class="card border-0 p-sm-3 p-2 justify-content-center">
                    <div class="card-header pb-0 bg-white border-0 ">
                        <div class="row">
                            <div class="col ml-auto">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <p class="font-weight-bold mb-2">Pujar solució a GitHub</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-sm-4 mb-2 pt-1 pb-0">
                        <form id="upload-to-github-form" class="form" action="/Controller/githubUpload.php" method="post">
                            <input type="url" name="repo_link" id="repo_link" placeholder="Link del repository github"/>
                            <div class="row justify-content-end no-gutters">
                                <div class="col-auto mr-1">
                                    <button type="button" class="btn btn-light text-muted" data-dismiss="modal">Cancelar
                                    </button>
                                </div>
                                <div class="col-auto">
                                    <input type="submit" class="btn btn-success px-4" value="Pujar"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once(__DIR__ . '/footer.html') ?>
</body>