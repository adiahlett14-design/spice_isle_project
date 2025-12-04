<?php
session_start();

// Redirect to login if user not logged in
if (empty($_SESSION['user_id'])) {
    $current = $_SERVER['REQUEST_URI'];
    header('Location: /spice_isle/login.php?next=' . urlencode($current));
    exit;
}
?>
