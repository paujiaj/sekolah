<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../includes/ess/head.php" ?>
    <link rel="stylesheet" type="text/css" href="public/css/getstarted-c.css">
    <script src="public/js/getstarted-c.js" defer></script>
    <title>Get Started</title>
</head>

<?php
include "../includes/ess/session.php";
include "../includes/ess/conn.php";
if (isset($_GET['data'])) {

    include "../includes/ess/dekrip.php";

    $id = $params['id'];
    $username = $params['username'];
    $kelasNoDash = $params['kelas'];
    $kelas = str_replace("kelas__", "", $kelasNoDash);
    $angkatan = substr($kelas, 0, -1);
    $fullname = $params['fullname'];
    //echo "<script>console.log('$kelas')</script>";

    if ($kelas == 'guru') {
        $showGuru = true;
    } else if ($angkatan == '11' || $angkatan == '12' && $kelas !== '111') {
        $showGuru = false;
        $showPeminatan = true;
    } else {
        $showGuru = false;
        $showPeminatan = false;
    }
}
?>

<body>
    <section class="fullPage">
        <div class="app">
            <!--<div class="title">
                <h1>Get Started-C</h1>
            </div>-->
            <?php if ($showGuru == true): ?>
                <div class="form">
                    <form id="quizForm" action="includes/logic/getstarted-b-logic.php" method="POST" class="app-form">
                        <h1>Mata pelajaran wajib apa saja yang diajarkan?</h1>

                        <ul>
                            <li class="dropdown">
                                <a href="#" id="dropdown-btn">
                                    <div class="icon">
                                        <i class="bi bi-arrow-down"></i>
                                    </div>
                                    <div class="mapel">
                                        <p>Kelas 10</p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php include "includes/view/guru/wajib/kelas10.php" ?>
                                </ul>

                            </li>
                            <hr>
                            <li class="dropdown drop2">
                                <a href="#" id="dropdown-btn2">
                                    <div class="icon">
                                        <i class="bi bi-arrow-down"></i>
                                    </div>
                                    <div class="mapel">
                                        <p>Kelas 12</p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu menu2">
                                    <?php include "includes/view/guru/kelas12.php" ?>
                                </ul>
                            </li>
                        </ul>
                        <div class="footer">
                            <a href="getstarted.php?data=<?php echo "$encryptedQuery" ?>">Back</a>
                            <button class="login-btn" type="submit">Next</button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </section>
</body>

</html>