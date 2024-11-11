document.addEventListener("DOMContentLoaded", function () {
    // Toggle the dropdown menu when the button is clicked
    document.getElementById('dropdown-btn').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default action of the link

        var dropdownParent = this.closest('.dropdown'); // Get the parent dropdown
        var dropdownMenu = dropdownParent.querySelector('.dropdown-menu'); // Get the dropdown menu

        // Toggle the display of the dropdown menu
        dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';
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
    });
});

function clearRadioButtons(rowId) {
    event.preventDefault();
    // Get all the radio buttons inside the row
    var radios = document.querySelectorAll('#' + rowId + ' input[type="radio"]');
    
    // Loop through each radio button and uncheck them
    radios.forEach(function(radio) {
        radio.checked = false;
    });
}