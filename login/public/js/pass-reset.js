document.getElementById('login-form').onsubmit = function (event) {
    event.preventDefault(); // Prevent default form submission
    const formData = new FormData(event.target);
    fetch('includes/logic/pass-reset.php', {
        method: 'POST',
        body: formData
    })
        .then(response => {
            // Ensure the response is valid JSON
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                localStorage.setItem('loggedin', true);
                localStorage.setItem('user_id', data.id);
                localStorage.setItem('username', data.username);
                localStorage.setItem('kelas', data.kelas);
                localStorage.setItem('fullname', data.fullname);

                callSuccessMsg(data.message, 3000);

                setTimeout(function () {
                    window.location.href = 'redirect.php?data=' + data.url;
                }, 2000);
            } else {
                callErrorMsg(data.message, 5000)
            }
        })
        .catch(error => {
            console.error('Error: ', error);  // Log error to the console
            callErrorMsg('An unexpected error occurred. Please try again.', 5000);
        })
}

function callErrorMsg(isip, waktu) {
    var msg = document.getElementById('error-popup')
    var p = document.getElementById('error-msg-p')

    msg.style.display = 'block';
    p.textContent = isip;

    setTimeout(function () {
        msg.style.display = 'none'
    }, waktu);
}

function callSuccessMsg(isip, waktu) {
    var msg = document.getElementById('error-popup')
    var p = document.getElementById('error-msg-p')

    msg.style.display = 'block';
    msg.style.backgroundColor = "green";
    p.textContent = isip;

    setTimeout(function () {
        msg.style.display = 'none'
    }, waktu);
}

window.addEventListener('load', function () {
    if (localStorage.getItem('loggedin')) {
        // If logged in, redirect to the home page or wherever needed
        const user_id = localStorage.getItem('user_id');
        const username = localStorage.getItem('username');
        const kelas = localStorage.getItem('kelas');
        const fullname = localStorage.getItem('fullname');

        const formData = new FormData
        formData.append('id', user_id);
        formData.append('username', username);
        formData.append('kelas', kelas);
        formData.append('fullname', fullname);

        fetch('includes/logic/local-login.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = 'redirect.php?data=' + data.url;
                } else {
                    callErrorMsg(data.message, 3000)
                }
            });
    }
});