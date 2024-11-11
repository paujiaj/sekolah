const menuOverlay = document.getElementById('menuOverlay')
const ppLink = document.getElementById('pp-link')

ppLink.addEventListener('click', () => {
    // Toggle the 'show' class on the content element
    menuOverlay.classList.toggle('pp-overlay-show');
});

function hideOverlay() {
    menuOverlay.classList.toggle('pp-overlay-show');
}

const images = document.querySelectorAll('.mapelImg');

images.forEach(function (image) {
    image.onerror = function () {
        this.src = 'public/img/book.jpg';
    };
});