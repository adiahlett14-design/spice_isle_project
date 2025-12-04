
<link rel="stylesheet" href="css/style.css">

<?php
require __DIR__ . '/includes/db.php';
$pageTitle = 'Contact - Spice Isle Tours';
require __DIR__ . '/includes/header.php';

$error = $success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (!$name || !$email || !$message) {
        $error = 'Please fill the required fields.';
    } else {
        $stmt = $pdo->prepare('INSERT INTO messages (name,email,subject,message) VALUES (?,?,?,?)');
        $stmt->execute([$name, $email, $subject, $message]);
        $success = 'Message sent. Thank you!';
    }
}
?>

<section class="form-box">
<h1>Contact Us</h1>
<?php if($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
<?php if($success): ?><p class="success"><?= htmlspecialchars($success) ?></p><?php endif; ?>

<form method="post">
<label for="name">Name</label>
<input id="name" name="name" required>

<label for="email">Email</label>
<input id="email" name="email" type="email" required>

<label for="subject">Subject</label>
<input id="subject" name="subject">

<label for="message">Message</label>
<textarea id="message" name="message" rows="6" required></textarea>

<button type="submit">Send</button>
</form>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
