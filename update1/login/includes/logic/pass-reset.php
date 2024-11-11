<?php
include "../../../includes/ess/session.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

include "../../../includes/ess/conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $kelas = $_POST['kelas'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $kelasNoDash = str_replace('-', '', $kelas);
        $sql = "SELECT username, id, fullname FROM user WHERE username = ? OR fullname = ? AND kelas = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $username, $username, $kelasNoDash);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($username_server, $id, $fullname_server);
            $stmt->fetch();

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // Prepare and execute the query
            $sql = "UPDATE user SET password_hash = ? WHERE fullname = ? OR username = ? AND kelas = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $hashed_password, $username, $username, $kelasNoDash);
            if ($stmt->execute()) {

                function encryptData($data, $key)
                {
                    $cipher = "AES-256-CBC";
                    $ivLength = openssl_cipher_iv_length($cipher);
                    $iv = openssl_random_pseudo_bytes($ivLength);

                    $encrypted = openssl_encrypt($data, $cipher, $key, 0, $iv);
                    return base64_encode($iv . $encrypted);
                }

                $secretkey = bin2hex(openssl_random_pseudo_bytes(16));
                $_SESSION['secretkey'] = $secretkey;

                $queryString = "id=$id&username=$username_server&kelas=$kelasNoDash&fullname=$fullname_server";
                $encryptedQuery = encryptData($queryString, $secretkey);
                $encryptedUrl = urlencode($encryptedQuery);

                $_SESSION['loggedin'] = true;
                echo json_encode([
                    'success' => true, 
                    'message' => "pass change success", 
                    'id' => $id, 
                    'username' => $username_server, 
                    'kelas' => $kelasNoDash, 
                    'fullname' => $fullname_server,
                    'url' => $encryptedUrl
                ]);
                exit;
            }
        } else {
            echo json_encode(['success' => false, 'message' => "$username is not a member of $kelas"]);
            $item = null;
            exit;
        }
        $stmt->close();
    } else {
        $error = 'Please fill in both fields.';
    }
}
?>