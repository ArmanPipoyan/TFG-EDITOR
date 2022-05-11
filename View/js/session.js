let toCloneSession;

$(document).ready(function () {
    $("#msform").on('submit', function () {
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

        this.next.disabled = true;
        return true;
    });

    $('#duplicate_session_modal').on('show.bs.modal', function (e) {
        let invoker = $(e.relatedTarget);
        toCloneSession = parseInt(invoker.closest('.card').attr('id'));
    });
})

function deleteSession(sessionId) {
    $.ajax({
        url: "/Controller/sessionDelete.php",
        method: "POST",
        data: {
            session_id: sessionId,
        },
        success: function () {
            location.reload();
        },
        fail: function (response) {
            console.log(response);
        }
    })
}

function duplicateSession(session_id) {
    let session_name = document.getElementById("new_session_name").value;
    if (session_name !== "") {
        $.ajax({
            url: "/Controller/sessionDuplicate.php",
            method: "POST",
            data: {
                session_name: session_name,
                session_id: toCloneSession,
            },
            success: function () {
                location.reload();
            },
        })
    }
}
