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

document.getElementById('quizForm').onsubmit = function (event) {
    event.preventDefault(); // Prevent normal form submission

    let answers11 = "";
    for (let i11 = 1; i11 <= 6; i11++) { // Loop through your question numbers
        let answer11 = document.querySelector('input[name="q' + i11 + '"]:checked');
        if (answer11) {
            answers11 += i11 + answer11.value; // Concatenate question number and answer
        }
    }

    let answers12 = "";
    for (let i12 = 1; i12 <= 6; i12++) { // Loop through your question numbers
        let answer12 = document.querySelector('input[name="q' + i12 + '2"]:checked');
        if (answer12) {
            answers12 += i12 + answer12.value; // Concatenate question number and answer
        }
    }

    let answers = answers11 + ',' + answers12

    const currentUrl = window.location.href;
    const url = new URL(currentUrl);
    const data = url.searchParams.get('data');

    // Create hidden inputs for answers, id, kelas, and username
    const formData = new FormData();
    formData.append('answers', answers);
    formData.append('data', data);

    formData.forEach((value, key) => {
        console.log(`${key}: ${value}`);
    });

    // Use AJAX to submit form data
    fetch('includes/logic/getstarted-b-logic.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data); // Handle the data returned from PHP
            if (data.success) {
                window.location.href = 'getstarted-c.php?data=' + data.url;
            }
        })
        .catch(error => console.error('Error:', error));
};