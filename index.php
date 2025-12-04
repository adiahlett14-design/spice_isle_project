<?php
session_start();
require __DIR__ . '/includes/db.php';

if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$pageTitle = 'Dashboard - Spice Isle';
require __DIR__ . '/includes/header.php';
?>
<link rel="stylesheet" href="css/style.css">
<div class="container">
    <h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
    <p>Discover your next adventure in paradise.</p>
    <div class="links">
        <a href="tours.php" class="btn">View Tours</a>
        <a href="booking.php" class="btn">Booking</a>
        <a href="contact.php" class="btn">Contact Us</a>
        <a href="eats.php" class="btn">Places to Eat</a>
    </div>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>
