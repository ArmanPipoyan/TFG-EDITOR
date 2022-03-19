function validateSubject() {
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
