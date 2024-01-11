var selectQuestion = document.getElementById('selectQuestion');
var count = 0;
var all=0;

var data;
var info = "admin";
var requete = new XMLHttpRequest(); 
requete.open('GET', './api/api/read.php?info=' + info);
requete.onreadystatechange = function() {
if (requete.readyState === 4) {
    if(requete.status === 200){
        data = JSON.parse(requete.responseText);
        data = data["body"];
        all = data.length;
        for (let i = 0; i < data.length; i++) {
            if (data[i]["presence_jpo"] === 1) {
              count += 1;
            }
          }
    }
}
};
requete.send();

var questions;
var info2 = "avis";
var requete2 = new XMLHttpRequest(); 
requete2.open('GET', './api/api/read.php?info=' + info2);
requete2.onreadystatechange = function() {
if (requete2.readyState === 4) {
    if(requete2.status === 200){
        questions = JSON.parse(requete2.responseText);
        questions = questions["body"];
        for (let i = 0; i < questions.length; i++) {
            selectQuestion.innerHTML += "<option>" + questions[i]["question"] + "</option>"
        } 
    }
}
};
requete2.send();

var reponses;
var info3 = "reponses";
var requete3 = new XMLHttpRequest(); 
requete3.open('GET', './api/api/read.php?info=' + info3);
requete3.onreadystatechange = function() {
if (requete3.readyState === 4) {
    if(requete3.status === 200){
        reponses = JSON.parse(requete3.responseText);
        reponses = reponses["body"];
    }
}
};



requete3.send();

function tableau2() {
    const tbody = document.querySelector('#infoTable tbody');

    for (let i = 0; i < data.length; i++) {
        if (data[i]["presence_jpo"] === 0) {
            data[i]["presence_jpo"] = "Non";
        } else if (data[i]["presence_jpo"] === 1) {
            data[i]["presence_jpo"] = "Oui";
        }
    }

    data.forEach(function (person) {
        const row = tbody.insertRow();
        row.insertCell().textContent = person.nom;
        row.insertCell().textContent = person.prenom;
        row.insertCell().textContent = person.email;
        row.insertCell().textContent = person.nv_etudes;
        row.insertCell().textContent = person.transport;
        row.insertCell().textContent = person.distance;
        row.insertCell().textContent = person.type_bac;
        row.insertCell().textContent = person.presence_jpo;

        const operationsCell = row.insertCell();

        const modifierButton = document.createElement('button');
        modifierButton.textContent = 'Modifier';
        modifierButton.classList.add('btn-modifier', 'btn-operation'); 
        modifierButton.addEventListener('click', function () {
            modifierUtilisateur(person.id);
        });
        
        const supprimerButton = document.createElement('button');
        supprimerButton.textContent = 'Supprimer';
        supprimerButton.classList.add('btn-supprimer', 'btn-operation'); 
        supprimerButton.addEventListener('click', function () {
            supprimerUtilisateur(person.email);
        });

        operationsCell.appendChild(modifierButton);
        operationsCell.appendChild(supprimerButton);
    });
};

function supprimerUtilisateur(email) {
    var id_utilisateur;
    for (let i = 0; i < data.length; i++) {
        if (data[i]["email"] === email) {
            var id_utilisateur = data[i]["id_utilisateur"];
        }
    }
    
    var send = {
        "id_utilisateur": id_utilisateur,
    };

    var httpRequest = new XMLHttpRequest();
    httpRequest.open('POST', './api/api/delete.php');
    httpRequest.setRequestHeader("Content-Type", "application/json");
    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState === 4) {
            if (httpRequest.status === 200) {
                console.log('Suppression réussie');
            } else {
                console.error("Erreur lors de l'envoi");
            }
        }
    };

    httpRequest.send(JSON.stringify(send));
    window.location.href = 'admin.html';
}

function modifierUtilisateur(userId) {
    console.log('Modifier utilisateur avec ID:', userId);
}

  function diagramme() {
    var ctx = document.getElementById('myChart').getContext('2d');
    selectQuestion = document.getElementById('selectQuestion');

    var data = {
        labels: ['Très bien', 'Bien', 'Moyen', 'Mauvais'],
        datasets: []
    };

    var options = {
        responsive: false,
        maintainAspectRatio: false,
    };

    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: options
    });

    selectQuestion.addEventListener('change', function () {

        var questionIndex = selectQuestion.selectedIndex;

        var statsForQuestions = [
            [0, 0, 0, 0],
            [20, 50, 20, 10], 
            [30, 40, 10, 20], 
            [40, 40, 10, 10],
            [30, 20, 20, 30],
            [70, 10, 10, 10],
            [10, 30, 10, 50],
            [30, 40, 10, 20],
            [70, 20, 0, 20],
        ];

        if (statsForQuestions[questionIndex]) {
            myChart.data.datasets[0] = {
                data: statsForQuestions[questionIndex],
                backgroundColor: ['#2F2A85', '#2017D5', '#6A62FF', '#A6A1FF']
            };
        } else {
            myChart.data.datasets[0] = {};
        }

        myChart.update();
    });
};

function statsVisites() {
    var ctx = document.getElementById('barChart').getContext('2d');

    var existingChart = Chart.getChart(ctx);
    if (existingChart) {
        existingChart.destroy();
    }

    var data = {
        labels: ['Inscrits', 'Visiteurs'],
        datasets: [{
            label: 'Statistiques Journées Portes Ouvertes',

            data: [all, count],
            backgroundColor: [
                '#2F2A85', 
                '#A6A1FF'
            ],
            borderColor: [
                '#2F2A85',
                '#A6A1FF'
            ],
            borderWidth: 1
        }]
    };

    var options = {
        responsive: true, 
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    var barChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: options
    });
};


function toggleMenu() {
    const navLinks = document.querySelector('.nav-links');
    navLinks.classList.toggle('show');

};

setTimeout(() => {
    tableau2();
}, 500);

setTimeout(() => {
    diagramme();
}, 500);

setTimeout(() => {
    statsVisites();
}, 500);