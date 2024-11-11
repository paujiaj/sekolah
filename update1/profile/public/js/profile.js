const menuOverlay = document.getElementById('menuOverlay')
const ppLink = document.getElementById('pp-link')

ppLink.addEventListener('click', () => {
    menuOverlay.classList.toggle('pp-overlay-show');
});

function hideOverlay() {
    menuOverlay.classList.toggle('pp-overlay-show');
}

function editMode() {
    document.getElementById('save').style.display = 'block';
    document.getElementById('cancel').style.display = 'block';
    document.getElementById('edit-btn').style.display = 'none';
    document.getElementById('unedit').style.display = 'none';
    document.getElementById('edit').style.display = 'grid';
}

function cancelEdit() {
    document.getElementById('save').style.display = 'none';
    document.getElementById('cancel').style.display = 'none';
    document.getElementById('edit-btn').style.display = 'block';

    document.getElementById('unedit').style.display = 'grid';
    document.getElementById('edit').style.display = 'none';
}

function saveData(id) {
    document.getElementById('save').style.display = 'none';
    document.getElementById('edit-btn').style.display = 'block';
    document.getElementById('cancel').style.display = 'none';

    document.getElementById('unedit').style.display = 'grid';
    document.getElementById('edit').style.display = 'none';

    const currentUrl = window.location.href;
    const url = new URL(currentUrl);
    const data = url.searchParams.get('data');

    const usernameInput = document.getElementById('usernameInput');
    let usernameValue = usernameInput.value;

    const mapelInput = document.getElementById('mapelInput');
    let mapelValue = mapelInput.value;

    $.ajax({
        url: 'includes/logic/update-data.php',
        type: 'POST',
        data: {value: usernameValue, data: data, mapel: mapelValue, username: usernameValue},
        success: function (response) {
            console.log(response);
        },
        error: function (xhr, status, error) {
            console.log("Error: " + error);
        }
    });


    location.reload();
}

document.getElementById('browse-btn').addEventListener('click', function () {
    document.getElementById('file-input').click();
});

document.getElementById('file-input').addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
        uploadImage(file);
    }
});

const currentUrl = window.location.href;
const url = new URL(currentUrl);
const data = url.searchParams.get('data');

function uploadImage(file) {
    const formData = new FormData();
    formData.append('image', file);
    formData.append('data', data);

    fetch('includes/logic/update-data.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
        });
}