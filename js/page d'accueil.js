var info = "accueil";
var dates;
var requete = new XMLHttpRequest(); 
requete.open('GET', './api/api/read.php?info=' + info);
requete.onreadystatechange = function() {
    if (requete.readyState === 4) {
        if(requete.status === 200){
            dates = JSON.parse(requete.responseText);
            dates = dates["body"];
        }
    }
};
requete.send();

document.addEventListener("DOMContentLoaded", function() {
    var targetDate = new Date();

    function updateCountdown() {
      if(dates){     
        targetDate = new Date(dates[0]["date"]);
      };
      const currentDate = new Date();
      const timeDifference = targetDate - currentDate;

      const jours = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
      const heures = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));

      document.getElementById('jours-valeur').innerText = jours;
      document.getElementById('heures-valeur').innerText = heures;
      document.getElementById('minutes-valeur').innerText = minutes;
    }

    
    updateCountdown();

    
    setInterval(updateCountdown, 500);
  });

  function toggleMenu() {
    const navLinks = document.querySelector('.nav-links');
    navLinks.classList.toggle('show');

}