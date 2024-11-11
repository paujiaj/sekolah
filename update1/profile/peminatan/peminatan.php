<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../../includes/ess/head.php" ?>
    <link rel="stylesheet" type="text/css" href="public/css/peminatan.css">
    <script src="public/js/peminatan.js" defer></script>
    <link rel="stylesheet" type="text/css" href="../../includes/css/nav.css">
    <link rel="stylesheet" type="text/css" href="../../includes/css/root.css">
    <script src="../../includes/js/destroy-session.js" defer></script>
    <title>Ganti Jadwal - LABSCHOOL</title>
</head>
<?php
include "../../includes/ess/session.php";

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../../login/login.php');
    exit;
}

include "../../includes/ess/conn.php";

$kelaspmt = '';
$data = $_GET['data'];
echo "<script>console.log('$data')</script>";

if (isset($_GET['data'])) {
    include "../../includes/ess/dekrip.php";


    $id = $params['id'];
    $username = $params['username'];
    $kelasNoDash = $params['kelas'];
    $fullname = $params['fullname'];
    $angkatan = str_replace('kelas__', '', $kelasNoDash);
    $angkatan = substr($angkatan, 0, -1);

    echo "<script>console.log('$kelasNoDash')</script>";

    $stmt = $conn->prepare("SELECT * FROM `$kelasNoDash` WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();
    $stmt->close();

    if ($kelasNoDash !== 'kelas__guru') {
        if (empty($item['ppImg'])) {
            $item['ppImg'] = '../includes/img/icon/profile.png';
        }

        if (!empty($item['kelaspmt'])) {
            $kelaspmt = $item['kelaspmt'];
            $jawaban = [];
            for ($i = 0; $i < strlen($kelaspmt); $i += 2) {
                $questionNumber = $kelaspmt[$i];
                $answerValue = $kelaspmt[$i + 1];
                $jawaban[$questionNumber] = $answerValue; // Store in associative array
            }
        }

        $sql = "SELECT A, B, C, D, Number FROM `$angkatan`"; // Replace with your actual table name and column
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $Number1 = $result->fetch_assoc();
            $Number2 = $result->fetch_assoc();
            $Number3 = $result->fetch_assoc();
            $Number4 = $result->fetch_assoc();
            $Number5 = $result->fetch_assoc();
            $Number6 = $result->fetch_assoc();
        }
        $showElementGuru = false;
    } else {
        $showElementGuru = true;
    }
    echo "<script>console.log('$showElementGuru')</script>";
}
?>

<body>
    <?php include "../../includes/nav-sub.php" ?>
    <?php if ($showElementGuru === false): ?>
        <div class="form-container">
            <form id="quizForm" method="POST" action="includes/logic/peminatan-logic.php">
                <table class="quiz-table">
                    <tbody>
                        <tr>
                            <td>Peminatan 1</td>
                            <td><input type="radio" name="q1" value="A" <?php echo (isset($jawaban[1]) && $jawaban[1] === 'A') ? 'checked' : ''; ?>><?php echo $Number1['A'] ?></td>
                            <td><input type="radio" name="q1" value="B" <?php echo (isset($jawaban[1]) && $jawaban[1] === 'B') ? 'checked' : ''; ?>><?php echo $Number1['B'] ?></td>
                            <td><input type="radio" name="q1" value="C" <?php echo (isset($jawaban[1]) && $jawaban[1] === 'C') ? 'checked' : ''; ?>><?php echo $Number1['C'] ?></td>
                            <td><input type="radio" name="q1" value="D" <?php echo (isset($jawaban[1]) && $jawaban[1] === 'D') ? 'checked' : ''; ?>><?php echo $Number1['D'] ?></td>
                        </tr>
                        <tr>
                            <td>Peminatan 2</td>
                            <td><input type="radio" name="q2" value="A" <?php echo (isset($jawaban[2]) && $jawaban[2] === 'A') ? 'checked' : ''; ?>><?php echo $Number2['A'] ?></td>
                            <td><input type="radio" name="q2" value="B" <?php echo (isset($jawaban[2]) && $jawaban[2] === 'B') ? 'checked' : ''; ?>><?php echo $Number2['B'] ?></td>
                            <td><input type="radio" name="q2" value="C" <?php echo (isset($jawaban[2]) && $jawaban[2] === 'C') ? 'checked' : ''; ?>><?php echo $Number2['C'] ?></td>
                            <td><input type="radio" name="q2" value="D" <?php echo (isset($jawaban[2]) && $jawaban[2] === 'D') ? 'checked' : ''; ?>><?php echo $Number2['D'] ?></td>
                        </tr>
                        <tr>
                            <td>Peminatan 3</td>
                            <td><input type="radio" name="q3" value="A" <?php echo (isset($jawaban[3]) && $jawaban[3] === 'A') ? 'checked' : ''; ?>><?php echo $Number3['A'] ?></td>
                            <td><input type="radio" name="q3" value="B" <?php echo (isset($jawaban[3]) && $jawaban[3] === 'B') ? 'checked' : ''; ?>><?php echo $Number3['B'] ?></td>
                            <td><input type="radio" name="q3" value="C" <?php echo (isset($jawaban[3]) && $jawaban[3] === 'C') ? 'checked' : ''; ?>><?php echo $Number3['C'] ?></td>
                            <td><input type="radio" name="q3" value="D" <?php echo (isset($jawaban[3]) && $jawaban[3] === 'D') ? 'checked' : ''; ?>><?php echo $Number3['D'] ?></td>
                        </tr>
                        <tr>
                            <td>Peminatan 4</td>
                            <td><input type="radio" name="q4" value="A" <?php echo (isset($jawaban[4]) && $jawaban[4] === 'A') ? 'checked' : ''; ?>><?php echo $Number4['A'] ?></td>
                            <td><input type="radio" name="q4" value="B" <?php echo (isset($jawaban[4]) && $jawaban[4] === 'B') ? 'checked' : ''; ?>><?php echo $Number4['B'] ?></td>
                            <td><input type="radio" name="q4" value="C" <?php echo (isset($jawaban[4]) && $jawaban[4] === 'C') ? 'checked' : ''; ?>><?php echo $Number4['C'] ?></td>
                            <td><input type="radio" name="q4" value="D" <?php echo (isset($jawaban[4]) && $jawaban[4] === 'D') ? 'checked' : ''; ?>><?php echo $Number4['D'] ?></td>
                        </tr>
                        <tr>
                            <td>Peminatan 5</td>
                            <td><input type="radio" name="q5" value="A" <?php echo (isset($jawaban[5]) && $jawaban[5] === 'A') ? 'checked' : ''; ?>><?php echo $Number5['A'] ?></td>
                            <td><input type="radio" name="q5" value="B" <?php echo (isset($jawaban[5]) && $jawaban[5] === 'B') ? 'checked' : ''; ?>><?php echo $Number5['B'] ?></td>
                            <td><input type="radio" name="q5" value="C" <?php echo (isset($jawaban[5]) && $jawaban[5] === 'C') ? 'checked' : ''; ?>><?php echo $Number5['C'] ?></td>
                            <td><input type="radio" name="q5" value="D" <?php echo (isset($jawaban[5]) && $jawaban[5] === 'D') ? 'checked' : ''; ?>><?php echo $Number5['D'] ?></td>
                        </tr>
                        <tr class="tr-bottom">
                            <td>Peminatan 6</td>
                            <td><input type="radio" name="q6" value="A" <?php echo (isset($jawaban[6]) && $jawaban[6] === 'A') ? 'checked' : ''; ?>><?php echo $Number6['A'] ?></td>
                            <td><input type="radio" name="q6" value="B" <?php echo (isset($jawaban[6]) && $jawaban[6] === 'B') ? 'checked' : ''; ?>><?php echo $Number6['B'] ?></td>
                            <td><input type="radio" name="q6" value="C" <?php echo (isset($jawaban[6]) && $jawaban[6] === 'C') ? 'checked' : ''; ?>><?php echo $Number6['C'] ?></td>
                            <td><input type="radio" name="q6" value="D" <?php echo (isset($jawaban[6]) && $jawaban[6] === 'D') ? 'checked' : ''; ?>><?php echo $Number6['D'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="footer">
                    <button type="submit">Submit</button>
                    <a href="../profile.php?data=<?php echo $encryptedUrl ?>">Cancel
                    </a>
                </div>
            </form>
        </div>
    <?php else: ?>
        <p>test</p>
    <?php endif; ?>

</body>

</html>