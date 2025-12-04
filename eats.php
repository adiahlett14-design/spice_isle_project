<link rel="stylesheet" href="css/style.css">

<?php
require __DIR__.'/includes/db.php';
require __DIR__.'/includes/auth.php';
$pageTitle='Places to Eat';
require __DIR__.'/includes/header.php';
?>

<section class="eats-section">
    <h1>Places to Eat in Grenada</h1>

    <p style="text-align:center; max-width:700px; margin:0 auto 30px; color:#555;">
        Grenada is not only famous for its beautiful beaches and lush rainforests, but also for its vibrant culinary scene. 
        From local spices to fresh seafood, there’s something for every taste. Explore our recommended restaurants and cafes across the island.
    </p>

    <h2 style="text-align:center; color:#1e88e5; margin-bottom:20px;">Top Dining Tips</h2>
    <ul style="max-width:700px; margin:0 auto 30px; color:#555; line-height:1.6;">
        <li>Try the local specialty dishes such as Oil Down, Callaloo soup, and fresh seafood.</li>
        <li>Visit early for breakfast or brunch to enjoy local pastries and coffee.</li>
        <li>Many restaurants offer outdoor seating with beautiful views – perfect for photos.</li>
        <li>Check the hours before visiting – some smaller eateries close early in the evening.</li>
        <li>Ask the staff for recommendations; locals know the best hidden gems.</li>
    </ul>

<?php
try {
    $stmt = $pdo->query("SHOW TABLES LIKE 'eats'");
    if ($stmt->rowCount() === 0) {
        echo "<p style='text-align:center;color:red;'>The 'eats' table does not exist in the database.</p>";
    } else {
        $eats = $pdo->query("SELECT * FROM eats ORDER BY title ASC")->fetchAll();
        if (!$eats) {
            echo "<p style='text-align:center;color:#555;'>No restaurants found.</p>";
        } else {
            foreach($eats as $index => $e):
                // Assign images manually
                $imageSrc = ($index % 2 === 0) ? 'images/img3.jpg' : 'images/img4.jpg';
?>
<div class="eat-card" style="display:flex; gap:15px; align-items:flex-start;">
    <img src="<?= $imageSrc ?>" 
         style="width:180px;height:130px;object-fit:cover;border-radius:8px;" 
         alt="<?= htmlspecialchars($e['title']) ?>">
    <div style="flex:1; text-align:left;">
        <h2><?= htmlspecialchars($e['title']) ?></h2>
        <p><?= htmlspecialchars($e['description']) ?></p>
        <p>
            <strong>Price Range:</strong> <?= htmlspecialchars($e['price']) ?><br>
            <strong>Location:</strong> <?= htmlspecialchars($e['location']) ?><br>
            <strong>Hours:</strong> <?= htmlspecialchars($e['hours']) ?><br>
            <strong>Category:</strong> <?= htmlspecialchars($e['category']) ?><br>
        </p>
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
</section>

<?php require __DIR__.'/includes/footer.php'; ?>
