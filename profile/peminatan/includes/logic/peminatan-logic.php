<?php
include "../../../../includes/ess/session.php";
include "../../../../includes/ess/conn.php";

error_reporting(0);

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the data from POST

    $answers = isset($_POST['answers']) ? $_POST['answers'] : '';
    if (empty($answers)) {
        $response['message'] = 'No answers provided';
        echo json_encode($response);
        exit();
    }

    $data = isset($_POST['data']) ? $_POST['data'] : '';
    if (empty($data)) {
        $response['message'] = 'No data provided';
        echo json_encode($response);
        exit();
    }

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
    $encryptedQuery = $data;
    $decryptedQuery = decryptData($encryptedQuery, $secretkey);
    parse_str($decryptedQuery, $params);

    $id = isset($params['id']) ? $params['id'] : null;
    $username = isset($params['username']) ? $params['username'] : null;
    $kelas = isset($params['kelas']) ? $params['kelas'] : null;
    $fullname = isset($params['fullname']) ? $params['fullname'] : null;

    if (!$id || !$username || !$kelas || !$fullname) {
        $response['message'] = 'Missing required parameters';
        echo json_encode($response);
        exit();
    }

    $check_stmt = $conn->prepare("SELECT * FROM `$kelas` WHERE id = ? AND username = ?");
    $check_stmt->bind_param("is", $id, $username);
    $check_stmt->execute();
    $check_stmt->store_result();

    function encryptData($data, $key)
    {
        $cipher = "AES-256-CBC";
        $ivLength = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivLength);

        $encrypted = openssl_encrypt($data, $cipher, $key, 0, $iv);
        return base64_encode($iv . $encrypted);
    }

    $queryString = "id=$id&username=$username&kelas=$kelas&fullname=$fullname";
    $encryptedQuery = encryptData($queryString, $secretkey);
    $encryptedUrl = urlencode($encryptedQuery);

    if ($check_stmt->num_rows > 0) {
        $stmt = $conn->prepare("UPDATE `$kelas` SET kelaspmt = ? WHERE id = ? AND username = ?");
        $stmt->bind_param("sis", $answers, $id, $username);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['kelaspmt'] = $answers;
            $response['url'] = $encryptedUrl;
            echo json_encode($response);
            exit();
        } else {
            $response['message'] = 'Failed to update data';
        }
    } else {
        $response['message'] = 'No records found';
    }

    $check_stmt->close();
    if (isset($stmt)) {
        $stmt->close();
    }
    $conn->close();
} else {
    $response['message'] = 'Invalid request method';
}
$jsonResponse = json_encode($response);
if ($jsonResponse === false) {
    $response['message'] = 'JSON encoding failed: ' . json_last_error_msg();
    echo json_encode($response);
    exit();
}

echo $jsonResponse;

exit();
?>