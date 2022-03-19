function generateToken() {
    $.ajax({
        url: "/Model/tokenGenerator.php",
        success: function (response) {
            document.getElementById("invitation_link").value = "localhost/index.php?query=3&token=" + response;
        }
    })
}

function copyInvitationLink() {
    let invitationLink = document.getElementById("invitation_link").value;

    navigator.clipboard.writeText(invitationLink).then(
        $(".message").text("Link copiat!")
    );
}
