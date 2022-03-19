let editor;
let current_document_path = "";
let current_document_name = "";
let programming_language;
let folder_route;
let checkChangesInterval;
let readOnly = false;
let rutaArchivoBorrar;
let editing = 0;
let problem_id;
let studentMenuClosed = true;
let userType;

window.onload = function () {
    if (ace === undefined) {
        return false;
    }
    // Customize the editor theme
    editor = ace.edit("editor", {
        enableBasicAutocompletion: true,
        enableSnippets: true,
        enableLiveAutocompletion: false
    });
    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/c_cpp");

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    problem_id = urlParams.get('problem');

    const editInGet = urlParams.get('edit');
    if (editInGet !== null) {
        editing = 1;
    }

    let keys = {};
    window.addEventListener("keydown", function (event) {
        keys[event.code] = true;
        if ((event.ctrlKey || event.metaKey) && keys["KeyS"]) {
            event.preventDefault();
            save();
        }
    });

    // Load the files from the disk
    folder_route = document.getElementById("folder_route").innerText;
    openFolder(folder_route);

    // Add event listener to the description collapsible
    let collapsible = document.getElementsByClassName("collapsible");
    for (let i = 0; i < collapsible.length; i++) {
        collapsible[i].addEventListener("click", function () {
            this.classList.toggle("active");
            let content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }

    // Set the auto check options depending on the user and his actions
    userType = document.getElementById("user_type").innerText;
    if (userType === "1") {
        setInterval(checkChanges, 3000);
    } else if (userType === "0") {
        let viewMode = document.getElementById("view_mode");
        if (viewMode) {
            let viewModeText = viewMode.innerText;
            if (viewModeText === "1") {
                setInterval(save, 4000);
            } else if (viewModeText === "2") {
                editor.setReadOnly(true);
            }
        }
    }

    // Set the programming language
    let language = document.getElementById("programming_language").innerText;
    if (language === 'C++') {
        programming_language = "cpp";
        editor.session.setMode("ace/mode/c_cpp");
    } else if (language === 'Python') {
        programming_language = "python";
        editor.session.setMode("ace/mode/python");
    }

    // Set the right menu onclick event
    let rightMenu = document.getElementById("menu-button");
    if (rightMenu) {
        rightMenu.addEventListener("click", openCloseStudentMenu);
    }
}

function setSolutionEditingFalse() {
    // Set the solution's editing field as false before leaving the page
    $.ajax({
        url: "/Model/solutionSetEditingFalse.php",
        method: "POST",
        data: {
            folder: folder_route,
            user_type: userType
        }
    })
}

$(window).on('beforeunload', function () {
    //this will work only for Chrome
    setSolutionEditingFalse();
});

$(window).on("unload", function () {
    //this will work for other browsers
    setSolutionEditingFalse();
});

function post(url, data, callback) {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            callback(this.responseText);
        }
    };
    xhr.open("POST", 'Model/' + url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if (typeof data === "object") {
        let newObj = "";
        for (let i in data) {
            newObj += i + '=' + data[i];
            if (Object.keys(data).indexOf(i) !== Object.keys(data).length - 1) {
                newObj += "&";
            }
        }
        data = newObj;
    }
    xhr.send(encodeURI(data));
}

function openCloseStudentMenu() {
    let displayValue = 'block';
    if (!studentMenuClosed) {
        displayValue = 'none';
    }
    document.getElementById("student-menu").style.setProperty('display', displayValue);
    studentMenuClosed = !studentMenuClosed;
}

function openFiler() {
    if (current_document_path !== "") {
        openFile(current_document_path);
    }
}

function checkChanges() {
    $.ajax({
        url: "/Model/checkStudent.php",
        method: "POST",
        data: {
            route: folder_route,
        },
        success: function (response) {
            // Check if the professor is editing the solution
            if (response === "1") {
                if (readOnly === false) {
                    readOnly = true;
                    checkChangesInterval = setInterval(openFiler, 4000);
                    document.getElementById("root_modified").classList.remove('hide');
                }
            } else {
                readOnly = false;
                clearInterval(checkChangesInterval);
                document.getElementById("root_modified").classList.add('hide');
            }
            editor.setReadOnly(readOnly);
        }
    })
}

function executeCode() {
    let text = editor.getSession().getValue();
    let answer = document.getElementById("answer");
    if (text.includes("import os") || text.includes("import sys")) {
        document.getElementById("error_msg_libraries").classList.remove('hide');
        return false;
    }
    if (current_document_name === "") {
        $(".output").text("Selecciona el fitxer per executar");
        return false;
    }
    $.ajax({
        url: "/app/compiler.php",
        method: "POST",
        data: {
            language: programming_language,
            code: editor.getSession().getValue(),
            route: folder_route,
            file_to_execute: current_document_name
        },
        success: function (response) {
            answer.innerHTML = response;
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
        location.href = "https://github.com/login/oauth/authorize?client_id=8f808ec545de8d67461f&scope=repo%20user";
    } else {
        $.ajax({
            url: "/Model/githubUpload.php",
            method: "POST",
        })
    }
}

function openFile(fileName) {
    if (fileName !== "" && fileName !== current_document_path) {
        post("getFileContent.php", {file: encodeURIComponent(fileName)}, function (data) {
            // Set the previous file as not selected, the first time it will be ""
            if (current_document_path !== "") {
                document.getElementById(current_document_path).style.color = 'black';
                document.getElementById(current_document_path).style.fontWeight = 'normal';
            }
            current_document_path = fileName;
            // Set the new file as selected
            document.getElementById(current_document_path).style.color = 'grey';
            document.getElementById(current_document_path).style.fontWeight = 'bold';
            current_document_name = current_document_path.split('/').pop();

            let fileExtension = current_document_path.split('.').pop();
            editor.setValue(data, -1);
            if (fileExtension === "cpp") {
                editor.session.setMode("ace/mode/c_cpp");
            } else {
                editor.session.setMode("ace/mode/python");
            }
        });
    }
}

function openFolder() {
    post("dir.php", {folder: encodeURIComponent(folder_route)}, function (data) {
        document.getElementById('files').innerHTML = data;

        // Open the first file of the folder's available files
        let container = document.querySelector('#files');
        let matches = container.querySelectorAll('ul > li');
        openFile(matches[0].id);
    });
}

function newFile(edited, problema) {
    let filename = prompt("Enter the file/folder name");
    if (filename) {
        post("newFile.php", {filename, dir: encodeURIComponent(folder_route), edited, problema}, function (data) {
            if (data === true) {
                openFolder(folder_route);
            }
        });
        location.reload();
    }
}

function save() {
    if (current_document_path === undefined) {
        return false;
    }
    $.ajax({
        url: "/Model/save.php",
        method: "POST",
        data: {
            file: current_document_path,
            code: editor.getSession().getValue(),
            editing: editing,
            problem: problem_id,
        },
        success: function (response) {
            if (response === 'true') {
                editor.getSession().getValue();
            }
        }
    })
}

function setBorrarArchivo(rutaArchivo) {
    rutaArchivoBorrar = rutaArchivo;
}

function deleteArchivo() {
    $.ajax({
        url: "/Model/fileDelete.php",
        method: "POST",
        data: {
            id: rutaArchivoBorrar,
        },
        success: function (response) {
            location.reload();
        }
    })
}

function recibirFichero() {
    let control = document.getElementById('my_file')
    control.click();
    control.onchange = function (event) {
        let fileList = control.files;
        if (fileList.length === 0) {
            return false;
        }
        let filelength = control.files.length;
        if (filelength === 0) {
            alert("Selecciona els arxius del problema");
            return false;
        }
        for (let i = 0; i < control.files.length; i++) {
            let file = control.files[i];
            let FileName = file.name;
            let FileExt = FileName.substr(FileName.lastIndexOf('.'));
            let allowedExtensionsRegx = /(\.cpp|\.h|\.py|\.python|\.txt)$/i;
            let isAllowed = allowedExtensionsRegx.test(FileExt);
            if (!isAllowed) {
                return false;
            }
        }
        this.form.submit();
    };
}

function acceptChanges(id) {
    $.ajax({
        url: "/Controller/acceptChanges.php",
        method: "POST",
        data: {
            id: id,
        },
        success: function () {
            location.reload();
        }
    })
}