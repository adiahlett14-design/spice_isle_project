<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($pageTitle ?? 'Spice Isle Tours') ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .error { color: red; }
        .success { color: green; }
        .login-section, .dashboard-section, .tours-section { max-width: 600px; margin: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        input, button { padding: 8px; margin: 5px 0; width: 100%; }
        button { cursor: pointer; }
    </style>
</head>
<body>
<?php if (!empty($_SESSION['user_id'])): ?>
    <p>Logged in as user ID: <?= $_SESSION['user_id'] ?> | <a href="/spice_isle/logout.php">Logout</a></p>
<?php endif; ?>
<hr>
