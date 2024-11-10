<?php
// Database connection
include "../../../includes/ess/session.php";
include "../../../includes/ess/conn.php";

$data = isset($_POST['data']) ? $_POST['data'] : '';
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
// Get POST data
$usernameValue = isset($_POST['username']) ? $_POST['username'] : '';
$mapelValue = isset($_POST['mapel']) ? $_POST['mapel'] : '';
$id = $params['id'];
$kelas = $params['kelas'];

$valuesArray = explode(", ", $mapelValue);

foreach ($valuesArray as $value) {
    $value = trim($value);
    $map = [
        "fis" => "fisika",
        "eko" => "ekonomi",
        "kim" => "kimia",
        "engTL" => "english TL",
        "matTL" => "matematika TL",
        "bio" => "biologi",
        "jep" => "jepang",
        "sos" => "sosiologi",
        "inf" => "informatika",
        "kor" => "korea",
        "geo" => "geografi",
        "man" => "mandarin",
        "lit" => "literasi",
        "jer" => "jerman",

        "fisika" => "fis",
        "ekonomi" => "eko",
        "kimia" => "kim",
        "english TL" => "engTL",
        "inggris TL" => "engTL",
        "matematika TL" => "matTL",
        "biologi" => "bio",
        "jepang" => "jep",
        "sosiologi" => "sos",
        
    ];
    $reverseMap = array_flip($map);
    if (array_key_exists($value, $reverseMap)) {
        // Get the corresponding value from the mapping
        $mappedValue = $reverseMap[$value];
        $sqlMapel = "UPDATE `$kelas` SET mapel = '$mappedValue' WHERE id = $id";
        if ($conn->query($sqlMapel) === TRUE) {
            echo "Record updated successfully for mapel";
        } else {
            echo "Error updating mapel: " . $conn->error;
        }
    } else {
        echo "<script>alert('check lagi')</script>";
    }
}



if ($id > 0 && !empty($mapelValue)) {
    $sql = "UPDATE `$kelas` SET username= '$usernameValue' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully for username: $usernameValue";
    } else {
        echo "Error updating record for username: $usernameValue - " . $conn->error;
    }
} else {
    echo "Invalid field or ID.";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $secretkey = $_SESSION['secretkey'];
    $encryptedQuery = $data;
    $decryptedQuery = decryptData($encryptedQuery, $secretkey);
    parse_str($decryptedQuery, $params);

    $id = $params['id'];
    $username = $params['username'];
    $kelasNoDash = $params['kelas'];
    $fullname = $params['fullname'];
    $kelas = str_replace('kelas__', '', $kelasNoDash);

    $stmt = $conn->prepare("SELECT * FROM `$kelasNoDash` WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();
    $stmt->close();

    $mapel = $item['mapel'];
    $kelaswajib = '11wajib';

    $targetDir = '../../../upload/' . $kelas . '/' . $username;

    if (!file_exists($targetDir)) {
        if (mkdir($targetDir, 0777, true)) {
            echo "Directory created successfully.<br>";
        } else {
            echo "Failed to create directory.<br>";
        }
    }

    $fileName = uniqid() . '_' . time() . '.' . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    $fileArray = glob("$targetDir/*");
    $fileId = $fileArray[0];
    $targetFilePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    $tempFile = $_FILES["image"]["tmp_name"];

    if (!empty($fileArray)) {
        echo "Existing file found: $fileId<br>";
        if (unlink($fileId)) {
            echo "Existing file removed.<br>";
        } else {
            echo "Failed to remove existing file.<br>";
        }
    } else {
        echo "No existing file found.<br>";
    }

    $targetFile = $targetDir . DIRECTORY_SEPARATOR . $fileName;

    // Check file type (optional)
    if (move_uploaded_file($tempFile, $targetFile)) {
        echo "File uploaded successfully.<br>";
        $imageURL = "../upload/$kelas/$username/$fileName";

        $sql = "UPDATE `$kelasNoDash` SET ppImg = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $imageURL, $id);
        $stmt->execute();

        $sql2 = "UPDATE `$kelaswajib` SET ppguru = ? WHERE mapelid = ?";
        $stmt = $conn->prepare($sql2);
        $stmt->bind_param("ss", $imageURL, $item['mapel']);
        $stmt->execute();
    }
}

$conn->close();
?>