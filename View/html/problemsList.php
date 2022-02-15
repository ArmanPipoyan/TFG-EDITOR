<br>
<br>
<h1 class="font-weight-bold text-center text-uppercase h-25">Problemes</h1>
<br>

<div class="container mt-18">

    <?php if (isset($_SESSION['tipo'])) {
        if ($_SESSION['tipo'] == 0) { ?>
            <a href=<?php echo "/index.php?query=4&assignatura=" . $_GET["assignatura"]; ?> class="btn btn-light btn-sm
               mb-1 ">Crear problema </a>

        <?php }
    }

    echo '
  <div class="card border-0 shadow">
    <div class="card-body p-0">
        <!-- Responsive table -->
        <div class="table-responsive">
            <table class="table m-0">
                <tbody>';

    $i = 0;
    foreach ($data as $dat) {
        if ($asignatura == $dat['AsignaturaID']) {
            if ($_SESSION['tipo'] == 0 || $dat["Visio"] == "Public") {
                echo ' <tr>
              <th scope="row">' . $i . '</th>

              <td>
              <a href="/index.php?query=7&problem=' . $dat[0] . '" class="text-dark"  > <div style="height:100%;width:100%">' . $dat[2] . ' </div></a>
              </td>';
                if ($_SESSION['tipo'] == 0) {
                    echo '<td>
                  <!-- Call to action buttons -->
                  <ul class="list-inline m-0">
                      <li class="list-inline-item">
                          <a href="/index.php?query=12&problem=' . $dat[0] . '" class="btn btn-primary btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Add"><i class="fa fa-table"></i></a>
                      </li>
                      <li class="list-inline-item">
                          <a href="/index.php?query=7&problem=' . $dat[0] . '&edit=1" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                      </li>
                      <li class="list-inline-item">
                          <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="modal" data-target="#my-modal" data-placement="top" title="Delete" onclick="setPoblemToDelete(' . $dat[0] . ')" ><i class="fa fa-trash"></i></button>
                      </li>
                      <li class="list-inline-item">
                          <button class="btn btn-info btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top"  title="' . $dat["Visio"] . '" variable="' . $dat["Visio"] . '"  onclick="changeVisibility(this.title,' . $dat[0] . ')" ><i class="fa fa-eye"></i></button>
                      </li>

                        </ul>
                   </td>';

                } else {
                    echo '<td>

                      </ul>
                   </td>';

                }


                if ($dat["Visio"] == "Public") {
                    echo '<td id=' . $dat[0] . '>
              Public
              </td>';
                } else {
                    echo '<td id=' . $dat[0] . '>
              Privat
              </td>';
                }


                echo '</tr>';

                $i++;
            }
        }

    }

    echo '
                </tbody>
              </table>
            </div>
          </div>
        </div>';

    ?>
</div>
<br>

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