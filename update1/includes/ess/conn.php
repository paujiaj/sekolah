<?php
    // Database connection parameters
    $host = 'localhost';
    $db = 'sekolah3';
    $user = 'root';
    $pass = '';

    // Connect to the database
    $conn = new mysqli($host, $user, $pass, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>