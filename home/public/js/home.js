let slideIndex = 1;
let autoSlideInterval;

showSlides(slideIndex);
startAutoSlide(); // Start the auto slide

function showSlides(n) {
    let slides = document.querySelectorAll('.slides img');
    let dots = document.querySelectorAll('.dot');

    if (n > slides.length) { slideIndex = 1; }
    if (n < 1) { slideIndex = slides.length; }

    const translateX = (slideIndex - 1) * -100; // Calculate the translateX value

    document.querySelector('.slides').style.transform = `translateX(${translateX}%)`;

    dots.forEach(dot => dot.classList.remove('active'));
    dots[slideIndex - 1].classList.add('active');
}

function nextSlide() {
    showSlides(slideIndex += 1);
}

function prevSlide() {
    showSlides(slideIndex -= 1);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function startAutoSlide() {
    clearInterval(autoSlideInterval);
    autoSlideInterval = setInterval(() => {
        nextSlide();
    }, 7000); // Change slide every 3 seconds
}

document.querySelector('.slider-container').addEventListener('mouseover', () => {
    clearInterval(autoSlideInterval);
});

document.querySelector('.slider-container').addEventListener('mouseout', startAutoSlide);

document.querySelectorAll('.dot').forEach((dot, index) => {
    dot.addEventListener('click', () => {
        currentSlide(index + 1);
        clearInterval(autoSlideInterval); // Stop auto slide when a dot is clicked
        startAutoSlide(); // Restart auto slide
    });
});

const menuOverlay = document.getElementById('menuOverlay')
const ppLink = document.getElementById('pp-link')

ppLink.addEventListener('click', () => {
    // Toggle the 'show' class on the content element
    menuOverlay.classList.toggle('pp-overlay-show');
});

function hideOverlay() {
    menuOverlay.classList.toggle('pp-overlay-show');
}
