var doc, ace;
var keys = {};
var llenguatge;
var actual_doc = "";
var second_doc = "";
var carpeta = "";
var myVar3, idToDelete;
var readOnly = false;
var rutaArchivoBorrar;
var ficheroSeleciconado = ""
var editing = 0;
var problem_id;
window.onload = function () {
    console.log("Hacemos load");
    if (ace === undefined) {
        return false;
    }
    editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/c_cpp");
    const queryString = window.location.search;
    console.log(queryString);
    const urlParams = new URLSearchParams(queryString);
    const product = urlParams.get('edit');
    console.log(product);
    problem_id = urlParams.get('problem');
    if (product == null) {
        editing = 0;
    } else {
        editing = 1;
    }
    window.addEventListener("keydown", function (event) {
        keys[event.code] = true;
        if ((event.ctrlKey || event.metaKey) && keys["KeyS"]) {
            event.preventDefault();
            save();
        }
    });
    editor.setOptions({
        enableBasicAutocompletion: true,
        enableSnippets: true,
        enableLiveAutocompletion: false
    });

    var container = document.querySelector('#files');
    var matches = container.querySelectorAll('ul > li');
    console.log(matches[0].id);

    openFile(matches[0].id);
}


function changeState() {
    $.ajax({
        url: "/Model/changeSolucion.php",
        method: "POST",
        data: {
            carpeta: carpeta,
        },
        success: function (response) {
            editor.setReadOnly(false);
        }
    })
}


function cambios() {
    console.log("ha cambiado el codigo se puede guardar");
}

function generateToken() {
    $.ajax({
        url: "/Model/tokenGenerator.php",
        success: function (response) {
            document.getElementById("myInput").value = "http://tfguab.ddns.net/index.php?query=3&token=" + response;
        }
    })
}

function copiado() {
    var copyTextarea = document.getElementById("myInput");
    copyTextarea.select(); //select the text area
    document.execCommand("copy"); //copy to clipboard
    $(".message").text("Link copiat!");
}

function checkChanges() {
    console.log("El doc es: " + carpeta);
    $.ajax({

        url: "/Model/checkStudent.php",
        method: "POST",
        data: {
            carpeta: carpeta,
        },
        success: function (response) {

            if (response == 1) {
                if (readOnly == false) {
                    readOnly = true;
                    document.getElementById("error_mssg").classList.remove('hide');
                    editor.setReadOnly(true);

                    myVar3 = setInterval(openFiler, 4000);

                }

            } else {
                editor.setReadOnly(false);
                myVar3 = clearInterval(myVar3);
                readOnly = false;
                document.getElementById("error_mssg").classList.add('hide');
            }
        }
    })
}

function post(url, data, callback) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            callback(this.responseText);
        }
    };
    xhr.open("POST", 'Model/' + url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if (typeof data === "object") {
        var newObj = "";
        for (var i in data) {
            newObj += i + '=' + data[i];
            if (Object.keys(data).indexOf(i) !== Object.keys(data).length - 1) {
                newObj += "&";
            }
        }
        data = newObj;

    }
    xhr.send(encodeURI(data));
}


function setLanguage(language) {
    editor = ace.edit("editor");
    if (language == 'C++') {
        llenguatge = "cpp";
        editor.session.setMode("ace/mode/c_cpp");
    } else if (language == 'Python') {
        llenguatge = "python";
        editor.session.setMode("ace/mode/python");
    }
}

function executeCode() {
    console.log(myVariable);
    console.log(actual_doc);
    let text = editor.getSession().getValue();
    respuesta = document.getElementById("respuesta");
    if (text.includes("import os") || text.includes("import sys")) {
        console.log("Pillado el problema");
        error = document.getElementById("error_mssg2");
        //error.innerHTML="<strong>Les llibreries que s'estan utilitzant no estan soportades </strong>";
        error.classList.remove('hide');
        return false;
    }
    if (actual_doc == "") {
        console.log("Entra al pete");
        $(".output").text("Selecciona el fitxer per executar");
        return false;
    }
    $.ajax({
        url: "/app/compiler.php",
        method: "POST",
        data: {
            language: llenguatge,
            code: editor.getSession().getValue(),
            route: myVariable,
            ejecutable: actual_doc
        },
        success: function (response) {
            respuesta.innerHTML = response;
        }
    })
}

function upload_github() {
    // Look if the code is still usable
    if (document.cookie.search("github_logged=yes") === -1) {
        // Set the cookie to expire in 10 minutes (like the github code)
        let currentDate = new Date();
        let expirationDate = new Date(currentDate.getTime() + 10 * 60000);
        document.cookie = 'github_logged=yes;expires=' + expirationDate.toUTCString() + ';path=/';
        location.href = "https://github.com/login/oauth/authorize?client_id=8f808ec545de8d67461f&scope=repo%20user"
    } else {
        $.ajax({
            url: "/Model/githubUpload.php",
            method: "POST",
            success: function (response) {
                console.log(response)
            }
        })
    }
}

function validarRegistro() {
    var nombre, apellido, correo, contraseña, error, contraseña2, reg, exRegPassword, exRegUser, re;
    exRegUser = /^(?=.*\d)(?=.*[a-z])[0-9a-z]{6,16}$/;
    exRegPassword = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
    re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    exRegPassword = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
    nombre = document.getElementById("first_name").value;
    apellido = document.getElementById("last_name").value;
    correo = document.getElementById("email").value;
    contraseña = document.getElementById("password").value;
    contraseña2 = document.getElementById("password_confirmation").value;
    error = document.getElementById("error_mssg");
    reg = /^[A-Z]+$/i;


    if (nombre == "" || apellido == "" || contraseña == "" || correo == "") {
        alert("Faltan campos por rellenar");
        error.classList.remove('hide');
        error.innerHTML = "Hay campos vacios revisalos ";
        return false;
    } else if (nombre.length > 30 || apellido.length > 30) {
        error.classList.remove('hide');
        error.innerHTML = "Nombre o apellidos incorrectos ";
        return false;
    } else if (correo.length > 100) {
        error.classList.remove('hide');
        error.innerHTML = "El correo es demasiado largo ";
        return false;
    } else if (contraseña.length < 8 || contraseña.length > 24 || contraseña2.length < 8 || contraseña2.length > 40) {
        error.classList.remove('hide');
        error.innerHTML = "La contraseña debe ser mayor de 8 caracteres ";
        return false;
    } else if (contraseña != contraseña2) {
        error.classList.remove('hide');
        error.innerHTML = "Las contraseñas no son iguales";
        return false;
    } else if (!reg.test(nombre)) {
        error.classList.remove('hide');
        error.innerHTML = "El nombre solo puede contener letras";
        return false;
    } else if (!reg.test(apellido)) {
        error.classList.remove('hide');
        error.innerHTML = "El apellido solo puede contener letras";
        return false;
    }
    if (error.innerText == "El correo ya existe") {
        error.classList.remove('hide');
        return false;
    }
}

function validarLogin() {
    var nombre, contraseña, error, exRegPassword;
    nombre = document.getElementById("email").value;
    contraseña = document.getElementById("password").value;
    error = document.getElementById("error_mssg");
    exRegPassword = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
    console.log(nombre);
    if (nombre == "" || contraseña == "") {
        alert("Faltan campos por rellenar");
        error.classList.remove('hide');
        error.innerHTML = "Hay campos vacios ";
        return false;
    } else if (nombre.length > 40) {
        //alert("El  nombre o apellido es muy largo");
        error.classList.remove('hide');
        error.innerHTML = "Email demasiado largo ";
        return false;
    } else if (contraseña.length < 8 || contraseña.length > 24) {
        alert("La contraseña no cumple con los requisitos");
        error.classList.remove('hide');
        error.innerHTML = "El tamaño de la contraseña debe tener entre 8 y 24 caracteres ";
        return false;
    }


}


function validarProblema() {
    var titulo, descripcion;
    titulo = document.getElementById("titol").value;
    descripcion = document.getElementById("descripcio").value;
    error = document.getElementById("error_mssg");
    if (titulo == "" || descripcion == "") {
        alert("Faltan campos por rellenar");
        error.classList.remove('hide');
        error.innerHTML = "Hay campos vacios ";
        return false;
    } else if (titulo.length < 3 || titulo.length > 80) {
        //alert("El  nombre o apellido es muy largo");
        error.classList.remove('hide');
        error.innerHTML = "Titulo demasiado corto";
        return false;
    } else if (descripcion.length < 3) {
        //alert("La Descripcion es demasiado corta");
        error.classList.remove('hide');
        error.innerHTML = "Descripcion demasiado corta";
        return false;
    }

    var control = document.getElementById("customFile");
    var filelength = control.files.length;
    if (filelength == 0) {
        alert("Selecciona els arxius del problema");
        error.classList.remove('hide');
        error.innerHTML = "Selecciona els arxius del problema";
        return false;
    }
    for (var i = 0; i < control.files.length; i++) {
        var file = control.files[i];
        var FileName = file.name;
        var FileExt = FileName.substr(FileName.lastIndexOf('.'));
        var allowedExtensionsRegx = /(\.cpp|\.h|\.py|\.python|\.txt)$/i;
        var isAllowed = allowedExtensionsRegx.test(FileExt);
        if (!isAllowed) {
            console.log(FileExt);
            error.classList.remove('hide');
            error.innerHTML = "lA EXTENSIO dels arxius " + FileExt + " es incorrecte";
            return false;
        }
    }

    console.log(titulo);
    console.log(descripcion);
    return true;
}

function validarProblemaEditado() {
    var titulo, descripcion;
    titulo = document.getElementById("titol").value;
    descripcion = document.getElementById("descripcio").value;
    error = document.getElementById("error_mssg");
    if (titulo == "" || descripcion == "") {
        alert("Faltan campos por rellenar");
        error.classList.remove('hide');
        error.innerHTML = "Hay campos vacios ";
        return false;
    } else if (titulo.length < 3 || titulo.length > 80) {
        error.classList.remove('hide');
        error.innerHTML = "Titulo demasiado corto";
        return false;
    } else if (descripcion.length < 3) {
        error.classList.remove('hide');
        error.innerHTML = "Descripcion demasiado corta";
        return false;
    }
    return true;
}

function openFile(file) {
    second_doc = file;
    if (second_doc != "") {
        post("archivo.php", {file: encodeURIComponent(file)}, function (data) {
            doc = file;
            if (ficheroSeleciconado == "") {
                ficheroSeleciconado = file;
            } else {
                document.getElementById(ficheroSeleciconado).style.color = 'black';
                document.getElementById(ficheroSeleciconado).style.fontWeight = 'normal';

                ficheroSeleciconado = file;
            }
            saved = data;
            valor = doc.split('.').pop();

            actual_doc = doc.split('/').pop();
            document.getElementById(doc).style.color = 'grey';
            document.getElementById(doc).style.fontWeight = 'bold';
            editor.setValue(data, -1);
            if (valor == "cpp") {
                editor.session.setMode("ace/mode/c_cpp"); //HACER SUBSTRING DEL FILE Y COGER EL DATO
            } else {
                editor.session.setMode("ace/mode/python"); //HACER SUBSTRING DEL FILE Y COGER EL DATO
            }

        });
    }
}

function openFiler() {
    if (second_doc != "") {
        openFile(second_doc);
    }
}

function myStopFunction() {
    clearInterval(myVar);
}

function openFolder(folder) {
    carpeta = folder;
    console.log("Carpeta a abrir");
    console.log(folder);
    post("dir.php", {folder: encodeURIComponent(folder)}, function (data) {
        dir = folder;
        document.getElementById('files').innerHTML = data;
    });
}

function newFile(edited, problema) {
    console.log("nevo archivo");
    var filename = prompt("Enter the file/folder name");
    if (edited == 1) {
        console.log("HAcemos cambios");
    } else {
        console.log("no hacemos cambios");
    }
    if (filename) {
        post("newFile.php", {filename, dir: encodeURIComponent(dir), edited, problema}, function (data) {
            if (data == true) {
                openFolder(dir);
            } else {
                console.log(data);
            }
            closeMenu();
        });
        location.reload();
    }
}

function save() {
    console.log("La variable editing es " + editing);
    if (doc === undefined) {
        return false;
    }
    $.ajax({
        url: "/Model/save.php",
        method: "POST",
        data: {
            file: doc,
            code: editor.getSession().getValue(),
            editing: editing,
            problem: problem_id,
        },
        success: function (response) {
            if (response === 'true') {
                saved = editor.getSession().getValue();
            }
        }
    })
}

function openRightMenu() {
    document.getElementById("rightMenu").style.display = "block";
}

function closeRightMenu() {
    document.getElementById("rightMenu").style.display = "none";
}

function changeVisibility(visibilidad, problema) {
    //console.log(visibilidad);
    var vis = visibilidad;
    var id = problema;
    console.log(problema);
    let cambio;
    if (visibilidad == "Public")
        cambio = "Privat";
    else
        cambio = "Public";
    console.log(cambio);

    $.ajax({
        url: "/Model/changeVisibility.php",
        method: "POST",
        data: {
            cosas: id,
            code: cambio,
        },
        success: function (response) {
            console.log("Borrado satisfactoriamente");
            location.reload();
        }
    })


}

function setPoblemToDelete(id) {
    idToDelete = id;
    console.log(idToDelete);
}

function deleteProblem() {
    console.log(idToDelete);

    $.ajax({
        url: "/Model/deleteProblem.php",
        method: "POST",
        data: {
            id: idToDelete,
        },

        success: function (response) {
            console.log("Borrado satisfactoriamente");
        }
    })
}

function validarAsignatura() {
    titol = document.getElementById("titol").value;
    descripcio = document.getElementById("descripcio").value;
    curs = document.getElementById("curs").value;
    error = document.getElementById("error_mssg");

    if (titol == "" || descripcio == "" || curs == "") {
        error.classList.remove('hide');
        error.innerHTML = "Hay campos vacios ";
        return false;
    }
    return true;
}


function setBorrarArchivo(rutaArchivo) {
    rutaArchivoBorrar = rutaArchivo;
    console.log(rutaArchivo);
}

function deleteArchivo() {
    console.log("Borramos el archivo");
    $.ajax({
        url: "/Model/fileDelete.php",
        method: "POST",
        data: {
            id: rutaArchivoBorrar,
        },
        success: function (response) {
            console.log("Borrado satisfactoriamente");
            location.reload();
        }
    })
}

/////////////////////////////////////////////////////////////////////

function downloadFolder(ruta) {
    console.log(ruta);

    $.ajax({
        url: "/Model/zipFolder.php",
        method: "POST",
        data: {
            id: ruta,
        },
        success: function (response) {
            console.log("Descargado satisfactoriamente");
        }
    })
}

function recibirFichero() {
    var control = document.getElementById('my_file')
    control.click();
    control.onchange = function (event) {
        var fileList = control.files;
        //TODO do something with fileList.
        if (fileList.length == 0) {
            return false;
        }
        console.log(fileList);
        var filelength = control.files.length;
        if (filelength == 0) {
            alert("Selecciona els arxius del problema");

            return false;
        }
        for (var i = 0; i < control.files.length; i++) {
            var file = control.files[i];
            var FileName = file.name;
            var FileExt = FileName.substr(FileName.lastIndexOf('.'));
            var extensiones = FileExt.toUpperCase();
            var allowedExtensionsRegx = /(\.cpp|\.h|\.py|\.python|\.txt)$/i;
            var isAllowed = allowedExtensionsRegx.test(FileExt);
            if (!isAllowed) {
                console.log(FileExt);
                console.log("Error en el fichero");
                return false;
            }
        }
        console.log("Aqui llamamos a la funcion ajax");
        console.log("El direcotrio a meter en el input es " + dir)
        this.form.submit();
    };
}

function acceptChanges(id) {
    console.log("aceptamos los cambios");
    console.log(id);
    $.ajax({
        url: "/Controller/acceptChanges.php",
        method: "POST",
        data: {
            id: id,
        },

        success: function (response) {
            console.log("Cambiado satisfactoriamente");
            location.reload();
        }
    })

}