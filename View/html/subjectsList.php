<div class="container">
    <br>
    <h1 class="font-weight-bold text-center text-uppercase h-25">Assignatures</h1>
    <br>
    <?php
    if (isset($_SESSION['tipo'])) {
        if ($_SESSION['tipo'] == 0) {
            echo '<a href= "/index.php?query=10"  class="btn btn-light btn-sm  mb-1 "> Crear Asignatua </a>';
        }
    } ?>

    <?php
    if (isset($_GET['err'])) {
        echo '<p class="alert alert-danger" id="error_mssg"> Inicia sessió o registra' . "'" . 't
    <button type="button" class="close" data-dismiss="alert">&times;</button></p>';
    }

    foreach ($data as $dat) {
        echo '<div class="card">
    <h5 class="card-header"> Curs ' . $dat['course'] . '</h5>
    <div class="card-body">
        <h5 class="card-title">' . $dat['title'] . '</h5>
        <p class="card-text">' . $dat['description'] . '</p>
        <a href="/index.php?query=1&assignatura=' . $dat['id'] . '"  class="btn btn-primary">Accedeix </a>
    </div>
    </div> <br>';

    }

    ?>

</div>