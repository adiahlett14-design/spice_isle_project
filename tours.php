<?php
require __DIR__.'/includes/db.php';
require __DIR__.'/includes/auth.php';
$pageTitle='Tours';
require __DIR__.'/includes/header.php';

$tours=$pdo->query("SELECT * FROM tours ORDER BY title ASC")->fetchAll();
?>

<h1 style="text-align:center;margin:20px 0;">Grenada Tours</h1>

<?php foreach($tours as $t): ?>
<div style="background:#fff;margin:15px auto;padding:15px;border-radius:8px;max-width:850px;
     box-shadow:0 2px 8px rgba(0,0,0,0.1);display:flex;gap:15px;">

    <img src="images/<?=htmlspecialchars($t['image'])?>" 
         style="width:180px;height:130px;object-fit:cover;border-radius:8px;">

    <div style="flex:1;">
        <h2><?=htmlspecialchars($t['title'])?></h2>
        <p><?=htmlspecialchars($t['description'])?></p>

        <p>
            <strong>Cost:</strong> $<?=$t['price']?> |
            <strong>Date:</strong> <?=$t['date']?> |
            <strong>Time:</strong> <?=$t['time']?><br>
            <strong>Location:</strong> <?=htmlspecialchars($t['location'])?><br>
            <strong>Transport:</strong> <?=htmlspecialchars($t['transportation'])?><br>
        </p>

        <a href="tour_details.php?id=<?=$t['id']?>"
           style="padding:8px 12px;background:#1e88e5;color:#fff;border-radius:5px;text-decoration:none;">
           View
        </a>
    </div>
</div>
<?php endforeach; ?>

<?php require __DIR__.'/includes/footer.php'; ?>
