function validateProblem() {
    let title_element = document.getElementById("title");
    // Initial value set to the title to avoid the validation error when edition the problem
    let title = "Test value";
    if (title_element) {
        title = title_element.value;
    }
    let description = document.getElementById("description").value;
    let error = document.getElementById("error_msg");

    if (title === "" || description === "") {
        error.toggleAttribute('hidden');
        error.innerHTML = "Hi ha camps buits";
        return false;
    } else if (title.length < 3 || title.length > 80) {
        error.toggleAttribute('hidden');
        error.innerHTML = "Títol massa curt";
        return false;
    } else if (description.length < 3) {
        error.toggleAttribute('hidden');
        error.innerHTML = "Descripció massa curta";
        return false;
    }
    return true;
}

function validateProblemAndFiles() {
    if (!validateProblem()) {
        return false;
    }

    let error = document.getElementById("error_msg");
    let customFile = document.getElementById("customFile");
    let fileLength = customFile.files.length;
    if (fileLength === 0) {
        error.toggleAttribute('hidden');
        error.innerHTML = "Selecciona els arxius del problema";
        return false;
    }

    // Check if all the files extensions ar allowed
    let allowedExtensionsRegx = /(\.cpp|\.h|\.py|\.python|\.txt|\.ipynb)$/i;
    for (let i = 0; i < customFile.files.length; i++) {
        let fileName = customFile.files[i].name;
        let fileExt = fileName.substr(fileName.lastIndexOf('.'));

        if (!allowedExtensionsRegx.test(fileExt)) {
            error.toggleAttribute('hidden');
            error.innerHTML = "La extensió del fitxer " + fileName + " és incorrecte.";
            return false;
        }
    }
    return true;
}
