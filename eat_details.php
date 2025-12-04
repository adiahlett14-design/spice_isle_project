<?php
require __DIR__.'/includes/db.php';
require __DIR__.'/includes/auth.php';
$pageTitle='Restaurant Details';
require __DIR__.'/includes/header.php';

// Get eat ID from URL
$eat_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($eat_id <= 0) {
    echo "<p style='text-align:center;color:red;'>Invalid restaurant ID.</p>";
    require __DIR__.'/includes/footer.php';
    exit;
}

// Fetch eat details
$stmt = $pdo->prepare("SELECT * FROM eats WHERE id = ?");
$stmt->execute([$eat_id]);
$e = $stmt->fetch();

if (!$e) {
    echo "<p style='text-align:center;color:red;'>Restaurant not found.</p>";
    require __DIR__.'/includes/footer.php';
    exit;
}
?>

<h1 style="text-align:center;margin:20px 0;"><?=htmlspecialchars($e['title'])?></h1>

<div style="background:#fff;margin:20px auto;padding:20px;border-radius:8px;max-width:900px;
     box-shadow:0 2px 8px rgba(0,0,0,0.1);">

    <img src="images/<?=htmlspecialchars($e['image'])?>" 
         style="width:100%;max-height:400px;object-fit:cover;border-radius:8px;margin-bottom:15px;">

    <p><?=htmlspecialchars($e['description'])?></p>

    <p>
        <strong>Price Range:</strong> <?=htmlspecialchars($e['price'])?><br>
        <strong>Location:</strong> <?=htmlspecialchars($e['location'])?><br>
        <strong>Hours:</strong> <?=htmlspecialchars($e['hours'])?><br>
        <strong>Category:</strong> <?=htmlspecialchars($e['category'])?><br>
    </p>

    <a href="eats.php" 
       style="padding:8px 12px;background:#1e88e5;color:#fff;border-radius:5px;text-decoration:none;">
       Back to Eats
    </a>
</div>

<?php require __DIR__.'/includes/footer.php'; ?>
