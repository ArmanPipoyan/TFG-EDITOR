<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="Vista/js/lib/ace.js"></script>
<script src="Vista/js/lib/theme-monokai.js"></script>
<script src="Vista/js/ide.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<script type="text/javascript" language="JavaScript">
    var myVariable = <?php echo(json_encode($pegar)); //Sera $pegar la variable de la carpeta del alumno ?>;
    openFolder(myVariable);
    //var myVar2 = setInterval(save, 1000);

</script>
    <!-- <button onclick="myStopFunction()" class="w3-bar-item w3-button w3-large">Finalziar recursion &times;</button>-->
<?php if ($_SESSION['tipo']==0) {?>
    
    <!-- Inicio Sidebar Professor 
    display:none; 
    en Style si quiero que empieze oculto-->
    <div class="w3-sidebar w3-bar-block w3-card w3-animate-right mt-5" style="right:0;" id="rightMenu">
    <button onclick="closeRightMenu()" class="w3-bar-item w3-button w3-large">Tancar &times;</button>
    <?php 
    foreach ($datas as $datt) {
        echo ' <a href="/index.php?query=7&problem='.$_GET["problem"].'&reiteratiu=1&usuario='.$datt["Usuario"].'" class="w3-bar-item w3-button">'.$datt["Usuario"].'</a>';
      }
    ?>


    </div>
    <div class="w3-teal">
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
        return "se va el professor";
        };
    </script>

    <?php }
    ?>
    </div>
    


<?php }?>
<!-- Final Sidebar Professor -->
<br>
    <div class="container">
        <p class="alert alert-warning hide" id="error_mssg"> <strong>El professor esta editant  </strong>
    </div>

    <div class="container">
        <p class="alert alert-danger hide" id="error_mssg2"> <strong>Les llibreries que s'estan utilitzant no estan soportades </strong>
        <button type="button" class="close" data-dismiss="alert">&times;</button></p>
    </div>

    <div class="container bg-secondary">
    <p class="text-center font-weight-bold"><?php echo $data["Title"];?></p>
    <p class="font-weight-normal"><?php echo htmlspecialchars($data["Descripcio"]);?></p>

    <button onclick="newFile();">New file </button>
    <img id="save" onclick="save()" src="/Vista/imagenes/save.svg"/>
    <div id="files"></div>
    <div id="editor" contenteditable="true" >Selecciona un fitxer per començar a treballar :)</div>

<br>

    <div class="button-container">
        <button class="btn btn-primary" onclick="executeCode()"> Executa </button>
    </div>

    <div class="output bg-light"></div>
    <br>
</div>

    
    <script type="text/javascript" language="JavaScript">
        var lenguaje = <?php echo(json_encode($data["Llenguatge"])); //Sera $pegar la variable de la carpeta del alumno ?>;
        setLanguage(lenguaje);
    </script>

    <?php  //Estudiante nunca podra estar en modo reiterativo por ende no se puede hacer asi
    if (isset($_GET["reiteratiu"])) {
        if ($_GET["reiteratiu"]==1) {
            if ($_SESSION['tipo']==0) {?>
            <script>
                //editor.setReadOnly(true);
                var myVar = setInterval(save, 4000);
            </script>
 <?php }
        }
    }?>

    <?php if ($_SESSION['tipo']==1) {?>
        <script>
                var myVar = setInterval(checkChanges, 3000);
            </script>
    <?php }?>
    <br>
    
    

    