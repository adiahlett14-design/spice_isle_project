<link rel="stylesheet" href="css/style.css">
<?php
require __DIR__.'/includes/db.php';
require __DIR__.'/includes/auth.php';

$pageTitle = 'Grenada Tours';
require __DIR__.'/includes/header.php';

$tours=$pdo->query("SELECT * FROM tours ORDER BY title ASC")->fetchAll();
?>

<h1>Grenada Tours</h1>

<?php foreach($tours as $t): ?>
<div class="card">
    <img src="images/img1.jpg">
    <h2><?= htmlspecialchars($t['title']) ?></h2>
    <p class="description"><?= htmlspecialchars($t['description']) ?></p>
    <p class="price"><strong>Cost:</strong> $<?= $t['price'] ?> | <strong>Date:</strong> <?= $t['date'] ?> | <strong>Time:</strong> <?= $t['time'] ?></p>
    <p><strong>Location:</strong> <?= htmlspecialchars($t['location']) ?> | <strong>Transport:</strong> <?= htmlspecialchars($t['transportation']) ?></p>
    <a class="btn" href="tour_details.php?id=<?= $t['id'] ?>">View</a>
</div>
<?php endforeach; ?>

<?php require __DIR__.'/includes/footer.php'; ?>
