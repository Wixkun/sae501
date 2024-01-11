var data;
var info = "admin";
var requete = new XMLHttpRequest(); 
requete.open('GET', './api/api/read.php?info=' + info);
requete.onreadystatechange = function() {
if (requete.readyState === 4) {
    if(requete.status === 200){
        data = JSON.parse(requete.responseText);
        data = data["body"];
    }
}
};
requete.send();

var formulaire = document.getElementById("bloque");

function connexion() {

    var email = document.getElementById("email").value;
    var mdp = document.getElementById("mdp").value;

    for (let i = 0; i < data.length; i++) {
        if (data[i]["email"] === email) {
            if (data[i]["mdp"] != "") {
                if (data[i]["mdp"] === mdp) {
                    localStorage.setItem('admin', 1);
                    window.location.href = 'admin.html'; 
                    return;
                  } else {
                        formulaire.innerHTML = "Mauvais mot de passe";
                        return;
                  }
              } else {
                    formulaire.innerHTML = "Accès refusé";
                    return;
              }
        } else {
            formulaire.innerHTML = "Mauvais email";
        }
      }
}