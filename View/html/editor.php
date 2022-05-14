<?php if (!isset($problem)) {
    redirectLocation();
} ?>

<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>TFG - Editor</title>

    <link rel="shortcut icon" href="/View/images/favicon.png">
    <link rel="stylesheet" href="/View/css/external/w3.css">
    <link rel="stylesheet" href="/View/css/external/bootstrap.min.css">
    <link rel="stylesheet" href="/View/css/external/bootstrap-toggle.min.css">
    <link rel="stylesheet" href="/View/css/external/all.css">
    <link rel="stylesheet" href="/View/css/editor.css"/>
    <link rel="stylesheet" href="/View/css/forms.css"/>
    <link rel="stylesheet" href="/View/css/style.css"/>

    <script src="/View/js/external/jquery.min.js"></script>
    <script src="/View/js/external/popper.min.js"></script>
    <script src="/View/js/external/bootstrap.min.js"></script>
    <script src="/View/js/external/bootstrap-toggle.min.js"></script>
    <script src="/View/js/external/all.min.js"></script>
    <script src="/View/js/external/editor/ace.js"></script>
    <script src="/View/js/external/editor/theme-monokai.js"></script>
    <script src="/View/js/editor.js"></script>
    <script src="/View/js/global.js"></script>
</head>

<body class="d-flex flex-column min-vh-100" <?php echo $_SESSION['theme'] ?>>
<?php include_once(__DIR__ . '/header.php') ?>
<?php if (!empty($folder_route)) { ?>
    <p id="folder_route" hidden><?php echo $folder_route ?></p>
<?php } ?>

<?php if ($_SESSION['user_type'] == PROFESSOR) { ?>
    <!-- Student sidebar used for the professors -->
    <?php if (!empty($students)) { ?>
        <div class="w3-teal ">
            <button id="menu-button" class="w3-button w3-teal w3-xlarge w3-right">Estudiants &#9776;</button>
            <?php if (isset($_GET["view-mode"])) { ?>
                <a class="w3-button w3-teal w3-xlarge w3-right"
                   href="<?php echo"/index.php?query=7&problem=".$_GET['problem']."&session=".$_GET['session']?>">
                    Tornar enrere</a>
            <?php } ?>
        </div>
    <?php } ?>

    <div class="w3-sidebar w3-bar-block w3-card  w3-animate-right mt-5" id="student-menu">
        <ul class="list-group list-group-flush">
            <?php if (!empty($students)) {
                foreach ($students as $student) { ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center ">
                        <a href="<?php echo "/index.php?query=7&problem=".$_GET['problem']."&view-mode=1&user=".
                            $student["user"]."&session=".$_GET['session'] ?>"
                           class="w3-bar-item  w3-button"><?php echo $student["user"] ?></a>
                        <a href="<?php echo "/index.php?query=7&problem=".$_GET['problem']."&view-mode=2&user=".
                            $student["user"]."&session=".$_GET['session'] ?>"
                           class="btn btn-success btn-sm rounded-0" title="Veure"><i class="fas fa-eye"></i></a>
                    </li>
                <?php }
            } ?>
        </ul>
    </div>
<?php } ?>

<div class="container-fluid">
    <?php if ((!empty($solution)) && ($solution["edited"] == 1)) { ?>
        <div class="alert alert-info " id="edition_msg">
            <p>Vols obtenir els canvis del professor?</p>
            <div class="alert-buttons">
                <button type="button" class="btn" data-toggle="modal" data-target="#get_changes_modal">Si</button>
                <button type="button" class="btn" data-dismiss="alert">No</button>
            </div>
        </div>
    <?php } ?>
    
    <?php if ($_SESSION['user_type'] == PROFESSOR && isset($_GET["edit"])) { ?>
        <p class="alert alert-warning" id="error_msg"><strong> Estas modificant el problema arrel </strong>
    <?php } ?>
    
    <?php if (isset($_GET["uploaded"])) { ?>
        <?php $negation = $_GET["uploaded"]? "": "no"; ?>
            <p class="alert alert-warning"><strong> <?php echo "El problema $negation s'ha pujat a GitHub." ?> </strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </p>
    <?php } ?>
    
    <p class="alert alert-warning" hidden id="root_modified"><strong>El professor està editant </strong></p>
    <p class="alert alert-danger" hidden id="error_msg_libraries"><strong>Les llibreries que s'estàn utilitzant no estàn
            soportades </strong>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </p>
</div>

<div id="editor-container" class="container-fluid">
    <p class="text-center font-weight-bold"><?php echo $problem["title"]; ?></p>
    <p id="programming_language" hidden><?php echo $problem["language"]; ?></p>
    <button type="button" class="collapsible add-object">
        <img class="icon" src="/View/images/description.png" alt="Afegit fitxer">
    </button>
    <div class="content"><p><?php echo htmlspecialchars($problem["description"]); ?></p></div>

    <button class="btn" onclick="executeCode()" title="Executar">
        <img class="icon" src="/View/images/execute.png" alt="Executar">
    </button>
    <button class="btn add-object" data-toggle="modal" data-target="#add_file_modal" title="Afegit fitxer">
        <img class="icon" src="/View/images/file.png" alt="Afegit fitxer">
    </button>
    <button id="github-add-file" class="btn github" data-toggle="modal" data-target="#github-form-modal"
            title="Afegir fitxer desde GitHub">
        <img class="icon" src="/View/images/file.png" alt="Afegir fitxer desde GitHub">
    </button>
    <button id="save" class="btn" onclick="save()" title="Guardar">
        <img class="icon" src="/View/images/save.png" alt="Guardar"/>
    </button>
    <button id="github-upload" class="btn github" data-toggle="modal" data-target="#github-form-modal"
            title="Pujar a GitHub">
        <img class="icon github" src="/View/images/save.png" alt="Pujar a GitHub">
    </button>

    <div id="files" class="mt-1"></div>
    <div id="editor" contenteditable="true"></div>
    <div id="notebook"></div>

    <div id="answer"></div>
</div>

<!--  MODALS -->
<div id="delete_file_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h4 class="modal-title">Estàs segur?</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>L'operació serà immediata i sense possibilitat de retorn.</p>
                    <div class="modal-buttons">
                        <button type="button" class="btn" data-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="button" class="btn" onclick="deleteFile()" data-dismiss="modal">
                            Esborrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="add_file_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
                                    <button type="submit" onclick="receiveFile()" class="btn btn-light text-muted"
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


<div id="get_changes_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h4 class="modal-title">Estàs segur?</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>L'operació serà immediata i sense possibilitat de retorn.</p>
                    <div class="modal-buttons">
                        <button type="button" class="btn" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="button" class="btn" id="<?php echo $_GET['problem']; ?>"
                                onclick="acceptChanges(this.id)" data-dismiss="modal">
                            Obtenir canvis
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="github-form-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h4 id="github-from-modal-title" class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="github-form" method="post" action="/Controller/githubAddOrUploadFiles.php">
                        <div class="input-container">
                            <input id="repo_link" class="input" type="url" name="repo_link" placeholder=" " required/>
                            <div class="cut"></div>
                            <label for="repo_link" class="placeholder ">Link del repositori GitHub</label>
                        </div>
                        <div class="modal-buttons">
                            <button type="button" class="btn" data-dismiss="modal">
                                Cancelar
                            </button>
                            <input id="github-form-submit-input" class="btn" type="submit"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once(__DIR__ . '/footer.html') ?>
</body>