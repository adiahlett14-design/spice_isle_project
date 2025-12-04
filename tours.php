<?php
require __DIR__.'/includes/db.php';
require __DIR__.'/includes/auth.php';
$pageTitle='Grenada Tours';
require __DIR__.'/includes/header.php';

$tours = $pdo->query("SELECT * FROM tours ORDER BY title ASC")->fetchAll();
?>

<h1>Grenada Tours</h1>

<?php foreach($tours as $t): ?>
<div class="card" style="display:flex; gap:15px;">
    <img src="images/tours/<?= htmlspecialchars($t['image']) ?>" style="width:180px;height:130px;object-fit:cover;border-radius:8px;">
    <div style="flex:1;">
        <h2><?= htmlspecialchars($t['title']) ?></h2>
        <p><?= htmlspecialchars($t['description']) ?></p>
        <p>
            <strong>Cost:</strong> $<?= htmlspecialchars($t['price']) ?> |
            <strong>Date:</strong> <?= htmlspecialchars($t['date']) ?> |
            <strong>Time:</strong> <?= htmlspecialchars($t['time']) ?><br>
            <strong>Location:</strong> <?= htmlspecialchars($t['location']) ?><br>
            <strong>Transport:</strong> <?= htmlspecialchars($t['transportation']) ?><br>
        </p>
        <a href="tour_details.php?id=<?= $t['id'] ?>" class="btn">View</a>
    </div>
</div>
<?php endforeach; ?>

<?php require __DIR__.'/includes/footer.php'; ?>
