<link rel="stylesheet" href="css/style.css">

<?php
require __DIR__.'/includes/db.php';
require __DIR__.'/includes/auth.php';

$pageTitle = 'Grenada Tours';
require __DIR__.'/includes/header.php';

// Fetch tours from database but ignore the 'image' column
$tours = $pdo->query("SELECT * FROM tours ORDER BY title ASC")->fetchAll();
?>

<section class="tours-section">
    <h1>Grenada Tours</h1>
    <p style="text-align:center; max-width:700px; margin:0 auto 30px; color:#555;">
        Discover the best experiences Grenada has to offer. Choose from our curated tours and enjoy unforgettable moments on the Spice Isle.
    </p>

    <?php if(!$tours): ?>
        <p style="text-align:center; color:#d00;">No tours available at the moment. Please check back later.</p>
    <?php else: ?>
        <?php foreach($tours as $index => $t): ?>
            <div class="card">
                <!-- Manually assign images -->
                <?php
                $imageSrc = ($index % 2 === 0) ? 'images/img1.jpg' : 'images/img2.jpg';
                ?>
                <img src="<?= $imageSrc ?>" alt="<?= htmlspecialchars($t['title']) ?>">
                
                <h2><?= htmlspecialchars($t['title']) ?></h2>
                <p class="description"><?= htmlspecialchars($t['description']) ?></p>
                <p class="price">
                    <strong>Cost:</strong> $<?= $t['price'] ?><br>
                    <strong>Date:</strong> <?= $t['date'] ?> | <strong>Time:</strong> <?= $t['time'] ?>
                </p>
                <p>
                    <strong>Location:</strong> <?= htmlspecialchars($t['location']) ?><br>
                    <strong>Transport:</strong> <?= htmlspecialchars($t['transportation']) ?>
                </p>
                <a class="btn" href="tour_details.php?id=<?= $t['id'] ?>">View Details</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</section>

<?php require __DIR__.'/includes/footer.php'; ?>
