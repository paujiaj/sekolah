<?php
$sql = "SELECT mapelId, mapel, guru, ppguru FROM `$kelaswajib`";
$result2 = $conn->query($sql);

if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        if (empty($row['ppguru'])) {
            $row['ppguru'] = '../includes/img/icon/profile.png';
        }
        echo '
            <li class="dropdown-li" id="' . $row['mapelId'] . '">
                <a href="subkelas.php?subkelas=' . $row['mapelId'] . '&data=' . $encryptedUrl . '" class="single-nav">
                    <div class="icon">
                        <img src="../' . $row['ppguru'] . '" alt="">
                    </div>
                    <div class="mapel">
                        <p>' . strtoupper($row['mapelId']) . '</p>
                    </div>
                </a>
            </li>
            ';
    }
} else {
    echo "No records found.";
}
$conn->close();
?>