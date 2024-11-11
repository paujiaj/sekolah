<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../includes/ess/head.php" ?>
    <link rel="stylesheet" type="text/css" href="public/css/getstarted-b.css">
    <script src="public/js/getstarted-b.js" defer></script>
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
        $jawaban = $_POST['answer'];
        if ($jawaban == 'tidak') {
            header("Location: getstarted-c.php?data=$encryptedQuery");
            exit;
        }

        $sql = "SELECT A, B, C, D, Number FROM `11`";
        $result11 = $conn->query($sql);

        if ($result11->num_rows > 0) {
            $Number111 = $result11->fetch_assoc();
            $Number211 = $result11->fetch_assoc();
            $Number311 = $result11->fetch_assoc();
            $Number411 = $result11->fetch_assoc();
            $Number511 = $result11->fetch_assoc();
            $Number611 = $result11->fetch_assoc();
        }

        $sql12 = "SELECT A, B, C, D, Number FROM `12`";
        $result12 = $conn->query($sql12);

        if ($result12->num_rows > 0) {
            $Number112 = $result12->fetch_assoc();
            $Number212 = $result12->fetch_assoc();
            $Number312 = $result12->fetch_assoc();
            $Number412 = $result12->fetch_assoc();
            $Number512 = $result12->fetch_assoc();
            $Number612 = $result12->fetch_assoc();
        }
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
                <h1>Get Started-b</h1>
            </div>-->
            <?php if ($showGuru == true): ?>
                <div class="form">
                    <form id="quizForm" action="includes/logic/getstarted-b-logic.php" method="POST" class="app-form">
                        <h1>Mata pelajaran apa saja yang diajarkan?</h1>

                        <ul>
                            <li class="dropdown">
                                <a href="#" id="dropdown-btn">
                                    <div class="icon">
                                        <i class="bi bi-arrow-down"></i>
                                    </div>
                                    <div class="mapel">
                                        <p>Kelas 11</p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php include "includes/view/guru/peminatan/kelas11.php" ?>
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
                                    <?php include "includes/view/guru/peminatan/kelas12.php" ?>
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