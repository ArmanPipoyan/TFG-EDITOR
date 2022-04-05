function validateSession() {
    let name = document.getElementById("name").value;
    let subject = document.getElementById("subject").value;
    let problems = document.getElementById("problems");
    problems = $(problems).val();
    let error = document.getElementById("error_msg");

    if (name === "" || subject === "" || problems.length === 0) {
        error.classList.remove('hide');
        error.innerHTML = "Hi ha camps buits.";
        return false;
    }
    return true;
}

function deleteSession(session_id) {
    $.ajax({
        url: "/Controller/sessionDelete.php",
        method: "POST",
        data: {
            session_id: session_id,
        },
        success: function () {
            location.reload();
        }
    })
}