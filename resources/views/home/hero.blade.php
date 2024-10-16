<section class="hero">
    <div class="hero-carousel">
        <div class="carousel-slide">
            <img src="img/image1.avif" alt="Hero Image 1">
        </div>
        <div class="carousel-slide">
            <img src="img/image2.avif" alt="Hero Image 2">
        </div>
        <div class="carousel-slide">
            <img src="img/image3.jpg" alt="Hero Image 3">
        </div>
    </div>
    <div class="hero-text">
        <h1>ABSTRAGE</h1>
        <p>ABSTRAGE</p>
        <button onclick="scrollToSection('gallery')">იხილეთ გალერეა</button>
    </div>
</section>

<script>
    function initializeCarousel() {
        const slides = document.querySelectorAll('.carousel-slide');
        let currentIndex = 0;

        function showNextSlide() {
            slides[currentIndex].style.opacity = '0';
            currentIndex = (currentIndex + 1) % slides.length;
            slides[currentIndex].style.opacity = '1';
        }

        slides[currentIndex].style.opacity = '1';
        setInterval(showNextSlide, 8000);
    }

    document.addEventListener('DOMContentLoaded', () => {
        initializeLightbox();
        initializeCarousel();
    });
</script>
