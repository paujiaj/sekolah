<?php

include "../../../includes/ess/session.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $kelas = $_POST['kelas'];
    $id = $_POST['id'];
    
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

    $queryString = "id=$id&username=$username&kelas=$kelas&fullname=$fullname";
    $encryptedQuery = encryptData($queryString, $secretkey);
    $encryptedUrl = urlencode($encryptedQuery);

    echo json_encode([
        'username' => $username,
        'fullname' => $fullname,
        'kelas' => $kelas,
        'id' => $id,
        'success' => true,
        'url' => $encryptedUrl,
        'loggedin' => $_SESSION['loggedin']
    ]);
}
exit;

?>