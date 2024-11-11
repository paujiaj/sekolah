<?php
session_start();

if (isset($_POST['logout'])) {
    // Destroy the session
    session_unset();
    session_destroy();

    setcookie(session_name(), '', time() - 3600, '/');
    
    // Redirect to login page
    header('Location: ../../../login/login.php');
    exit;
}
?>