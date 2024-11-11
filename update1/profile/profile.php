<!DOCTYPE html>
<html lang="en">

<?php
include "../includes/ess/session.php";

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../login/login.php');
    exit;
}

include "../includes/ess/conn.php";

if (isset($_GET['data'])) {

    include "../includes/ess/dekrip.php";

    $id = $params['id'];
    $username = $params['username'];
    $kelasNoDash = $params['kelas'];
    $fullname = $params['fullname'];
    $angkatan = substr($kelasNoDash, 0, -1);

    $stmt = $conn->prepare("SELECT * FROM `$kelasNoDash` WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();
    $stmt->close();

    if (empty($item['ppImg'])) {
        $item['ppImg'] = '../includes/img/icon/profile.png';
    }

    if ($kelasNoDash === 'kelas__guru' || $angkatan === 'kelas__10' || $kelasNoDash === 'kelas__111') {
        $showElementMinat = false;
    } else {
        $showElementMinat = true;
    }

    if ($kelasNoDash === 'kelas__guru') {
        $showElementGuru = true;
    } else {
        $showElementGuru = false;
    }

    echo "<script>console.log('$kelasNoDash')</script>";

}
?>

<head>
    <?php include "../includes/ess/head.php" ?>
    <link rel="stylesheet" type="text/css" href="public/css/profile.css">
    <script src="public/js/profile.js" defer></script>
    <title><?php echo strtoupper($username)?> - LABSCHOOL</title>
</head>

<body>
    <?php include "../includes/nav.php" ?>
    <?php include "includes/view/header.php" ?>
    <section id="kelas">
    </section>
</body>

</html>