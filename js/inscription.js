function envoi() {
    var nom = document.getElementById("nom").value;
    var prenom = document.getElementById("prenom").value;
    var nv_etudes = document.getElementById("niveau_etudes").value;
    var telephone = document.getElementById("telephone").value;
    var email = document.getElementById("email").value;
    var transport = document.getElementById("transport").value;
    var distance = document.getElementById("distance").value;
    var type_bac = document.getElementById("type_bac").value;

    var data = {
        "nom": nom,
        "prenom": prenom,
        "nv_etudes": nv_etudes,
        "telephone": telephone,
        "email": email,
        "transport": transport,
        "distance": distance,
        "type_bac": type_bac
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
    window.location.href = 'confirmation_inscription.html'; 
}

function toggleMenu() {
    const navLinks = document.querySelector('.nav-links');
    navLinks.classList.toggle('show');

}