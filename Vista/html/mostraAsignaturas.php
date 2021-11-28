<div class="container">
    <br>
<h1 class="font-weight-bold text-center text-uppercase h-25">Assignatures</h1>
<br>
<?php
foreach ($data as $dat) {
    echo '<div class="card">
    <h5 class="card-header"> Curs '.$dat['Curs'].'</h5>
    <div class="card-body">
        <h5 class="card-title">'.$dat['Titol'].'</h5>
        <p class="card-text">'.$dat['Descripcio'].'</p>
        <a href="/index.php?query=1&assignatura='.$dat['Id'].'" class="btn btn-primary">Accedeix </a>
    </div>
    </div> <br>';

}

?>

</div>