<?php
if (!isset($_GET["assignatura"])) {
    header("Location:/../index.php");
}
?>
<h3 class="text-center text-white pt-5">Formulari crear problema</h3>
<br>


<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>Formulari crear problema</strong></h2>
                <p>Crea el problema i no t'olvidis d'afegir arxius!</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" action="/Controller/problemNew.php" method="post"
                              onsubmit="return validarProblema();" enctype="multipart/form-data">

                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Detalls</h2>
                                    <input type="text" name="title" id="titol" placeholder="Títol del problema"/>
                                    <textarea type="text" name="descripcio" id="descripcio"
                                              placeholder="Descripció del problema" rows="3"></textarea>
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
                                        <label for="exampleFormControlSelect2">Visio</label>
                                        <select class="form-control" name="visio" id="exampleFormControlSelect2">
                                            <option>Public</option>
                                            <option>Privat</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="llenguatgeProgramacio">Llenguatge de programació</label>
                                        <select class="form-control" name="programacio" id="llenguatgeProgramacio">
                                            <option>C++</option>
                                            <option>Python</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="assignatura"
                                               value="<?php echo $_GET["assignatura"] ?>"/>
                                    </div>

                                    <div class="custom-file">
                                        <input type="file" name="file[]" class="custom-file-input" id="customFile"
                                               multiple>
                                        <label class="custom-file-label" for="customFile">Selecciona arxius</label>
                                    </div>

                                </div>
                                <input type="submit" name="next" class="next action-button" value="Crear"/>
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