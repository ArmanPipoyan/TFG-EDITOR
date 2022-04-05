<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>TFG - Sessió</title>

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
                                    <button class="btn btn-danger btn-sm rounded-0 float-right" type="button"
                                            data-placement="top" title="Delete"
                                            onclick="deleteSession(<?php echo $session['id'] ?>)">
                                        <i class="fas fa-trash"></i></button>
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

<?php include_once(__DIR__ . "/footer.html") ?>
</body>