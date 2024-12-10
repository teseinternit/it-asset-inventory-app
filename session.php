<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['itteam_id']) || !isset($_SESSION['employee_id'])) {
    // Redirect to login page
    header("Location: login.php");
    exit();
}
?>