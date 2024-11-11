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
    $kelas = str_replace('kelas__', '', $kelasNoDash);
    $fullname = $params['fullname'];

    $angkatan = substr($kelasNoDash, 0, -1);
    $kelaswajib = substr($kelas, 0, -1) . 'wajib';

    echo "<script>console.log('$kelaswajib')</script>";

    $stmt = $conn->prepare("SELECT * FROM `$kelasNoDash` WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();
    $stmt->close();

    if (empty($item['ppImg'])) {
        $item['ppImg'] = '../includes/img/icon/profile.png';
    }
}

?>

<head>
    <?php include "../includes/ess/head.php" ?>
    <link rel="stylesheet" type="text/css" href="public/css/kelas.css">
    <script src="public/js/kelas.js" defer></script>
    <title>Kelas <?php echo $kelas; ?> - LABSCHOOL</title>
</head>

<body>
    <?php include "../includes/nav.php" ?>
    <?php if ($angkatan === 'kelas__11' || $angkatan === 'kelas__12'): ?>
        <div class="mapel-wajib">
            <div class="wajib-header">
                <p>MAPEL WAJIB</p>
            </div>
            <div class="wajib">
                <?php include 'includes/view/mapelWajib.php'; ?>
            </div>
            <hr>
        </div>

        <div class="mapelpmt">
            <div class="pmt-header">
                <p>MAPEL PEMINATAN</p>
            </div>
            <div class="pmt">
                <?php include 'includes/logic/kelas-logic.php'; ?>
            </div>
        </div>
    <?php elseif ($angkatan === 'kelas__10'): ?>
        <div class="mapel-wajib">
            <div class="wajib-header">
                <p>MAPEL WAJIB</p>
            </div>
            <div class="wajib">
                <?php include 'includes/view/mapelWajib.php'; ?>
            </div>
            <hr>
        </div>
    <?php endif; ?>
</body>

</html>