let empty_fields_validation = "Hi ha camps buits";
let password_validation = "La contasenya ha de tenir entre 8 i 24 caràcters";

function validateLogin() {
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let error = document.getElementById("error_msg");

    if (email === "" || password === "") {
        error.toggleAttribute('hidden');
        error.innerHTML = empty_fields_validation;
        return false;
    } else if (email.length > 40) {
        error.toggleAttribute('hidden');
        error.innerHTML = "L'mail és massa llarg";
        return false;
    } else if (password.length < 8 || password.length > 24) {
        error.toggleAttribute('hidden');
        error.innerHTML = password_validation;
        return false;
    }
}

function validateRegister() {
    let name = document.getElementById("first_name").value;
    let surname = document.getElementById("last_name").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("email").value;
    let password2 = document.getElementById("email_confirmation").value;
    let error = document.getElementById("error_msg");
    let onlyLettersRegex = /^[A-Z]+$/i;

    if (name === "" || surname === "" || password === "" || email === "") {
        error.toggleAttribute('hidden');
        error.innerHTML = empty_fields_validation;
        return false;
    } else if (name.length > 30 || surname.length > 30) {
        error.toggleAttribute('hidden');
        error.innerHTML = "Nom o cognoms incorrectes";
        return false;
    } else if (email.length > 100) {
        error.toggleAttribute('hidden');
        error.innerHTML = "L'email és massa llarg";
        return false;
    } else if (password.length < 8 || password.length > 24 || password2.length < 8 || password2.length > 24) {
        error.toggleAttribute('hidden');
        error.innerHTML = password_validation;
        return false;
    } else if (password !== password2) {
        error.toggleAttribute('hidden');
        error.innerHTML = "Las contrasenyes no coincideixen";
        return false;
    } else if (!onlyLettersRegex.test(name)) {
        error.toggleAttribute('hidden');
        error.innerHTML = "El nom només pot contenir lletres";
        return false;
    } else if (!onlyLettersRegex.test(surname)) {
        error.toggleAttribute('hidden');
        error.innerHTML = "Els cognoms només poden contenir lletres";
        return false;
    }
}
