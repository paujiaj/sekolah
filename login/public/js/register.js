document.getElementById('loginForm').onsubmit = function (event) {
    event.preventDefault(); // Prevent default form submission
    const rememberMe = document.getElementById("rememberMe");
    const isChecked = rememberMe.checked ? "true" : "false";
    const formData = new FormData(event.target);
    fetch('includes/logic/register-logic.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (isChecked == "true") {
                    localStorage.setItem('loggedin', true);
                    localStorage.setItem('user_id', data.id);
                    localStorage.setItem('username', data.username);
                    localStorage.setItem('kelas', data.kelas);
                    localStorage.setItem('fullname', data.fullname);
                }

                window.location.href = 'redirect.php?data=' + data.url;
            } else {
                callErrorMsg(data.message, 3000)
            }
        });
};

function callErrorMsg(isip, waktu) {
    var msg = document.getElementById('error-popup')
    var p = document.getElementById('error-msg-p')

    msg.style.display = 'block';
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
                    localStorage.setItem('loggedin', true);
                    localStorage.setItem('user_id', data.id);
                    localStorage.setItem('username', data.username);
                    localStorage.setItem('kelas', data.kelas);
                    localStorage.setItem('fullname', data.fullname);

                    window.location.href = 'redirect.php?data=' + data.url;
                } else {
                    callErrorMsg(data.message, 3000)
                }
            });
    }
});