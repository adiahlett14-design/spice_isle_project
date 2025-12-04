<?php
require __DIR__.'/includes/db.php';
require __DIR__.'/includes/auth.php';
$pageTitle='Places to Eat';
require __DIR__.'/includes/header.php';
?>

<link rel="stylesheet" href="css/style.css">

<h1>Places to Eat in Grenada</h1>

<?php
try {
    // Check if table exists first
    $stmt = $pdo->query("SHOW TABLES LIKE 'eats'");
    if ($stmt->rowCount() === 0) {
        echo "<p style='text-align:center;color:red;'>The 'eats' table does not exist in the database.</p>";
    } else {
        $eats = $pdo->query("SELECT * FROM eats ORDER BY title ASC")->fetchAll();
        if (!$eats) {
            echo "<p style='text-align:center;color:#555;'>No restaurants found.</p>";
        } else {
            foreach($eats as $e):
?>
<div class="eat-card" style="display:flex; gap:15px; align-items:flex-start;">
    <img src="images/<?= htmlspecialchars($e['image']) ?>" 
         style="width:180px;height:130px;object-fit:cover;border-radius:8px;">
    <div style="flex:1; text-align:left;">
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
<?php
            endforeach;
        }
    }
} catch (PDOException $ex) {
    echo "<p style='text-align:center;color:red;'>Database error: ".$ex->getMessage()."</p>";
}
?>

<?php require __DIR__.'/includes/footer.php'; ?>
