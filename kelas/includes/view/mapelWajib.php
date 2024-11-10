<?php
$sql = "SELECT mapelId, mapel, guru, ppguru FROM `$kelaswajib`";
$result2 = $conn->query($sql);

$counter = 0;

if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $boxClass = ($counter < 5) ? 'single-box a' : 'single-box b';
        if (empty($row['ppguru'])) {
            $row['ppguru'] = '../includes/img/icon/profile.png';
        }
        echo '
            <div class="' . $boxClass . '">
                <a href="subkelas/subkelas.php?subkelas=' . $row['mapelId'] . '&data=' . $encryptedUrl . '">
                    <div class="image-box">
                        <img class="mapelImg" src="public/img/' . $row['mapelId'] . '.png" alt="">
                    </div>
                </a>
                <div class="mapel">
                    <a href="subkelas/subkelas.php?subkelas=' . $row['mapelId'] . '&data=' . $encryptedUrl . '">' . $row['mapel'] . '</a>
                </div>
                <div class="pppic">
                    <img src="' . $row['ppguru'] . '" alt="">
                </div>
            </div>
            ';
            $counter++;
    }
} else {
    echo "No records found.";
}
$conn->close();
?>