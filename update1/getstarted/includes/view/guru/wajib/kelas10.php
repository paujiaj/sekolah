<?php
if (isset($_GET['data'])) {
    $id = $params['id'];
    $username = $params['username'];
    $kelasNoDash = $params['kelas'];
    $kelas = str_replace("kelas__", "", $kelasNoDash);
    $angkatan = substr($kelas, 0, -1);
    $fullname = $params['fullname'];

    $sql = "SELECT * FROM `10wajib`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Loop through each row in the result
        while ($row = $result->fetch_assoc()) {
            // Generate a radio button for each row, with `mapelid` as the label
            echo '<li><input type="radio" name="10" value="10' . $row['mapelid'] . '">' . $row['mapelid'] . '</li>';
        }
    } else {
        echo "No records found.";
    }
}
?>