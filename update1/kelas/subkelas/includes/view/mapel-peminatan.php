<?php
// Include your database connection file
include "../../includes/ess/conn.php";

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
                $subjects[] = $subject;
            }

            $stmt->close();
        }

        foreach ($subjects as $index => $subject) {
            echo "<script>console.log('$subject')</script>";
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

            echo "<script>console.log('$subjectId')</script>";

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

            echo "<script>console.log('$ppguru')</script>";

            echo '
                <li class="dropdown-li" id="' . $subjectId . '">
                    <a href="subkelas.php?subkelas=' . $subjectId . '&data=' . $encryptedUrl . '" class="single-nav">
                        <div class="icon">
                            <img src="../' . $ppguru . '" alt="">
                        </div>
                        <div class="mapel">
                            <p>' . strtoupper($subject) . '</p>
                        </div>
                    </a>
                </li>
            ';
        }
    } else {
        echo "No data provided in the URL.";
    }

}

?>