<?php
require __DIR__ . '/includes/db.php';
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$stmt = $pdo->prepare('SELECT * FROM tours WHERE id = ? LIMIT 1');
$stmt->execute([$id]);
$tour = $stmt->fetch();
if (!$tour) {
    header('HTTP/1.0 404 Not Found');
    $pageTitle = 'Tour not found';
    require __DIR__ . '/includes/header.php';
    echo '<h1>Tour not found</h1>';
    require __DIR__ . '/includes/footer.php';
    exit;
}
$pageTitle = htmlspecialchars($tour['title']) . ' - Spice Isle Tours';
require __DIR__ . '/includes/header.php';
?>
<section class="tour-detail">
  <h1><?= htmlspecialchars($tour['title']) ?></h1>
  <img src="<?= htmlspecialchars($tour['image']) ?>" alt="<?= htmlspecialchars($tour['title']) ?>">
  <p><?= nl2br(htmlspecialchars($tour['description'])) ?></p>
  <p>Duration: <?= htmlspecialchars($tour['duration_hours']) ?> hours</p>
  <p>Price: $<?= number_format($tour['price'],2) ?></p>
  <a class="btn" href="/booking.php?tour_id=<?= $tour['id'] ?>">Book Now</a>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
