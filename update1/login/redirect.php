<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "../includes/ess/head.php" ?>
    <title>Redirecting...</title>
</head>

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
    $kelasgroup = "kelas__" . $params['kelas'];
    $fullname = $params['fullname'];

    $sql = $conn->query("CREATE TABLE IF NOT EXISTS `$kelasgroup` (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        fullname VARCHAR(255) NOT NULL,
        username VARCHAR(255) NOT NULL,
        kelaspmt VARCHAR(255) NOT NULL,
        mapel VARCHAR(255) NOT NULL,
        ppImg VARCHAR(255) NOT NULL
    )");

    $stmt = $conn->prepare("SELECT * FROM `$kelasgroup` WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Fetch the existing row
        $item = $result->fetch_assoc();

        function encryptData($data, $key)
        {
            $cipher = "AES-256-CBC";
            $ivLength = openssl_cipher_iv_length($cipher);
            $iv = openssl_random_pseudo_bytes($ivLength);

            $encrypted = openssl_encrypt($data, $cipher, $key, 0, $iv);
            return base64_encode($iv . $encrypted);
        }

        $queryString = "id=$id&username=$username&kelas=$kelasgroup&fullname=$fullname";
        $encryptedQuery = encryptData($queryString, $secretkey);
        $encryptedUrl = urlencode($encryptedQuery);

        header("Location: ../home/home.php?data=$encryptedUrl");
        exit;
    } else {
        $stmt_insert = $conn->prepare("INSERT INTO `$kelasgroup` (id, username, fullname) VALUES (?, ?, ?)");
        $stmt_insert->bind_param("iss", $id, $username, $fullname);
        $stmt_insert->execute();
        $stmt_insert->close();
        $item = $result->fetch_assoc();

        function encryptData($data, $key)
        {
            $cipher = "AES-256-CBC";
            $ivLength = openssl_cipher_iv_length($cipher);
            $iv = openssl_random_pseudo_bytes($ivLength);

            $encrypted = openssl_encrypt($data, $cipher, $key, 0, $iv);
            return base64_encode($iv . $encrypted);
        }

        $queryString = "id=$id&username=$username&kelas=$kelasgroup&fullname=$fullname";
        $encryptedQuery = encryptData($queryString, $secretkey);
        $encryptedUrl = urlencode($encryptedQuery);

        sleep(3);

        header("Location: ../home/home.php?data=$encryptedUrl");
    }
    $stmt->close();
}
?>

<body>
    <p>If you are not redirected, <a
            href="../home/home.php?data=<?php echo $encryptedUrl ?>">click
            here</a>.</p><br>
</body>

</html>