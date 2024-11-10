<?php
include "../../../includes/ess/session.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

include "../../../includes/ess/conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $kelas = $_POST['kelas'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password) && !empty($fullname)) {
        $kelasNoDash = str_replace('-', '', $kelas);

        // Prepare SQL statement to prevent SQL injection
        $sql = "SELECT username, id, fullname FROM user WHERE fullname = ? AND kelas = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $fullname, $kelasNoDash);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($username_server, $id, $fullname_server);
            $stmt->fetch();
            if (empty($username_server)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                // Prepare and execute the query
                $sql = "UPDATE user SET password_hash = ?, username = ? WHERE fullname = ? AND kelas = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $hashed_password, $username, $fullname, $kelasNoDash);
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

                    $queryString = "id=$id&username=$username&kelas=$kelas&fullname=$fullname_server";
                    $encryptedQuery = encryptData($queryString, $secretkey);
                    $encryptedUrl = urlencode($encryptedQuery);

                    $_SESSION['loggedin'] = true;
                    echo json_encode([
                        'success' => true, 
                        'message' => "account creat success", 
                        'id' => $id, 
                        'username' => $username, 
                        'kelas' => $kelasNoDash, 
                        'fullname' => $fullname_server,
                        'url' => $encryptedUrl
                    ]);
                }
            } else {
                echo json_encode(['success' => false, 'message' => "You already have account"]);
                $item = null;
            }
        } else {
            echo json_encode(['success' => false, 'message' => "$fullname is not a member of $kelas"]);
            $item = null;
        }
        $stmt->close();
    } else {
        $error = 'Please fill in both fields.';
    }
}
?>