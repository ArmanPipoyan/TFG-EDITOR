<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>TFG - Problemes</title>

    <link rel="stylesheet" href="/View/css/style.css"/>
    <link rel="stylesheet" href="/View/css/subjectsList.css"/>
    <link rel="stylesheet" href="/View/css/external/bootstrap.min.css">
    <link rel="stylesheet" href="/View/css/external/all.css">
    <link rel="shortcut icon" href="/View/images/favicon.png">

    <script src="/View/js/global.js"></script>
    <script src="/View/js/problemsList.js"></script>
    <script src="/View/js/external/jquery.min.js"></script>
    <script src="/View/js/external/popper.min.js"></script>
    <script src="/View/js/external/bootstrap.min.js"></script>
    <script src="/View/js/external/all.min.js"></script>
</head>

<body class="bg-primary d-flex flex-column min-vh-100">
<?php include_once(__DIR__ . "/header.php") ?>

<h1 class="font-weight-bold text-center text-uppercase h-25">Problemes</h1>

<div class="container mt-18">
    <?php if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] == 0)) { ?>
        <a href="<?php echo "/index.php?query=4&subject=" . $_GET['subject']; ?>"
           class="btn btn-light btn-sm mb-1 ">Crear problema </a>
    <?php } ?>
    <div class="card border-0 shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0">
                    <tbody>
                    <?php if (!empty($problems)) {
                        foreach (array_values($problems) as $i => $problem) {
                            if ($_SESSION['user_type'] == 0 || $problem["visibility"] == "Public") { ?>
                                <tr>
                                    <th scope="row"><?php echo $i ?></th>
                                    <td>
                                        <a href="<?php echo '/index.php?query=7&problem=' . $problem['id'] ?>"
                                           class="text-dark">
                                            <div><?php echo $problem['title'] ?></div>
                                        </a>
                                    </td>
                                    <?php if ($_SESSION['user_type'] == 0) { ?>
                                        <td>
                                            <ul class="list-inline m-0">
                                                <li class="list-inline-item">
                                                    <a href="<?php echo '/index.php?query=12&problem=' . $problem['id'] ?>"
                                                       class="btn btn-primary btn-sm rounded-0" type="button"
                                                       data-toggle="tooltip" data-placement="top" title="Add"><i
                                                                class="fas fa-table"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="<?php echo '/index.php?query=7&problem=' . $problem['id'] . '&edit=1' ?>"
                                                       class="btn btn-success btn-sm rounded-0" type="button"
                                                       data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                                class="fas fa-edit"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <button class="btn btn-danger btn-sm rounded-0" type="button"
                                                            data-toggle="modal" data-target="#my-modal"
                                                            data-placement="top" title="Delete"
                                                            onclick="setProblemToDelete(<?php echo $problem['id'] ?>)">
                                                        <i class="fas fa-trash"></i></button>
                                                </li>
                                                <li class="list-inline-item">
                                                    <button class="btn btn-info btn-sm rounded-0" type="button"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="<?php echo $problem['visibility'] ?>"
                                                            variable="<?php echo $problem['visibility'] ?>"
                                                            onclick="changeVisibility(this.title, <?php echo $problem['id'] ?>)">
                                                        <i class="fas fa-eye"></i></button>
                                                </li>
                                            </ul>
                                        </td>
                                    <?php } ?>
                                    <?php if ($problem["visibility"] == "Public") { ?>
                                        <td id=<?php echo $problem['id'] ?>>Public</td>
                                    <?php } else { ?>
                                        <td id=<?php echo $problem['id'] ?>>Privat</td>
                                    <?php } ?>
                                </tr>
                            <?php }
                        }
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


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
                        <p class="font-weight-bold mb-2"> Estas segur d'esborrar aquest problema ?</p>
                        <p class="text-muted "> Si l'esborres no tindras opció a recuperar-lo i serà immediat.</p>
                    </div>
                    <div class="card-body px-sm-4 mb-2 pt-1 pb-0">
                        <div class="row justify-content-end no-gutters">
                            <div class="col-auto mr-1">
                                <button type="button" class="btn btn-light text-muted" data-dismiss="modal">Cancelar
                                </button>
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-danger px-4" onclick="deleteProblem()"
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

<?php include_once(__DIR__ . "/footer.html") ?>
</body>