<?php

include "../../../includes/ess/session.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

include "../../../includes/ess/conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $sql = "SELECT id, password_hash, username, kelas, fullname FROM user WHERE username = ? OR fullname = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $username, $username);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $hashed_password, $username_server, $kelas, $fullname_server);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {

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

            $queryString = "id=$id&username=$username_server&kelas=$kelas&fullname=$fullname_server";
            $encryptedQuery = encryptData($queryString, $secretkey);
            $encryptedUrl = urlencode($encryptedQuery);

            // Password is correct, set session variables
            $_SESSION['loggedin'] = true;
            $send = [
                'success' => true,
                'id' => $id,
                'username' => $username_server,
                'kelas' => $kelas,
                'url' => $encryptedUrl,
                'fullname' => $fullname_server
            ];
            echo json_encode($send);
            exit;
        } else {
            $send = ['success' => false, 'message' => 'Invalid username or password'];
            echo json_encode($send);
        }

        $stmt->close();
    } else {
        $error = 'Please fill in both fields.';
    }
} else {
    $send = ['success' => false, 'message' => 'invalid server method'];
    echo json_encode($send);
}
