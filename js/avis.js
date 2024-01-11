let currentQuestion = 0;
let reponse = 0;

var info = "avis";
var questions;
var requete = new XMLHttpRequest(); 
requete.open('GET', './api/api/read.php?info=' + info);
requete.onreadystatechange = function() {
    if (requete.readyState === 4) {
        if(requete.status === 200){
            questions = JSON.parse(requete.responseText);
            questions = questions["body"];
            const totalQuestions = questions.length;
        }
    }
};
requete.send();

function afficherQuestion() {
    document.getElementById('texte-question').innerText = questions[currentQuestion].question;
}

function mettreAJourNumeroQuestion() {
    document.getElementById('texte-question-info').innerText = `Question ${currentQuestion + 1}`;
}

function validerFormulaire() {
    const nom = document.getElementById('nom').value;
    const prenom = document.getElementById('prenom').value;
    const mail = document.getElementById('mail').value;

    if (nom && prenom && mail) {
        document.getElementById('formulaire-section').style.display = 'none';
        document.getElementById('questionnaire-section').style.display = 'block';

        afficherQuestion();
        afficherOptions();
        mettreAJourNumeroQuestion();
    } else {
        alert('Veuillez remplir tous les champs du formulaire.');
    }
}

function questionPrecedente() {
    if (currentQuestion > 0) {
        currentQuestion--;
        afficherQuestion();
        mettreAJourNumeroQuestion();
        desactiverOptions();
    }
}

function questionSuivante() {
    const totalQuestions = questions.length;
    const options = document.querySelectorAll('.option-button');
    const optionSelectionnee = [...options].some((btn) => btn.classList.contains('active'));

    const btnSuivant = document.getElementById('btn-suivant');
    envoi();

    if (optionSelectionnee) {
        if (currentQuestion < totalQuestions - 1) {
            currentQuestion++;
            afficherQuestion();
            mettreAJourNumeroQuestion();
            desactiverOptions();
            btnSuivant.classList.remove('disabled');
        } else {
            
            window.location.href = 'traitement_avis.html';
        }
    } else {
        btnSuivant.classList.add('disabled');
        console.log('Veuillez sélectionner une option.');
    }
}

function afficherOptions() {
    const conteneurOptions = document.getElementById('conteneur-options');
    const btnSuivant = document.getElementById('btn-suivant');

    const options = ['Très Bien', 'Bien', 'Moyen', 'Mauvais'];

    options.forEach((option, index) => {
        const btn = document.createElement('button');
        btn.textContent = option;
        btn.onclick = () => selectionnerOption(index);
        btn.classList.add('option-button'); 
        conteneurOptions.appendChild(btn);
    });

    btnSuivant.classList.add('disabled');
}

document.addEventListener('DOMContentLoaded', function () {
    const conteneurOptions = document.getElementById('conteneur-options');
    const btnSuivant = document.getElementById('btn-suivant');

    conteneurOptions.addEventListener('click', function (event) {
        if (event.target.classList.contains('option-button')) {
            conteneurOptions.querySelectorAll('.option-button').forEach((btn) => {
                btn.classList.remove('active');
            });

            event.target.classList.add('active');
            btnSuivant.classList.add('active'); 
        }
    });
});

function selectionnerOption(index) {
    const conteneurOptions = document.getElementById('conteneur-options');
    const options = conteneurOptions.querySelectorAll('.option-button');

    options.forEach((btn, i) => {
        if (i === index) {
            btn.classList.add('active');
            reponse = index;
        } else {
            btn.classList.remove('active');
        }
    });
}

function desactiverOptions() {
    const options = document.querySelectorAll('.option-button');
    options.forEach((btn) => {
        btn.classList.remove('active');
    });

    const btnSuivant = document.getElementById('btn-suivant');
    btnSuivant.classList.add('disabled');
}

function transformerNote(note) {
    switch (note) {
        case 0:
            return "Très bien";
        case 1:
            return "Bien";
        case 2:
            return "Moyen";
        case 3:
            return "Mauvais";
    }
}

function envoi() {
    var email = document.getElementById("mail").value;
    var id_question = currentQuestion+1;
    var reponses = transformerNote(reponse);

    var data = {
        "email": email,
        "id_question": id_question,
        "reponse": reponses
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