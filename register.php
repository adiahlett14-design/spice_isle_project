<?php
session_start();
require __DIR__ . '/includes/db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm  = trim($_POST['confirm'] ?? '');

    if ($username && $password && $confirm) {
        if ($password !== $confirm) {
            $error = 'Passwords do not match.';
        } else {
            $stmt = $pdo->prepare('SELECT id FROM users WHERE username = ?');
            $stmt->execute([$username]);
            if ($stmt->fetch()) {
                $error = 'Username already taken.';
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare('INSERT INTO users (username, password_hash) VALUES (?, ?)');
                $stmt->execute([$username, $hash]);
                $success = 'Registration successful. You can now <a href="login.php">login</a>.';
            }
        }
    } else {
        $error = 'Please fill in all fields.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register - Spice Isle</title>
<style>
body { font-family: Arial; background:#f0f0f0; display:flex; justify-content:center; align-items:center; height:100vh; }
.container { background:#fff; padding:20px 30px; border-radius:8px; box-shadow:0 0 10px rgba(0,0,0,0.1); width:300px; }
h2 { text-align:center; margin-bottom:20px; }
input, button { width:100%; padding:10px; margin:5px 0 15px; border-radius:4px; }
button { background:#007bff; color:#fff; border:none; cursor:pointer; }
button:hover { background:#0069d9; }
.error { color:red; margin-bottom:15px; }
.success { color:green; margin-bottom:15px; }
</style>
</head>
<body>
<div class="container">
<h2>Register</h2>
<?php if($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<?php if($success): ?><div class="success"><?= $success ?></div><?php endif; ?>
<form method="POST">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<input type="password" name="confirm" placeholder="Confirm Password" required>
<button type="submit">Register</button>
</form>
<p>Already have an account? <a href="login.php">Login here</a></p>
</div>
</body>
</html>
