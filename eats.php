<?php
require __DIR__.'/includes/db.php';
require __DIR__.'/includes/auth.php';
$pageTitle='Places to Eat';
require __DIR__.'/includes/header.php';

$eats = $pdo->query("SELECT * FROM eats ORDER BY title ASC")->fetchAll();
?>

<h1>Places to Eat in Grenada</h1>

<?php foreach($eats as $e): ?>
<div class="eat-card" style="display:flex; gap:15px;">
    <img src="images/<?= htmlspecialchars($e['image']) ?>" style="width:180px;height:130px;object-fit:cover;">
    <div style="flex:1;">
        <h2><?= htmlspecialchars($e['title']) ?></h2>
        <p><?= htmlspecialchars($e['description']) ?></p>
        <p>
            <strong>Price Range:</strong> <?= htmlspecialchars($e['price']) ?><br>
            <strong>Location:</strong> <?= htmlspecialchars($e['location']) ?><br>
            <strong>Hours:</strong> <?= htmlspecialchars($e['hours']) ?><br>
            <strong>Category:</strong> <?= htmlspecialchars($e['category']) ?><br>
        </p>
        <a href="eat_details.php?id=<?= $e['id'] ?>" class="btn">View</a>
    </div>
</div>
<?php endforeach; ?>

<?php require __DIR__.'/includes/footer.php'; ?>
