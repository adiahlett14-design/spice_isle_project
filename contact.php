<link rel="stylesheet" href="css/style.css">

<?php
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/auth.php';

$pageTitle = 'Contact & Booking - Spice Isle Tours';
require __DIR__ . '/includes/header.php';

$errorMsg = $successMsg = '';
$bookingError = $bookingSuccess = '';
$tour = null;

// Handle booking if a tour_id is provided
$tour_id = isset($_GET['tour_id']) ? (int)$_GET['tour_id'] : 0;
if ($tour_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM tours WHERE id=?");
    $stmt->execute([$tour_id]);
    $tour = $stmt->fetch();
}

// Process form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if it's a booking form submission
    if (isset($_POST['booking_date'])) {
        $booking_date = trim($_POST['booking_date'] ?? '');
        $guests = max(1, (int)($_POST['guests'] ?? 1));

        if (!$booking_date) {
            $bookingError = "Please select a booking date.";
        } else {
            $stmt = $pdo->prepare("INSERT INTO bookings (user_id, tour_id, booking_date, guests) VALUES (?,?,?,?)");
            $stmt->execute([$_SESSION['user_id'], $tour_id, $booking_date, $guests]);
            $bookingSuccess = "Booking submitted! Status: Pending approval.";
        }

    // Otherwise process the contact form
    } else {
        $name = trim($_POST['name'] ?? '');
        $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
        $subject = trim($_POST['subject'] ?? '');
        $message = trim($_POST['message'] ?? '');

        if (!$name || !$email || !$message) {
            $errorMsg = 'Please fill the required fields.';
        } else {
            $stmt = $pdo->prepare('INSERT INTO messages (name,email,subject,message) VALUES (?,?,?,?)');
            $stmt->execute([$name, $email, $subject, $message]);
            $successMsg = 'Message sent. Thank you!';
        }
    }
}
?>

<section class="form-box">
    <h1>Contact Us</h1>
    <?php if($errorMsg): ?><p class="error"><?= htmlspecialchars($errorMsg) ?></p><?php endif; ?>
    <?php if($successMsg): ?><p class="success"><?= htmlspecialchars($successMsg) ?></p><?php endif; ?>

    <form method="post">
        <label for="name">Name</label>
        <input id="name" name="name" placeholder="Enter your full name" required>

        <label for="email">Email</label>
        <input id="email" name="email" type="email" placeholder="Enter your email address" required>

        <label for="subject">Subject</label>
        <input id="subject" name="subject" placeholder="Subject of your message">

        <label for="message">Message</label>
        <textarea id="message" name="message" rows="6" placeholder="Type your message here..." required></textarea>

        <button type="submit">Send</button>
    </form>
</section>

<?php if($tour): ?>
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

    <?php if($bookingError): ?><p class="error"><?= htmlspecialchars($bookingError) ?></p><?php endif; ?>
    <?php if($bookingSuccess): ?><p class="success"><?= htmlspecialchars($bookingSuccess) ?></p><?php endif; ?>

    <form method="post">
        <label for="booking_date">Select Date</label>
        <input type="date" id="booking_date" name="booking_date" placeholder="Choose your preferred date" required>

        <label for="guests">Number of Guests</label>
        <input type="number" id="guests" name="guests" value="1" min="1" placeholder="Enter number of guests" required>

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
<?php endif; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
