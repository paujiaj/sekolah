const menuOverlay = document.getElementById('menuOverlay')
const ppLink = document.getElementById('pp-link')

ppLink.addEventListener('click', () => {
    // Toggle the 'show' class on the content element
    menuOverlay.classList.toggle('pp-overlay-show');
});

function hideOverlay() {
    menuOverlay.classList.toggle('pp-overlay-show');
}

function getQueryParam(param) {
    let urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

// Get the 'kelas' parameter from the URL
let subkelas = getQueryParam('subkelas');

// If 'kelas' exists in the URL, change the background of the corresponding div
if (subkelas) {
    let targetDiv = document.getElementById(subkelas);
    if (targetDiv) {
        targetDiv.style.backgroundColor = '#BB99CD80'; // Change to desired background color
    }
}

document.addEventListener("DOMContentLoaded", function () {
    // Toggle the dropdown menu when the button is clicked
    document.getElementById('dropdown-btn').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default action of the link

        var dropdownParent = this.closest('.dropdown'); // Get the parent dropdown
        var dropdownMenu = dropdownParent.querySelector('.dropdown-menu'); // Get the dropdown menu

        // Toggle the display of the dropdown menu
        dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';

        // Toggle the 'dropdown-active' class on the parent <li> element
        dropdownParent.classList.toggle('dropdown-active');
    });

    // Close the dropdown when clicking outside
    document.addEventListener('click', function (event) {
        var dropdown = document.querySelector('.dropdown');
        if (!dropdown.contains(event.target)) {
            var dropdownMenu = dropdown.querySelector('.dropdown-menu');
            dropdownMenu.style.display = 'none'; // Hide the dropdown menu
            dropdown.classList.remove('dropdown-active'); // Remove the 'dropdown-active' class
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // Toggle the dropdown menu when the button is clicked
    document.getElementById('dropdown-btn2').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default action of the link

        var dropdownParent = this.closest('.dropdown'); // Get the parent dropdown
        var dropdownMenu = dropdownParent.querySelector('.dropdown-menu'); // Get the dropdown menu

        // Toggle the display of the dropdown menu
        dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';

        // Toggle the 'dropdown-active' class on the parent <li> element
        dropdownParent.classList.toggle('dropdown-active');
    });

    // Close the dropdown when clicking outside
    document.addEventListener('click', function (event) {
        var dropdown = document.querySelector('.dropdown');
        if (!dropdown.contains(event.target)) {
            var dropdownMenu = dropdown.querySelector('.dropdown-menu');
            dropdownMenu.style.display = 'none'; // Hide the dropdown menu
            dropdown.classList.remove('dropdown-active'); // Remove the 'dropdown-active' class
        }
    });
});