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

const interval = setInterval(function() {
    var targetDate = new Date();

      if(dates){     
        targetDate = new Date(dates[0]["date"]);
      };
      const currentDate = new Date();
      const timeDifference = targetDate - currentDate;

      const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
      const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

    document.getElementById('countdown').innerHTML = `${days} jour(s), ${hours} heure(s), ${minutes} minute(s), ${seconds} seconde(s)`;

    if (distance < 0) {
        clearInterval(interval);
        document.getElementById('countdown').innerHTML = 'La visite virtuelle a commencé !';
    }
}, 1000);

function toggleMenu() {
    const navLinks = document.querySelector('.nav-links');
    navLinks.classList.toggle('show');

}