
<div class="container bg-secondary text-white">
    
    <form class="form mt-3 mb-4 " action="/Controlador/newProblem.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
        <br>
            <label for="exampleFormControlInput1">Titulo</label>
            <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Problema1">
        </div>
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
            <label for="exampleFormControlTextarea1">Descripció problema</label>
            <textarea class="form-control" name="descripcio" id="exampleFormControlTextarea1" placeholder="Descripcio detallada del problema" rows="3"></textarea>
        </div>
        <div class="custom-file">
            <input type="file" name ="file[]" class="custom-file-input" id="customFile" multiple>
            <label class="custom-file-label" for="customFile">Selecciona arxius</label>
        </div>
        <div class="form-group">
            <br>
                <input type="submit" name="submit" class="btn btn-info btn-md" value="Crear Problema">
                
            </div>
            <br>

    </form>
</div>