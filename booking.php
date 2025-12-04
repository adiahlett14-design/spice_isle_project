<?php
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/auth.php';

$tour_id = isset($_GET['tour_id']) ? (int)$_GET['tour_id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM tours WHERE id=?");
$stmt->execute([$tour_id]);
$tour = $stmt->fetch();

if (!$tour) {
    header("Location: tours.php");
    exit;
}

$error = $success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_date = trim($_POST['booking_date'] ?? '');
    $guests = max(1, (int)($_POST['guests'] ?? 1));

    if (!$booking_date) {
        $error = "Please select a booking date.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO bookings (user_id, tour_id, booking_date, guests) VALUES (?,?,?,?)");
        $stmt->execute([$_SESSION['user_id'], $tour_id, $booking_date, $guests]);
        $success = "Booking submitted! Status: Pending approval.";
    }
}

$pageTitle = "Book - " . $tour['title'];
require __DIR__ . "/includes/header.php";
?>

<div class="form-box">
    <h1>Book: <?= htmlspecialchars($tour['title']) ?></h1>
    <?php if (!empty($tour['image'])): ?>
        <img src="images/tours/<?= htmlspecialchars($tour['image']) ?>" alt="<?= htmlspecialchars($tour['title']) ?>">
    <?php endif; ?>
    <p><strong>Price:</strong> $<?= htmlspecialchars($tour['price']) ?></p>

    <?php if($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <?php if($success): ?><p class="success"><?= htmlspecialchars($success) ?></p><?php endif; ?>

    <form method="post">
        <label>Date</label>
        <input type="date" name="booking_date" required>

        <label>Guests</label>
        <input type="number" name="guests" value="1" min="1" required>

        <button type="submit">Confirm Booking</button>
    </form>
</div>

<?php require __DIR__ . "/includes/footer.php"; ?>
