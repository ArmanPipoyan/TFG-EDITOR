let editor;
let currentDocumentPath = "";
let programmingLanguage;
let folderRoute;
let checkChangesInterval;
let readOnly = false;
let toDeleteFileRoute;
let editing = 0;
let problemId;
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
    problemId = urlParams.get('problem');

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
    folderRoute = document.getElementById("folder_route").innerText;
    openFolder(folderRoute);

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
    // User type 1 is student and 0 professor
    if (userType === "1") {
        setInterval(checkChanges, 3000);
    } else if (userType === "0") {
        let viewMode = document.getElementById("view_mode");
        // View mode 1 is edit mode and 2 read only
        if (viewMode) {
            let viewModeValue = viewMode.innerText;
            if (viewModeValue === "1") {
                setInterval(save, 4000);
            } else if (viewModeValue === "2") {
                editor.setReadOnly(true);
            }
        }
    }

    // Set the programming language
    let language = document.getElementById("programming_language").innerText;
    if (language === 'C++') {
        programmingLanguage = "cpp";
        editor.session.setMode("ace/mode/c_cpp");
    } else if (language === 'Python') {
        programmingLanguage = "python";
        editor.session.setMode("ace/mode/python");
    }

    // Set the right menu onclick event
    let rightMenu = document.getElementById("menu-button");
    if (rightMenu) {
        rightMenu.addEventListener("click", openCloseStudentMenu);
    }

    // Customize the form modal depending on the button opening it
    $("#github-form-modal").on('shown.bs.modal', function (event) {
        let title, submitText, action;
        if (event.relatedTarget.id === 'github-upload') {
            title = "Pujar a GitHub";
            submitText = "Pujar";
        } else {
            title = "Afegir fitxers desde GitHub";
            submitText = "Afegir";
        }
        $('#github-from-modal-title').text(title);
        $('#github-form-submit-input').attr('value', submitText);
    });
    // Add additional fields to the upload files to GitHub form
    $("#github-form").submit( function(eventObj) {
        save();
        $("<input />").attr("type", "hidden")
            .attr("name", "solution_path")
            .attr("value", folderRoute)
            .appendTo(this);
        $("<input />").attr("type", "hidden")
            .attr("name", "problem_id")
            .attr("value", problemId)
            .appendTo(this);
        let uploadFiles = $('#github-form-submit-input').attr('value') === "Pujar";
        $("<input />").attr("type", "hidden")
            .attr("name", "upload_files")
            .attr("value", uploadFiles)
            .appendTo(this);
        return true;
    });
}

function setSolutionEditingFalse() {
    // Set the solution's editing field as false before leaving the page
    $.ajax({
        url: "/Model/solutionSetEditingFalse.php",
        method: "POST",
        data: {
            folder: folderRoute,
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
    if (currentDocumentPath !== "") {
        openFile(currentDocumentPath);
    }
}

function checkChanges() {
    $.ajax({
        url: "/Model/checkStudent.php",
        method: "POST",
        data: {
            route: folderRoute,
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
    let currentDocumentName = currentDocumentPath.split('/').pop();
    if (currentDocumentName === "") {
        $("#output").text("Selecciona el fitxer per executar");
        return false;
    }
    $.ajax({
        url: "/app/compiler.php",
        method: "POST",
        data: {
            language: programmingLanguage,
            code: editor.getSession().getValue(),
            route: folderRoute,
            file_to_execute: currentDocumentName
        },
        success: function (response) {
            answer.innerHTML = response;
        }
    })
}

function openFile(fileName) {
    if (fileName !== "" && fileName !== currentDocumentPath) {
        // Set the previous file as not selected, the first time it will be ""
        if (currentDocumentPath !== "") {
            save();
            document.getElementById(currentDocumentPath).style.color = 'black';
            document.getElementById(currentDocumentPath).style.fontWeight = 'normal';
        }
        currentDocumentPath = fileName;
        // Set the new file as selected
        document.getElementById(currentDocumentPath).style.color = 'grey';
        document.getElementById(currentDocumentPath).style.fontWeight = 'bold';

        let fileExtension = currentDocumentPath.split('.').pop();
        // If the file is a notebook embed an iframe, otherwise get the file content from the backend
        let notebookContainer = document.getElementById("notebook");
        let editorContainer = document.getElementById("editor");
        let outputContainer = document.getElementById("answer");
        if (fileExtension === 'ipynb') {
            // Remove the editor and the output views
            editorContainer.style.display = "none";
            outputContainer.style.display = "none";
            // Create a new iframe with the src of the file and append it to its container
            let iframe = document.createElement("iframe");
            let fileLocation = fileName.split("/").slice(-3).join("/");
            iframe.setAttribute("src", `http://localhost:8888/tree/${fileLocation}`);
            iframe.setAttribute("height", "500px");
            iframe.setAttribute("width", "100%");
            notebookContainer.appendChild(iframe);
        } else {
            // Clear the notebooks container
            if (notebookContainer.hasChildNodes()) {
                notebookContainer.removeChild(notebookContainer.lastElementChild);
                editorContainer.style.display = "block";
                outputContainer.style.display = "block";
            }
            if (fileExtension === "cpp") {
                editor.session.setMode("ace/mode/c_cpp");
            } else {
                editor.session.setMode("ace/mode/python");
            }
            post("getFileContent.php", {file: encodeURIComponent(fileName)}, function (data) {
                editor.setValue(data, -1);
            });
        }
    }
}

function openFolder() {
    post("dir.php", {folder: encodeURIComponent(folderRoute)}, function (data) {
        document.getElementById('files').innerHTML = data;

        // Open the first file of the folder's available files
        let container = document.querySelector('#files');
        let matches = container.querySelectorAll('ul > li');
        openFile(matches[0].id);
    });
}

function newFile(edited, problem) {
    let filename = prompt("Enter the file/folder name");
    if (filename) {
        post("newFile.php", {filename, dir: encodeURIComponent(folderRoute), edited, problem}, function (data) {
            if (data === true) {
                openFolder(folderRoute);
            }
        });
        location.reload();
    }
}

function save() {
    if (currentDocumentPath === undefined || currentDocumentPath.split('.').pop() === "ipynb") {
        return false;
    }
    $.ajax({
        url: "/Model/save.php",
        method: "POST",
        data: {
            file: currentDocumentPath,
            code: editor.getSession().getValue(),
            editing: editing,
            problem: problemId,
        },
        success: function (response) {
            if (response === 'true') {
                editor.getSession().getValue();
            }
        }
    })
}

function setFileToDelete(fileRoute) {
    toDeleteFileRoute = fileRoute;
}

function deleteFile() {
    $.ajax({
        url: "/Model/fileDelete.php",
        method: "POST",
        data: {
            id: toDeleteFileRoute,
        },
        success: function () {
            location.reload();
        }
    })
}

function receiveFile() {
    let control = document.getElementById('my_file')
    control.click();
    control.onchange = function (event) {
        let fileList = control.files;
        if (fileList.length === 0) {
            return false;
        }
        let fileLength = control.files.length;
        if (fileLength === 0) {
            alert("Selecciona els arxius del problema");
            return false;
        }
        for (let i = 0; i < control.files.length; i++) {
            let file = control.files[i];
            let FileName = file.name;
            let FileExt = FileName.substr(FileName.lastIndexOf('.'));
            let allowedExtensionsRegx = /(\.cpp|\.h|\.py|\.python|\.txt|\.ipynb)$/i;
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
