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

$(document).ready(function () {
    // Add event listener to the collapsible items
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

    $('#toggle-dark-mode').on('click',function () {
        document.body.classList.toggle("dark-theme");
    })

    $('.dropdown-menu').on('click', function (e) {
        e.stopPropagation();
    });
})
