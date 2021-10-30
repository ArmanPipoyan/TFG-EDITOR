
<script type="text/javascript" language="JavaScript">
    var myVariable = <?php echo(json_encode($data["Ruta"])); ?>;
    openFolder(myVariable);
    </script>
<br>

    <div class="container bg-secondary">
    <p class="text-center font-weight-bold"><?php echo $data["Title"];?></p>
    <p class="font-weight-normal"><?php echo htmlspecialchars($data["Descripcio"]);?></p>
    <div class="control-panel">
        Selecciona llenguatge de programació
        &nbsp; &nbsp;
        <select id="languages" class="languages" onchange="changeLanguage()">
            <option value="cpp"> C++ </option>
            <option value="python"> Python </option>

        </select>
    </div>
    <button onclick="newFile();">New file </button>
    <div id="files"></div>
    
    <pre id="editor">
    
    </pre>

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