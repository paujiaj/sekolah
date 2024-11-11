<!DOCTYPE html>
<html lang="en">

<?php
include "../../includes/ess/session.php";

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../../login/login.php');
    exit;
}

include "../../includes/ess/conn.php";

if (isset($_GET['data'])) {
    include "../../includes/ess/dekrip.php";
    $id = $params['id'];
    $username = $params['username'];
    $kelasNoDash = $params['kelas'];
    $fullname = $params['fullname'];
    $subkelas = $_GET['subkelas'];

    $kelas = str_replace('kelas__', '', $kelasNoDash);
    $angkatan = substr($kelas, 0, -1);
    $kelaswajib = substr($kelas, 0, -1) . 'wajib';

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
    <?php include "../../includes/ess/head.php" ?>
    <link rel="stylesheet" type="text/css" href="public/css/subkelas.css">
    <script src="public/js/subkelas.js" defer></script>
    <link rel="stylesheet" type="text/css" href="../../includes/css/nav.css">
    <link rel="stylesheet" type="text/css" href="../../includes/css/root.css">
    <script src="../../includes/js/destroy-session.js" defer></script>
    <title><?php echo strtoupper($subkelas); ?> - LABSCHOOL</title>
</head>

<body>
    <?php include "../../includes/nav-sub.php" ?>
    <div class="nav2">
        <ul>
            <li class="back-btn">
                <a href="../kelas.php?data=<?php echo $encryptedUrl ?>" class="single-nav">
                    <div class="icon">
                        <i class="bi bi-arrow-left"></i>
                    </div>
                    <div class="mapel">
                        <p>BACK</p>
                    </div>
                </a>
            </li>
            <hr>
            <li class="dropdown">
                <a href="#" id="dropdown-btn">
                    <div class="icon">
                        <i class="bi bi-arrow-down"></i>
                    </div>
                    <div class="mapel">
                        <p>MAPEL WAJIB</p>
                    </div>
                </a>
                <ul class="dropdown-menu">
                    <hr>
                    <?php include "includes/view/mapel-wajib.php" ?>
                </ul>
            </li>
            <hr>
            <li class="dropdown drop2">
                <a href="#" id="dropdown-btn2">
                    <div class="icon">
                        <i class="bi bi-arrow-down"></i>
                    </div>
                    <div class="mapel">
                        <p>MAPEL PEMINATAN</p>
                    </div>
                </a>
                <ul class="dropdown-menu menu2">
                    <hr>
                    <?php include "includes/view/mapel-peminatan.php" ?>
                </ul>
            </li>
        </ul>
    </div>
</body>

</html>