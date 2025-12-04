<?php
session_start();
require __DIR__ . '/includes/db.php';

$error = '';

if (!empty($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username && $password) {
        $stmt = $pdo->prepare('SELECT id, username, password_hash FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: index.php');
            exit;
        } else {
            $error = 'Invalid username or password.';
        }
    } else {
        $error = 'Please enter both username and password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login - Spice Isle</title>
<style>
body { font-family: Arial; background:#f0f0f0; display:flex; justify-content:center; align-items:center; height:100vh; }
.container { background:#fff; padding:20px 30px; border-radius:8px; box-shadow:0 0 10px rgba(0,0,0,0.1); width:300px; }
h2 { text-align:center; margin-bottom:20px; }
input, button { width:100%; padding:10px; margin:5px 0 15px; border-radius:4px; }
button { background:#28a745; color:#fff; border:none; cursor:pointer; }
button:hover { background:#218838; }
.error { color:red; margin-bottom:15px; }
</style>
</head>
<body>
<div class="container">
<h2>Login</h2>
<?php if($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<form method="POST">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit">Login</button>
</form>
<p>Don't have an account? <a href="register.php">Register here</a></p>
</div>
</body>
</html>
