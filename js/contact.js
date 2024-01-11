function envoi() {
    var message = document.getElementById("message").value;
    var statut = document.getElementById("statut").value;
    var email = document.getElementById("email").value;


    var data = {
        "message": message,
        "email": email,
        "statut": statut,
    };

    var httpRequest = new XMLHttpRequest();
    httpRequest.open('POST', './api/api/create.php');
    httpRequest.setRequestHeader("Content-Type", "application/json");
    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState === 4) {
            if (httpRequest.status === 200) {
                console.log('Envoi réussi');
            } else {
                console.error("Erreur lors de l'envoi");
            }
        }
    };

    httpRequest.send(JSON.stringify(data));
}

function toggleMenu() {
    const navLinks = document.querySelector('.nav-links');
    navLinks.classList.toggle('show');

}