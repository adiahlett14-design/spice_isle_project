<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($pageTitle ?? 'Spice Isle Tours') ?></title>
    <link rel="stylesheet" href="/spice_isle/css/style.css">
    <script src="/spice_isle/js/main.js" defer></script>
</head>
<body>
<?php if (!empty($_SESSION['user_id'])): ?>
    <p class="logged-in">
        Logged in as <?= htmlspecialchars($_SESSION['username']) ?> | 
        <a href="/spice_isle/logout.php">Logout</a>
    </p>
<?php endif; ?>
<hr>
