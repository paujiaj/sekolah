<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../includes/ess/head.php" ?>
    <link rel="stylesheet" type="text/css" href="public/css/home.css">
    <script src="public/js/home.js" defer></script>
    <title>Home - LABSCHOOL</title>
</head>

<?php
include "../includes/ess/session.php";

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "
    <script>
        localStorage.removeItem('loggedin');
        localStorage.removeItem('user_id');
        localStorage.removeItem('username');
        localStorage.removeItem('kelas');
        localStorage.removeItem('fullname');
        localStorage.removeItem('url');
        window.location.href = '../login/login.php';
    </script>
    ";
    exit;
}

include "../includes/ess/conn.php";

if (isset($_GET['data'])) {

    include "../includes/ess/dekrip.php";

    $id = $params['id'];
    $username = $params['username'];
    $kelasNoDash = $params['kelas'];
    $fullname = $params['fullname'];


    $stmt = $conn->prepare("SELECT * FROM `$kelasNoDash` WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Fetch the existing row
        $item = $result->fetch_assoc();
        $kelaspmt = $item['kelaspmt'];
        if (empty($item['kelaspmt']) || empty($item['mapel'])) {
            $first = true;
        } else {
            $first = false;
        }
    } else {
        $stmt_insert = $conn->prepare("INSERT INTO `$kelasNoDash` (id, username, fullname) VALUES (?, ?, ?)");
        $stmt_insert->bind_param("iss", $id, $username, $fullname);
        $stmt_insert->execute();
        $stmt_insert->close();
        $first = true;
    }

    $stmt->close();

    if (empty($item['ppImg'])) {
        $item['ppImg'] = '../includes/img/icon/profile.png';
    }
}
?>

<body>
    <?php include "../includes/nav.php" ?>
    <?php if ($first == true): ?>
        <iframe src="../getstarted/getstarted.php?data=<?php echo "$encryptedUrl" ?>" style="position:fixed; top:0; left:0; width:100%; height:100%; z-index:10000; border:none;"></iframe>
    <?php endif; ?>

    <div class="slider-container">
        <div class="slides">
            <img src="public/img/bmw.jpg">
            <img src="public/img/TRIAC-SUPRA1.jpg">
            <img src="public/img/Drift-Car.jpg">
        </div>
        <div class="arrow left" onclick="prevSlide()">&#10094;</div>
        <div class="arrow right" onclick="nextSlide()">&#10095;</div>
        <div class="dots">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </div>
    <p>test</p>
</body>

</html>