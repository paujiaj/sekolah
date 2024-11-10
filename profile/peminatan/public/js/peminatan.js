const menuOverlay = document.getElementById('menuOverlay')
const ppLink = document.getElementById('pp-link')

ppLink.addEventListener('click', () => {
    // Toggle the 'show' class on the content element
    menuOverlay.classList.toggle('pp-overlay-show');
});

function hideOverlay() {
    menuOverlay.classList.toggle('pp-overlay-show');
}

document.getElementById('quizForm').onsubmit = function (event) {
    event.preventDefault(); // Prevent normal form submission

    let answers = "";
    for (let i = 1; i <= 6; i++) { // Loop through your question numbers
        let answer = document.querySelector('input[name="q' + i + '"]:checked');
        if (answer) {
            answers += i + answer.value; // Concatenate question number and answer
        }
    }

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
    fetch('includes/logic/peminatan-logic.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data); // Handle the data returned from PHP
            if (data.success) {
                window.location.href = '../profile.php?data=' + data.url;
            }
        })
        .catch(error => console.error('Error:', error));
};