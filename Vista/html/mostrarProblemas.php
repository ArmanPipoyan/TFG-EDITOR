
<br>
<br>
<h1 class="font-weight-bold text-center text-uppercase h-25">Problemes</h1>
<br>
<div class="container mt-18">
<?php

echo '<div class="list-group">';

$i=0;
foreach ($data as $dat) {
    echo '<a href="/index.php?query=7&problem=' . $dat[0] . '" class="list-group-item list-group-item-action  ruta="'.$dat["Ruta"].'" onclick="openFolder(this.ruta);" id=' . $dat[0] . '">' . $i . " " . $dat[2] . '</a>';
    $i++;
}

  echo'</div>';



    





?>
</div>
