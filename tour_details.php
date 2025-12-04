<?php
require __DIR__.'/includes/db.php';
require __DIR__.'/includes/auth.php';
$pageTitle='Tour Details';
require __DIR__.'/includes/header.php';

// Get tour ID from URL
$tour_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($tour_id <= 0) {
    echo "<p style='text-align:center;color:red;'>Invalid tour ID.</p>";
    require __DIR__.'/includes/footer.php';
    exit;
}

// Fetch tour details
$stmt = $pdo->prepare("SELECT * FROM tours WHERE id = ?");
$stmt->execute([$tour_id]);
$t = $stmt->fetch();

if (!$t) {
    echo "<p style='text-align:center;color:red;'>Tour not found.</p>";
    require __DIR__.'/includes/footer.php';
    exit;
}
?>

<h1 style="text-align:center;margin:20px 0;"><?=htmlspecialchars($t['title'])?></h1>

<div style="background:#fff;margin:20px auto;padding:20px;border-radius:8px;max-width:900px;
     box-shadow:0 2px 8px rgba(0,0,0,0.1);">

    <img src="images/<?=htmlspecialchars($t['imag'])?>" 
         style="width:100%;max-height:400px;object-fit:cover;border-radius:8px;margin-bottom:15px;">

    <p><?=htmlspecialchars($t['description'])?></p>

    <p>
        <strong>Cost:</strong> $<?=$t['price']?><br>
        <strong>Date:</strong> <?=$t['date']?><br>
        <strong>Time:</strong> <?=$t['time']?><br>
        <strong>Location:</strong> <?=htmlspecialchars($t['location'])?><br>
        <strong>Transport:</strong> <?=htmlspecialchars($t['transportation'])?><br>
    </p>

    <a href="tours.php" 
       style="padding:8px 12px;background:#1e88e5;color:#fff;border-radius:5px;text-decoration:none;">
       Back to Tours
    </a>
</div>

<?php require __DIR__.'/includes/footer.php'; ?>
