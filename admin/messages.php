<?php
require __DIR__ . '/../includes/db.php';
session_start();
if (empty($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') { header('Location: /login.php'); exit; }

if (isset($_GET['mark']) && is_numeric($_GET['mark'])) {
  $m = (int)$_GET['mark'];
  $pdo->prepare('UPDATE messages SET status = ? WHERE id = ?')->execute(['read', $m]);
  header('Location: /admin/messages.php'); exit;
}

$stmt = $pdo->query('SELECT * FROM messages ORDER BY created_at DESC');
$messages = $stmt->fetchAll();

require __DIR__ . '/../includes/header.php';
?>
<section>
  <h1>Messages</h1>
  <?php if(empty($messages)): ?><p>No messages.</p><?php else: ?>
    <table class="table">
      <thead><tr><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Status</th><th>Action</th></tr></thead>
      <tbody>
        <?php foreach($messages as $m): ?>
          <tr>
            <td><?= htmlspecialchars($m['name']) ?></td>
            <td><?= htmlspecialchars($m['email']) ?></td>
            <td><?= htmlspecialchars($m['subject']) ?></td>
            <td><?= nl2br(htmlspecialchars(substr($m['message'],0,200))) ?></td>
            <td><?= htmlspecialchars($m['status']) ?></td>
            <td>
              <?php if($m['status'] === 'new'): ?>
                <a href="/admin/messages.php?mark=<?= $m['id'] ?>">Mark as read</a>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
