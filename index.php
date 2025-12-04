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

<style>
    /* Full-screen hero */
    .hero {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-image: url('images/hero_dashboard.jpg');
        background-size: cover;
        background-position: center;
        text-align: center;
        color: #fff;
        text-shadow: 1px 1px 5px rgba(0,0,0,0.7);
        padding: 20px;
    }

    .hero h1 {
        font-size: 3em;
        margin-bottom: 20px;
    }

    .hero p {
        font-size: 1.2em;
        margin-bottom: 40px;
        max-width: 700px;
    }

    .quick-links {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .quick-links .btn {
        padding: 18px 30px;
        font-size: 1.2em;
        border-radius: 10px;
        background-color: #1e88e5;
        color: #fff;
        transition: background 0.3s, transform 0.2s;
    }

    .quick-links .btn:hover {
        background-color: #1565c0;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .hero h1 {
            font-size: 2.2em;
        }

        .hero p {
            font-size: 1em;
        }

        .quick-links .btn {
            font-size: 1em;
            padding: 15px 25px;
        }
    }
</style>

<!-- FULL SCREEN HERO -->
<div class="hero">
    <h1>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
    <p>Ready to explore Grenada? Discover breathtaking tours, delicious local cuisine, and unforgettable experiences across the Spice Isle.</p>
    <div class="quick-links">
        <a href="tours.php" class="btn">View Tours</a>
        <a href="eats.php" class="btn">Places to Eat</a>
        <a href="contact.php" class="btn">Contact Us</a>
    </div>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>
