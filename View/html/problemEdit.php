<br>


<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>Formulari editar problema</strong></h2>
                <p>Recorda que a l'hora d'editar el problema els canvis es guardaran automaticament! </p>
                <p> No es podra editar el titol ja que forma part de les rutes de les solucions.</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" action="/Controller/problemUpdate.php" method="post"
                              onsubmit="return validarProblemaEditado();" enctype="multipart/form-data">

                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Detalls</h2>

                                    <label for="descripcio">Descripcio</label>
                                    <textarea type="text" name="descripcio" id="descripcio"
                                              placeholder="Descripció del problema"
                                              rows="3"><?php echo $prob["description"]; ?></textarea>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Temps execució en segons</label>
                                        <select class="form-control" name="time" id="exampleFormControlSelect1">
                                            <option>5</option>
                                            <option>10</option>
                                            <option>20</option>
                                            <option>60</option>
                                            <option>120</option>
                                            <option>Ilimitat</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect3">Memoria per utilitzar en Mb</label>
                                        <select class="form-control" name="memory" id="exampleFormControlSelect3">
                                            <option>50</option>
                                            <option>100</option>
                                            <option>200</option>
                                            <option>600</option>
                                            <option>1200</option>
                                            <option>Ilimitat</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="assignatura" value="<?php echo $_GET["problem"] ?>"/>
                                    </div>

                                </div>
                                <input type="submit" name="next" class="next action-button" value="Editar"/>
                            </fieldset>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <p class="alert alert-danger hide" id="error_mssg">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </p>
</div>