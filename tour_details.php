<?php
require __DIR__.'/includes/db.php';
require __DIR__.'/includes/auth.php';
$pageTitle='Tour Details';
require __DIR__.'/includes/header.php';

$tour_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($tour_id <= 0) {
    echo "<p class='error'>Invalid tour ID.</p>";
    require __DIR__.'/includes/footer.php';
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM tours WHERE id = ?");
$stmt->execute([$tour_id]);
$t = $stmt->fetch();
if (!$t) {
    echo "<p class='error'>Tour not found.</p>";
    require __DIR__.'/includes/footer.php';
    exit;
}
?>

<h1><?= htmlspecialchars($t['title']) ?></h1>

<div class="card">
    <?php if (!empty($t['image'])): ?>
        <img src="images/tours/<?= htmlspecialchars($t['image']) ?>" alt="<?= htmlspecialchars($t['title']) ?>">
    <?php endif; ?>
    <p><?= htmlspecialchars($t['description']) ?></p>
    <p>
        <strong>Cost:</strong> $<?= htmlspecialchars($t['price']) ?><br>
        <strong>Date:</strong> <?= htmlspecialchars($t['date']) ?><br>
        <strong>Time:</strong> <?= htmlspecialchars($t['time']) ?><br>
        <strong>Location:</strong> <?= htmlspecialchars($t['location']) ?><br>
        <strong>Transport:</strong> <?= htmlspecialchars($t['transportation']) ?><br>
    </p>
    <a href="tours.php" class="btn">Back to Tours</a>
</div>

<?php require __DIR__.'/includes/footer.php'; ?>
