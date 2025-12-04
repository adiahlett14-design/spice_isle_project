<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($pageTitle ?? 'Spice Isle Tours') ?></title>
    <link rel="stylesheet" href="/spice_isle/css/style.css">
</head>
<body>
<div class="navbar">
    <div class="logo"><a href="index.php">Spice Isle</a></div>
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="tours.php">Tours</a>
        <a href="eats.php">Places to Eat</a>
        <a href="contact.php">Contact</a>
        <?php if(!empty($_SESSION['user_id'])): ?>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </div>
    <?php if(!empty($_SESSION['username'])): ?>
        <div class="logged-in">Logged in as: <?= htmlspecialchars($_SESSION['username']) ?></div>
    <?php endif; ?>
</div>
<hr>
