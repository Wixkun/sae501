let currentIndex = 0;

    function showSlide(index) {
        const carousel = document.getElementById("carousel");
        const slideWidth = document.querySelector(".carousel-img").offsetWidth; 
        const newTransformValue = -index * slideWidth + "px";
        carousel.style.transform = "translateX(" + newTransformValue + ")";
        currentIndex = index;
    }

    function gauche() {
        currentIndex = (currentIndex - 1 + 6) % 6;
        showSlide(currentIndex);
    }

    function droite() {
        currentIndex = (currentIndex + 1) % 6;
        showSlide(currentIndex);
    }

    function toggleMenu() {
        const navLinks = document.querySelector('.nav-links');
        navLinks.classList.toggle('show');
    
    }