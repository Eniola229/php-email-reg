<?php
session_start();

// Check if the user is not authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    $_SESSION['status'] = "Invalid Attempt | Kindly Login to access Dashboard";
    header("Location: login.php");
    exit();
}
?>
