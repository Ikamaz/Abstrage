

// Initialize Lightbox Functionality
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

// Initialize Lightbox Event Listeners
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

// Smooth Scroll Function
window.scrollToSection = function(id) {
  document.getElementById(id).scrollIntoView({ behavior: 'smooth' });
};

// Carousel Functionality
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

// Function to Sort Decoration Products
function decorSortProducts() {
  const productGrid = document.querySelector('#decor-product-grid');
  const products = Array.from(document.querySelectorAll('#decor-product-card'));

  const sortBy = document.getElementById('decor-sort').value;

  products.sort((a, b) => {
    const priceA = parseInt(a.getAttribute('data-price'));
    const priceB = parseInt(b.getAttribute('data-price'));

    return sortBy === 'price-asc' ? priceA - priceB : priceB - priceA;
  });

  // Re-arrange products in the DOM
  products.forEach(product => productGrid.appendChild(product));
}

// Initialization
document.addEventListener('DOMContentLoaded', () => {
  initializeLightbox();
  initializeCarousel();
});



// Example function to simulate user login (for testing)
function simulateLogin() {
  localStorage.setItem('userLoggedIn', 'true');
  location.reload();
}

// Example function to simulate user logout (for testing)
function simulateLogout() {
  localStorage.setItem('userLoggedIn', 'false');
  location.reload();
}

document.querySelector('#burger').addEventListener('click', function() {
  this.classList.toggle('active');
  document.querySelector('.nav-links').classList.toggle('active');
  document.querySelector('.nav-product').classList.toggle('active');
});
