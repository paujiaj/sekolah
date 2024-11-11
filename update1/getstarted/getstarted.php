<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../includes/ess/head.php" ?>
    <link rel="stylesheet" type="text/css" href="public/css/getstarted.css">
    <script src="public/js/getstarted.js" defer></script>
    <title>Get Started</title>
</head>

<?php
include "../includes/ess/session.php";
include "../includes/ess/conn.php";
if (isset($_GET['data'])) {

    include "../includes/ess/dekrip.php";
    echo "<script>console.log('$encryptedQuery')</script>";
    echo "<script>console.log('$secretkey')</script>";

    $id = $params['id'];
    $username = $params['username'];
    $kelasNoDash = $params['kelas'];
    $kelas = str_replace("kelas__", "", $kelasNoDash);
    $angkatan = substr($kelas, 0, -1);
    $fullname = $params['fullname'];
    echo "<script>console.log('$kelas')</script>";

    if ($kelas == 'guru') {
        $showGuru = true;
    } else if ($angkatan == '11' || $angkatan == '12' && $kelas !== '111') {
        $showGuru = false;
        $showPeminatan = true;
    } else {
        $showGuru = false;
        $showPeminatan = false;
    }

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
}
?>

<body>
    <section class="fullPage">
        <div class="app">
            <div class="title">
                <h1>Get Started</h1>
            </div>
            <?php if ($showGuru == true): ?>
                <div class="form">
                    <form id="loginForm" action="getstarted-b.php?data=<?php echo "$encryptedUrl" ?>" method="POST" onsubmit="validateAndSubmit(event)" class="app-form">
                        <h1>Apakah anda mengajar di mata pelajaran peminatan?</h1>
                        <label>
                            <input type="checkbox" id="trueCheckbox" name="answer" value="iya" onclick="toggleCheckboxes(this)">
                            Iya
                        </label>
                        <br>
                        <label>
                            <input type="checkbox" id="falseCheckbox" name="answer" value="tidak" onclick="toggleCheckboxes(this)">
                            Tidak
                        </label>
                        <br>
                        <button class="login-btn" type="submit">Next</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </section>
</body>

</html>