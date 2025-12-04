<?php
require __DIR__.'/includes/db.php';
require __DIR__.'/includes/auth.php';
$pageTitle='Places to Eat';
require __DIR__.'/includes/header.php';

$eats = $pdo->query("SELECT * FROM eats ORDER BY title ASC")->fetchAll();
?>

<h1 style="text-align:center;margin:20px 0;">Places to Eat in Grenada</h1>

<?php foreach($eats as $e): ?>
<div style="background:#fff;margin:15px auto;padding:15px;border-radius:8px;max-width:850px;
     box-shadow:0 2px 8px rgba(0,0,0,0.1);display:flex;gap:15px;">

    <img src="images/<?=htmlspecialchars($e['image'])?>" 

         style="width:180px;height:130px;object-fit:cover;border-radius:8px;">

    <div style="flex:1;">
        <h2><?=htmlspecialchars($e['title'])?></h2>
        <p><?=htmlspecialchars($e['description'])?></p>

        <p>
            <strong>Price Range:</strong> <?=htmlspecialchars($e['price'])?><br>
            <strong>Location:</strong> <?=htmlspecialchars($e['location'])?><br>
            <strong>Hours:</strong> <?=htmlspecialchars($e['hours'])?><br>
            <strong>Category:</strong> <?=htmlspecialchars($e['category'])?><br>
        </p>

        <a href="eat_details.php?id=<?=$e['id']?>"
           style="padding:8px 12px;background:#1e88e5;color:#fff;border-radius:5px;text-decoration:none;">
           View
        </a>
    </div>
</div>
<?php endforeach; ?>

<?php require __DIR__.'/includes/footer.php'; ?>

