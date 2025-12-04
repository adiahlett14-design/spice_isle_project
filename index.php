<?php
session_start();
require __DIR__ . '/includes/db.php';
if (empty($_SESSION['user_id'])) { 
    header('Location: login.php'); 
    exit; 
}
$username = $_SESSION['username'];
$pageTitle = 'Dashboard - Spice Isle Tours';
require __DIR__ . '/includes/header.php';
?>
<div class="card" style="background:url('https://img.freepik.com/premium-photo/beautiful-cliffs-with-golden-leaves-surround-large-waterfall-forest_501731-6806.jpg') no-repeat center/cover; color:#fff;">
    <div style="background:rgba(0,0,0,0.45); padding:60px;">
        <h2>Welcome, <?= htmlspecialchars($username) ?>!</h2>
        <p>Discover your next adventure in paradise.</p>
        <div class="links">
            <a href="tours.php">View Tours</a>
            <a href="booking.php">Booking</a>
            <a href="contact.php">Contact Us</a>
            <a href="eats.php">Places to Eat</a>
        </div>
    </div>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
