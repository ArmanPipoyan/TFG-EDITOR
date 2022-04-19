<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>TFG - Sessions actives</title>

    <link rel="stylesheet" href="/View/css/style.css"/>
    <link rel="stylesheet" href="/View/css/subjectsList.css"/>
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

<h1 class="font-weight-bold text-center text-uppercase h-25">Sessions actives</h1>

<div class="container mt-18">
    <div class="card border-0 shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0">
                    <tbody>
                    <?php if (!empty($sessions)) {
                        foreach (array_values($sessions) as $i => $session) { ?>
                            <tr>
                                <th scope="row"><?php echo $i ?></th>
                                <td>
                                    <a href="<?php echo '/index.php?query=15&session=' . $session['id'] ?>"
                                       class="text-dark">
                                        <?php echo $session['name'] ?>
                                    </a>
                                    <?php if ($_SESSION['user_type'] == PROFESSOR) { ?>
                                        <button class="btn btn-secondary btn-sm rounded-0 float-right" type="button"
                                                data-placement="top" title="Duplicate"
                                                data-toggle="modal" data-target="#duplicate_session_modal">
                                            <em class="fas fa-clone"></em></button>
                                        <button class="btn btn-danger btn-sm rounded-0 float-right" type="button"
                                                data-placement="top" title="Delete"
                                                onclick="deleteSession(<?php echo $session['id'] ?>)">
                                            <em class="fas fa-trash"></em></button>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php }
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- duplicate modal -->
<div class="modal fade" id="duplicate_session_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content col-12">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Indica el nom de la sessió</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <label hidden for="new_session_name"></label>
                <input class="col-10 ur" type="text" id="new_session_name" placeholder="Nom"
                       aria-describedby="inputGroup-sizing-default" size="30" style="height: 40px;">
                <?php if (!empty($session)) { ?>
                    <button class="btn btn-success btn-sm rounded-0 float-right" type="button"
                            data-placement="top" title="Duplicate"
                            onclick="duplicateSession(<?php echo $session['id'] ?>)">
                        <em class="fas fa-check"></em></button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php include_once(__DIR__ . "/footer.html") ?>
</body>