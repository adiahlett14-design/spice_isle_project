<?php
require __DIR__.'/includes/db.php';
require __DIR__.'/includes/auth.php';
$pageTitle='Restaurant Details';
require __DIR__.'/includes/header.php';

$eat_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($eat_id <= 0) {
    echo "<p class='error'>Invalid restaurant ID.</p>";
    require __DIR__.'/includes/footer.php';
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM eats WHERE id = ?");
$stmt->execute([$eat_id]);
$e = $stmt->fetch();
if (!$e) {
    echo "<p class='error'>Restaurant not found.</p>";
    require __DIR__.'/includes/footer.php';
    exit;
}
?>

<h1><?= htmlspecialchars($e['title']) ?></h1>

<div class="card">
    <?php if (!empty($e['image'])): ?>
        <img src="images/<?= htmlspecialchars($e['image']) ?>" alt="<?= htmlspecialchars($e['title']) ?>">
    <?php endif; ?>
    <p><?= htmlspecialchars($e['description']) ?></p>
    <p>
        <strong>Price Range:</strong> <?= htmlspecialchars($e['price']) ?><br>
        <strong>Location:</strong> <?= htmlspecialchars($e['location']) ?><br>
        <strong>Hours:</strong> <?= htmlspecialchars($e['hours']) ?><br>
        <strong>Category:</strong> <?= htmlspecialchars($e['category']) ?><br>
    </p>
    <a href="eats.php" class="btn">Back to Eats</a>
</div>

<?php require __DIR__.'/includes/footer.php'; ?>
