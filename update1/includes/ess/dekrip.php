<?php
function decryptData($encryptedData, $key)
{
    $cipher = "AES-256-CBC";
    $ivLength = openssl_cipher_iv_length($cipher);

    $data = base64_decode($encryptedData);
    $iv = substr($data, 0, $ivLength);
    $encrypted = substr($data, $ivLength);

    return openssl_decrypt($encrypted, $cipher, $key, 0, $iv);
}

$secretkey = $_SESSION['secretkey'];

$encryptedQuery = $_GET['data'];

$decryptedQuery = decryptData($encryptedQuery, $secretkey);

parse_str($decryptedQuery, $params);
?>