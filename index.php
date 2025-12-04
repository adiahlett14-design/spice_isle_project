<?php
session_start();
require __DIR__ . '/includes/db.php';
if (empty($_SESSION['user_id'])) { header('Location: login.php'); exit; }
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard - Spice Isle</title>
<style>
body{
    margin:0;font-family:Arial;
    background:url('https://img.freepik.com/premium-photo/beautiful-cliffs-with-golden-leaves-surround-large-waterfall-forest_501731-6806.jpg') no-repeat center/cover;
}
.overlay{background:rgba(0,0,0,0.45);min-height:100vh;}
.navbar{background:rgba(0,0,0,0.6);padding:12px 20px;display:flex;justify-content:space-between;}
.navbar a{color:#fff;text-decoration:none;margin:0 10px;font-weight:bold;}
.container{text-align:center;color:#fff;padding:60px;}
.links a{
    display:inline-block;margin:8px;padding:10px 15px;
    background:rgba(255,255,255,0.2);color:#fff;
    text-decoration:none;border-radius:6px;backdrop-filter:blur(3px);
}
</style>
</head>
<body>
<div class="overlay">

<div class="navbar">
    <div><a href="index.php">Spice Isle</a></div>
    <div>
    
        <a href="tours.php">Tours</a>
        <a href="booking.php">Booking</a>
        <a href="eats.php">Eats</a>
        <a href="contact.php">Contact</a>
        <a href="about.php">About</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <h2>Welcome, <?= htmlspecialchars($username) ?>!</h2>
    <p>Discover your next adventure in paradise. </p>
    <div class="links">
        <a href="tours.php">View Tours</a>
        <a href="booking.php">Booking</a>
        <a href="contact.php">Contact Us</a>
        <a href="eats.php">Places to Eat</a>
    </div>
</div>

</div>
</body>
</html>
