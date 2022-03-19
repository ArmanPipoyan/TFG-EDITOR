let idToDelete;

function setProblemToDelete(id) {
    idToDelete = id;
}

function deleteProblem() {
    $.ajax({
        url: "/Model/problemDelete.php",
        method: "POST",
        data: {
            id: idToDelete,
        },
        success: function () {
            location.reload();
        }
    })
}

function changeVisibility(visibility, problem_id) {
    let new_visibility;
    if (visibility === "Public") {
        new_visibility = "Privat";
    } else {
        new_visibility = "Public";
    }

    $.ajax({
        url: "/Model/changeVisibility.php",
        method: "POST",
        data: {
            problem_id: problem_id,
            new_visibility: new_visibility,
        },
        success: function () {
            location.reload();
        }
    })
}
