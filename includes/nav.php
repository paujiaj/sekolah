<?php
function encryptData($data, $key)
{
    $cipher = "AES-256-CBC";
    $ivLength = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivLength);

    $encrypted = openssl_encrypt($data, $cipher, $key, 0, $iv);
    return base64_encode($iv . $encrypted);
}

$queryString = "id=$id&username=$username&kelas=$kelasNoDash&fullname=$fullname";
$encryptedQuery = encryptData($queryString, $secretkey);
$encryptedUrl = urlencode($encryptedQuery);
?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Toggle the dropdown menu when clicking on the profile image or container
        document.getElementById('pp-link').addEventListener('click', function (event) {
            var dropdownMenu = this.closest('.dropdown').querySelector('.dropdown-menu');
            dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';
        });

        // Close the dropdown when clicking outside of it
        document.addEventListener('click', function (event) {
            var isClickInside = document.querySelector('.dropdown').contains(event.target);

            if (!isClickInside) {
                var dropdownMenu = document.querySelector('.dropdown-menu');
                dropdownMenu.style.display = 'none'; // Hide dropdown
            }
        });

        // Allow links inside the dropdown to work without collapsing the menu
        document.querySelectorAll('.dropdown-menu a').forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.stopPropagation(); // Allow link functionality without affecting dropdown visibility
            });
        });
    });

</script>

<nav class="nav1">
    <div class="nav-icon">
        <a href="../home/home.php?data=<?php echo $encryptedUrl ?>">
            <img src="../includes/img/icon/LOGO-UPI.png">
        </a>
    </div>
    <div class="nav-links" id="nav-links">
        <ul>
            <li><a class="navb" href="../home/home.php?data=<?php echo $encryptedUrl ?>">
                    Home</a></li>
            <hr>
            <li><a class="navb" href="../news/news.php">News</a></li>
            <hr>
            <li><a class="navb" href="../kelas/kelas.php?data=<?php echo $encryptedUrl ?>">Kelas</a>
            </li>
            <li class="dropdown">
                <div class="nav-pp">
                    <div class="pp-img" id="pp-link">
                        <img src="<?php echo $item['ppImg'] ?>">
                    </div>
                </div>
                <ul class="dropdown-menu">
                    <li><i class="bi bi-person"></i><a class="menub"
                            href="../profile/profile.php?data=<?php echo $encryptedUrl ?>">Profile</a>
                    </li>
                    <hr>
                    <li><i class="bi bi-box-arrow-left"></i><a class="menub" href="../includes/logout.php">Logout</a>
                    </li>
                    <hr>
                    <li><i class="bi bi-gear"></i><a class="menub" href="">Setting</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<!--<div class="pp-overlay" id="menuOverlay">
    <div class="menu-overlay">
        <ul>
            <li><i class="bi bi-person"></i><a class="menub"
                    href="../profile/profile.php?data=<?php echo $encryptedUrl ?>">Profile</a>
            </li>
            <hr>
            <li><i class="bi bi-box-arrow-left"></i><a class="menub" href="../includes/logout.php">Logout</a></li>
            <hr>
            <li><i class="bi bi-gear"></i><a class="menub" href="">Setting</a></li>
        </ul>
    </div>
    <div class="fullOverlay" onclick="hideOverlay()"></div>
</div>-->