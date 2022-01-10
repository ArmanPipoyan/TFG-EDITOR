<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="Vista/js/lib/ace.js"></script>
<script src="Vista/js/lib/theme-monokai.js"></script>
<script src="Vista/js/ide.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<?php if ($_SESSION['tipo']==0 && isset($_GET["edit"])) {?>
<script type="text/javascript" language="JavaScript">
    var myVariable = <?php echo json_encode($ruta); //Sera $pegar la variable de la carpeta del alumno ?>;
    openFolder(myVariable);
    //var myVar2 = setInterval(save, 1000);
</script>
<?php
// echo "Cambios enteros en problema"; 
} else { 
   // echo "Cambios en mi solucion";?>
    <script type="text/javascript" language="JavaScript">
    
    var myVariable = <?php echo json_encode($pegar); //Sera $pegar la variable de la carpeta del alumno ?>;
    openFolder(myVariable);
    //var myVar2 = setInterval(save, 1000);
</script>
    <?php } ?>
    
<?php if ($_SESSION['tipo']==0) {?>
    
    <!-- Inicio Sidebar Professor 
    display:none; 
    en Style si quiero que empieze oculto-->
    <div class="w3-sidebar w3-bar-block w3-card  w3-animate-right mt-5" style="right:0;width:12%;" id="rightMenu">
    <button onclick="closeRightMenu()" class="w3-bar-item w3-button w3-hover-black w3-large">Tancar &times;</button>
    <?php 



    echo '<ul class="list-group list-group-flush">';
    foreach ($datas as $datt) {
        
        echo '
                <li class="list-group-item d-flex justify-content-between align-items-center ">
                <a href="/index.php?query=7&problem='.$_GET["problem"].'&reiteratiu=1&usuario='.$datt["Usuario"].'" class="w3-bar-item  w3-button">'.$datt["Usuario"].'</a>
                <a href="/index.php?query=7&problem='.$_GET["problem"].'&reiteratiu=2&usuario='.$datt["Usuario"].'" class="btn btn-success btn-sm rounded-0" title="Veure" ><i class="fa fa-eye"></i></a>
                </li>';
       
      }
      echo '</ul>';
     
    ?>


    </div>
    <div class="w3-teal ">
    <button class="w3-button w3-teal w3-xlarge w3-right" onclick="openRightMenu()">Estudiants &#9776;</button>
    <?php if (isset($_GET["reiteratiu"])) {
        echo '<a class="w3-button w3-teal w3-xlarge w3-right" href="/index.php?query=7&problem='.$_GET["problem"].'">Tornar enrere</a>';
        ?>
    <script>
        // Warning before leaving the page (back button, or outgoinglink)
        window.onbeforeunload = function() {
            //console.log("PRUEBA BETA");
            changeState();
        //return "Estas editant un estudiant";
        //if we return nothing here (just calling return;) then there will be no pop-up question at all
        //return "se va el professor";
        };
    </script>

    <?php }
    ?>
    </div>
    


<?php }?>
<!-- Final Sidebar Professor -->



<br>
    <?php if ($sol["Edited"]==1) {?>
            <div class="container">
                <p class="alert alert-info " id="edition_mssg"> <strong> Vols obtenir els canvis del professor  </strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <button type="button" class="close"  data-toggle="modal" data-target="#my-modal3" >Si </button>
            </div>
            <?php }?>
    <?php if ($_SESSION['tipo']==0 && isset($_GET["edit"])) {
        echo '<div class="container">
        <p class="alert alert-warning " id="error_mssg"> <strong> Estas modificant el problema arrel  </strong>
            </div>';
    }?>
    <div class="container">
        <p class="alert alert-warning hide" id="error_mssg"> <strong>El professor esta editant  </strong>
    </div>

    <div class="container">
        <p class="alert alert-danger hide" id="error_mssg2"> <strong>Les llibreries que s'estan utilitzant no estan soportades </strong>
        <button type="button" class="close" data-dismiss="alert">&times;</button></p>
    </div>
    <div class="container bg-dark ">
    
    <p class="text-center text-white font-weight-bold"><?php echo $data["Title"];?></p>

    <button type="button" class="collapsible bg-dark"><i class="fas fa-expand"></i> Descripció </button>
    <div class="content bg-dark text-white">
        <p><?php echo htmlspecialchars($data["Descripcio"]);?></p>
    </div>
    <script>
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
            content.style.display = "none";
            } else {
            content.style.display = "block";
            }
        });
        }
    </script>   

    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#my-modal2" >New file  <i class="fas fa-file"></i></button>
    <img id="save" class="mr-0" onclick="save()" src="/Vista/imagenes/save.svg"/>
    <button class="btn btn-primary ml-5 btn-sm" onclick="executeCode()"> Executa  <i class="fa fa-play" aria-hidden="true"></i></button>
    
    <div id="files" class="mt-1"></div>
    <div id="editor" contenteditable="true" >Selecciona un fitxer per començar a treballar :)</div>

<br>

    

    <div class="output bg-light" id="respuesta"></div>
    <br>
</div>

    
    <script type="text/javascript" language="JavaScript">
        var lenguaje = <?php echo(json_encode($data["Llenguatge"])); //Sera $pegar la variable de la carpeta del alumno ?>;
        setLanguage(lenguaje);
    </script>

    <?php 
     //Estudiante nunca podra estar en modo reiterativo por ende no se puede hacer asi
    if (isset($_GET["reiteratiu"])) {
        if ($_GET["reiteratiu"]==1) {
            if ($_SESSION['tipo']==0) {?>
            <script>
                //editor.setReadOnly(true);
                var myVar = setInterval(save, 4000);
            </script>
 <?php }
        }elseif ($_GET["reiteratiu"]==2) { ?>
            <script>
                editor.setReadOnly(true);
            </script>
    <?php }
            }?>

    <?php 
    if ($_SESSION['tipo']==1) {?>
        <script>
                var myVar = setInterval(checkChanges, 3000);
            </script>
    <?php }?>
    <br>
    
    




    
    <!--  MODALS -->
    <div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <div class="modal-body p-0">
                    <div class="card border-0 p-sm-3 p-2 justify-content-center">
                        <div class="card-header pb-0 bg-white border-0 ">
                            <div class="row">
                                <div class="col ml-auto"><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>
                            </div>
                            <p class="font-weight-bold mb-2"> Estas segur d'esborrar aquest arxiu ?</p>
                            <p class="text-muted "> Si l'esborres no tindras opció a recuperar-lo i serà immediat.</p>
                        </div>
                        <div class="card-body px-sm-4 mb-2 pt-1 pb-0">
                            <div class="row justify-content-end no-gutters">
                                <div class="col-auto mr-1"><button type="button" class="btn btn-light text-muted" data-dismiss="modal">Cancelar</button></div>
                                <div class="col-auto"><button type="button" class="btn btn-danger px-4" onclick="deleteArchivo()" data-dismiss="modal">Eliminar</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="my-modal2" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <div class="modal-body p-0">
                    <div class="card border-0 p-sm-3 p-2 justify-content-center">
                        <div class="card-header pb-0 bg-white border-0 ">
                            <div class="row">
                                <div class="col ml-auto"><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>
                            </div>
                            <p class="font-weight-bold mb-2"> Crear una nova fulla</p>
                            <p class="text-muted "> Importar fulla des de l'ordinador o un full en blanc.</p>
                        </div>
                        <div class="card-body px-sm-4 mb-2 pt-1 pb-0">
                            <div class="row justify-content-end no-gutters">
                            <form action="/Controlador/addFileFromPC.php" method="post" enctype="multipart/form-data">
                                <div class="col-auto mr-1"><button type="submit" onclick="recibirFichero()" class="btn btn-light text-muted" data-dismiss="modal">Importar desde l'ordinador</button></div>
                                    <input type="file" name ="file[]" style="display:none;" id="my_file" multiple>
                                <div class="form-group">
                                    <input type="hidden" name="token" value="<?php echo $pegar;?>" />
			    			    </div>
                                <div class="form-group">
                                    <input type="hidden" name="problem" value="<?php echo $_GET['problem'];?>" />
			    			    </div>
                                <?php if ($_SESSION['tipo']==0 && isset($_GET["edit"])) {?>
                                <div class="form-group">
                                    <input type="hidden" name="edit" value="1" />
			    			    </div>
                                <div class="form-group">
                                    <input type="hidden" name="token" value="<?php echo $ruta;?>" />
			    			    </div>
                                <?php } ?>
                            </form>
                            <?php if ($_SESSION['tipo']==0 && isset($_GET["edit"])) {?>
                                <div class="col-auto"><button type="button" class="btn btn-danger px-4" onclick="newFile(1,<?php echo $_GET['problem'];?>)" data-dismiss="modal">Arxiu en blanc</button></div>
                            <?php }else{?>
                                <div class="col-auto"><button type="button" class="btn btn-danger px-4" onclick="newFile(0,<?php echo $_GET['problem'];?>)" data-dismiss="modal">Arxiu en blanc</button></div>
                            
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div id="my-modal3" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <div class="modal-body p-0">
                    <div class="card border-0 p-sm-3 p-2 justify-content-center">
                        <div class="card-header pb-0 bg-white border-0 ">
                            <div class="row">
                                <div class="col ml-auto"><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>
                            </div>
                            <p class="font-weight-bold mb-2"> Estas segur de sobreescriure les dades del professor?</p>
                            <p class="text-muted "> Si acceptes no tindras opció a recuperar-lo i serà immediat.</p>
                        </div>
                        <div class="card-body px-sm-4 mb-2 pt-1 pb-0">
                            <div class="row justify-content-end no-gutters">
                                <div class="col-auto mr-1"><button type="button" class="btn btn-light text-muted" data-dismiss="modal">Cancelar</button></div>
                                <div class="col-auto"><button type="button" class="btn btn-danger px-4" id=<?php echo $_GET['problem'];?> onclick="acceptChanges(<?php echo $_GET['problem'];?>)" data-dismiss="modal">Obtenir canvis</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>