<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>Crea una nova Assignatura</strong></h2>
                <p>Crea una nova asignautra i comença a pujar nous problemes</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" action="/Controlador/nuevaAsignatura.php"  method="post" onsubmit="return validarAsignatura();">

                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Detalls</h2> 
                                    <input type="text" name="titol" id="titol" placeholder="Títol de l'assignatura" />
                                     <input type="text" name="descripcio" id="descripcio" placeholder="Descripció de l'assignatura" /> 
                                     <input type="text" name="curs" id="curs" placeholder="Curs on es realitzaran" /> 
                                </div> 
                                <input type="submit" name="next" class="next action-button" value="Crear" />
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
      <button type="button" class="close" data-dismiss="alert">&times;</button></p>
</div>