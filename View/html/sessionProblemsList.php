<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>TFG - Problemes de la sessió</title>

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

<h1 class="font-weight-bold text-center text-uppercase h-25">Problemes de la sessió</h1>

<div class="container mt-18">
    <div class="card border-0 shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0">
                    <tbody>
                    <?php if (!empty($problems)) {
                        foreach (array_values($problems) as $i => $problem) {
                            $problem = $problem[0]; ?>
                            <tr>
                                <th scope="row"><?php echo $i ?></th>
                                <td>
                                    <a href="<?php echo '/index.php?query=7&session='.$_GET['session'].'&problem='.$problem['id'] ?>"
                                       class="text-dark">
                                        <div><?php echo $problem['title'] ?></div>
                                    </a>
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