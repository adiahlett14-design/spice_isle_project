<?php
session_start();
require __DIR__ . '/includes/db.php';

// Redirect if not logged in
if (empty($_SESSION['user_id'])) {
    header('Location: login.php?next=' . urlencode($_SERVER['REQUEST_URI']));
    exit;
}

// Get tour ID from URL
$tour_id = isset($_GET['tour_id']) ? (int)$_GET['tour_id'] : 0;

// Fetch tour details
$stmt = $pdo->prepare("SELECT * FROM tours WHERE id=?");
$stmt->execute([$tour_id]);
$tour = $stmt->fetch();

if (!$tour) {
    header("Location: tours.php");
    exit;
}

$error = $success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_date = trim($_POST['booking_date'] ?? '');
    $guests = max(1, (int)($_POST['guests'] ?? 1));

    if (!$booking_date) {
        $error = "Please select a booking date.";
    } else {
        $q = $pdo->prepare("INSERT INTO bookings (user_id, tour_id, booking_date, guests) VALUES (?,?,?,?)");
        $q->execute([$_SESSION['user_id'], $tour_id, $booking_date, $guests]);
        $success = "Booking submitted! Status: Pending approval.";
    }
}

$pageTitle = "Book - " . $tour['title'];
require __DIR__ . "/includes/header.php";
?>

<style>
.form-box {
    max-width: 550px;
    margin: 20px auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    text-align: center;
}
.form-box input, .form-box button {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    box-sizing: border-box;
}
.form-box img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 15px;
}
.error {
    color: #d00;
    font-weight: bold;
}
.success {
    color: #28a745;
    font-weight: bold;
}
</style>

<div class="form-box">
    <h1>Book: <?= htmlspecialchars($tour['title']) ?></h1>

    <?php if (!empty($tour['image'])): ?>
        <img src="images/tours/<?= htmlspecialchars($tour['image']) ?>" 
             alt="<?= htmlspecialchars($tour['title']) ?>">
    <?php endif; ?>

    <p><strong>Price:</strong> $<?= htmlspecialchars($tour['fee']) ?></p>

    <?php if($error): ?><p class="error"><?= $error ?></p><?php endif; ?>
    <?php if($success): ?><p class="success"><?= $success ?></p><?php endif; ?>

    <form method="post">
        <label>Date</label>
        <input type="date" name="booking_date" required>

        <label>Guests</label>
        <input type="number" name="guests" value="1" min="1" required>

        <button type="submit" style="background:#1e88e5;color:#fff;border:none;">
            Confirm Booking
        </button>
    </form>
</div>

<?php require __DIR__ . "/includes/footer.php"; ?>

