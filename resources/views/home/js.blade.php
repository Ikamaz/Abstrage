<script type="text/javascript">
    function confirmation(ev) {
        ev.preventDefault();

        var urlToRedirect = ev.currentTarget.getAttribute('href');

        console.log(urlToRedirect);
        swal({
                title: "დარწმუნებული ხართ, რომ წაშალოთ ეს მონაცემი?",
                text: "ეს სრულიად წაშლის მონაცემს ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })

            .then((willCancel) => {
                if (willCancel) {
                    window.location.href = urlToRedirect;
                }
            });
    }

    function openLightbox(image) {
        const lightbox = document.getElementById('lightbox');
        const lightboxImage = document.getElementById('lightbox-image');

        lightboxImage.src = image.src;
        lightbox.style.display = 'flex';
    }

    function closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        lightbox.style.display = 'none';
    }

    function initializeLightbox() {
        const galleryImages = document.querySelectorAll('.gallery-item img');
        galleryImages.forEach(image => {
            image.addEventListener('click', function() {
                openLightbox(image);
            });
        });

        const closeBtn = document.querySelector('.lightbox .close');
        if (closeBtn) {
            closeBtn.addEventListener('click', closeLightbox);
        }
    }

    window.scrollToSection = function(id) {
        document.getElementById(id).scrollIntoView({
            behavior: 'smooth'
        });
    };

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

    function decorSortProducts() {
        const productGrid = document.querySelector('.decor-product-grid');
        const products = Array.from(document.querySelectorAll('.decor-product-card'));

        const sortBy = document.getElementById('decor-sort').value;

        products.sort((a, b) => {
            const priceA = parseInt(a.getAttribute('data-price'));
            const priceB = parseInt(b.getAttribute('data-price'));

            return sortBy === 'price-asc' ? priceA - priceB : priceB - priceA;
        });

        products.forEach(product => productGrid.appendChild(product));
    }

    document.addEventListener('DOMContentLoaded', () => {
        initializeLightbox();
        initializeCarousel();
    });

    function simulateLogin() {
        localStorage.setItem('userLoggedIn', 'true');
        location.reload();
    }

    function simulateLogout() {
        localStorage.setItem('userLoggedIn', 'false');
        location.reload();
    }

    document.querySelector('#burger').addEventListener('click', function() {
        this.classList.toggle('active');
        document.querySelector('.nav-links').classList.toggle('active');
        document.querySelector('.nav-product').classList.toggle('active');
    });
</script>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
