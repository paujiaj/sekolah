document.getElementById('login-form').onsubmit = function (event) {
    event.preventDefault(); // Prevent default form submission
    const formData = new FormData(event.target);
    formData.forEach((value, key) => {
        console.log(`${key}: ${value}`);
    });
    alert('1')
    fetch('includes/logic/login-logic.php', {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('network response was not ok');
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

                window.location.href = 'redirect.php?data=' + data.url;
            } else if (!data) {
                callErrorMsg('data empty', 3000)
            } else if (data.success == false) {
                callErrorMsg('data = false', 3000)
            } else if (!data.success) {
                callErrorMsg('data success empty', 3000)
                console.log(data);
            }
        })
        .catch(error => {
            console.error('Error: ', error);
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
    if (localStorage.getItem('loggedin') === 'true' || localStorage.getItem('loggedin') === '1') {
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
            .then(response => response.text())
            .then(data => {
                if (data.success) {
                    window.location.href = 'redirect.php?data=' + data.url;
                } else {
                    callErrorMsg(data.message, 3000)
                }
            })
            .catch(error => {
                console.error('Error: ', error);
            });
    } else {
        console.log('User is not logged in.');
    }
});