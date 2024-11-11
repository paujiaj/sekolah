<?php
// Include your database connection file
include "../includes/ess/conn.php";

if (isset($_GET['data'])) {
    $id = $params['id'];
    $username = $params['username'];
    $kelasNoDash = $params['kelas'];
    $fullname = $params['fullname'];

    $angkatan = substr($kelasNoDash, 0, -1);

    $stmt = $conn->prepare("SELECT * FROM `$kelasNoDash` WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();
    $stmt->close();

    if (!empty($item['kelaspmt'])) {
        $kelaspmt = $item['kelaspmt'];
        $kelas = str_replace('kelas__', '', $kelasNoDash);
        $angkatan = substr($kelas, 0, -1);
        $angkatanKelas = 'kelas__' . $angkatan;

        preg_match_all('/(\d[A-Z])/', $kelaspmt, $matches);

        // Prepare an array to hold the translated subjects
        $subjects = [];

        // Loop through each code, split it into number and letter, and query the database
        foreach ($matches[0] as $code) {
            // Separate the number and letter
            $id = intval($code[0]); // Extract the row (number part)
            $letter = $code[1]; // Extract the column (letter part)

            // Query the database to get the subject from the correct cell
            $sql = "SELECT `$letter` FROM `$angkatan` WHERE Number = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $id); // Bind the number to the row
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($subject);
            $stmt->fetch();

            if ($stmt->num_rows > 0) {
                // Add the subject to the array
                $subjects[] = $subject;
            }

            $stmt->close();
        }

        // Generate the HTML for each subject
        foreach ($subjects as $index => $subject) {
            // Apply different classes based on the position of the subject (first 3 -> 'a', last 3 -> 'b')
            $class = ($index < 5) ? 'a' : 'b';
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
            ];
            $subjectId = array_search($subject, $map);

            $sql = "SELECT ppImg FROM kelas__guru WHERE mapel = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $subjectId);
            $stmt->execute();
            $stmt->bind_result($ppguru);
            $stmt->fetch();
            $stmt->close();

            if (empty($ppguru)) {
                $ppguru = '../includes/img/icon/profile.png';
            }

            echo '
        <div class="single-box ' . $class . '">
            <a href="subkelas/subkelas.php?subkelas=' . $angkatanKelas . $subjectId . '&data=' . $encryptedUrl . '">
                <div class="image-box ' . $class . '">
                    <img class="mapelImg" src="public/img/' . strtolower($subject) . '.png" alt="">
                    <!--<img src="public/img/PAI.png" alt="">-->
                </div>
            </a>
            <div class="mapel">
                <a href="subkelas/subkelas.php?subkelas=' . $angkatanKelas . $subjectId . '&data=' . $encryptedUrl . '">' . $subject . '</a>
            </div>
            <div class="pppic">
                <img src="' . $ppguru . '" alt="">
            </div>
        </div>';
        }
    } else {
        echo "No data provided in the URL.";
    }

}




?>