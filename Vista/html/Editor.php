
<script type="text/javascript" language="JavaScript">
    var myVariable = <?php echo(json_encode($pegar)); //Sera $pegar la variable de la carpeta del alumno ?>;
    openFolder(myVariable);

</script>
<button onclick="myStopFunction()" class="w3-bar-item w3-button w3-large">Finalziar recursion &times;</button>
<?php if ($_SESSION['tipo']==0) {?>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Inicio Sidebar Professor -->
    <div class="w3-sidebar w3-bar-block w3-card w3-animate-right mt-5" style="display:none;right:0;" id="rightMenu">
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
            console.log("PRUEBA BETA");
        return "Estas editant un estudiant";
        //if we return nothing here (just calling return;) then there will be no pop-up question at all
        //return;
        };
    </script>

    <?php }
    ?>
    </div>
    <!-- Final Sidebar Professor -->


<?php }?>
<br>



    <div class="container bg-secondary">
    <p class="text-center font-weight-bold"><?php echo $data["Title"];?></p>
    <p class="font-weight-normal"><?php echo htmlspecialchars($data["Descripcio"]);?></p>

    <button onclick="newFile();">New file </button>
    <img id="save" onclick="save()" src="/Vista/imagenes/save.svg"/>
    <div id="files"></div>
    
    <pre id="editor">

    </pre>

<br>

    <div class="button-container">
        <button class="btn btn-primary" onclick="executeCode()"> Executa </button>
    </div>

    <div class="output bg-light"></div>
    <br>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="Vista/js/lib/ace.js"></script>
    <script src="Vista/js/lib/theme-monokai.js"></script>
    <script src="Vista/js/ide.js"></script>
    
    <script type="text/javascript" language="JavaScript">
        var lenguaje = <?php echo(json_encode($data["Llenguatge"])); //Sera $pegar la variable de la carpeta del alumno ?>;
        setLanguage(lenguaje);
    </script>

    <?php 
    if (isset($_GET["reiteratiu"])) {
        if ($_GET["reiteratiu"]==1) {?>

    <script>
        editor.setReadOnly(true);
        var myVar = setInterval(openFiler, 1000);

        

    </script>
    <?php }}?>
    
    <br>

    

    