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

<section class="form-box">
    <h1>Book Your Tour: <?= htmlspecialchars($tour['title']) ?></h1>

    <?php if (!empty($tour['image'])): ?>
        <img src="images/tours/<?= htmlspecialchars($tour['image']) ?>" alt="<?= htmlspecialchars($tour['title']) ?>">
    <?php endif; ?>

    <p style="text-align:center; max-width:700px; margin:0 auto 20px; color:#555;">
        Ready to explore the beauty of Grenada? Fill in your preferred date and number of guests below. 
        Our team will confirm your booking as soon as possible. Make sure to plan ahead to secure your spot!
    </p>

    <p><strong>Price per person:</strong> $<?= htmlspecialchars($tour['price']) ?></p>

    <?php if($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <?php if($success): ?><p class="success"><?= htmlspecialchars($success) ?></p><?php endif; ?>

    <form method="post">
        <label for="booking_date">Select Date</label>
        <input type="date" id="booking_date" name="booking_date" required>

        <label for="guests">Number of Guests</label>
        <input type="number" id="guests" name="guests" value="1" min="1" required>

        <button type="submit">Confirm Booking</button>
    </form>

    <h2 style="margin-top:30px; text-align:center; color:#1e88e5;">Booking Tips</h2>
    <ul style="max-width:700px; margin:10px auto; color:#555; line-height:1.6;">
        <li>Book at least 1–2 days in advance for popular tours.</li>
        <li>Double-check the date and number of guests before submitting.</li>
        <li>You will receive a confirmation once your booking is approved.</li>
        <li>Contact us if you need to make any changes to your booking.</li>
        <li>Bring comfortable shoes, sunscreen, and a camera for a great experience!</li>
    </ul>
</section>

<?php require __DIR__ . "/includes/footer.php"; ?>
