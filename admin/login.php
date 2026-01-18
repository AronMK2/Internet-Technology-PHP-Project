<?php
session_start();
if (!empty($_SESSION['admin'])) {
    header('Location: index.php');
    exit;
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    if ($user === 'admin' && $pass === 'admin') {
        $_SESSION['admin'] = true;
        header('Location: index.php');
        exit;
    }

    $error = 'Hibás felhasználónév vagy jelszó.';
}
?>
<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin bejelentkezés | PhoneX</title>
    <link rel="stylesheet" href="../admin.css">
    <style>
        .login-wrap { max-width: 420px; margin: 60px auto; }
        .login-card { padding: 24px 24px 18px; }
        .login-card h2 { margin-top: 0; margin-bottom: 12px; text-align: center; }
        .login-card form { display: flex; flex-direction: column; gap: 10px; }
        .login-card .btn { width: 100%; margin-top: 4px; }
        .login-actions { margin-top: 12px; text-align: center; }
        .login-actions a { color: #4fd1c5; text-decoration: none; font-weight: 700; }
        .login-actions a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <header>
        <div class="brand"><span>PhoneX</span></div>
    </header>
    <main class="login-wrap">
        <section class="card login-card">
            <h2>Bejelentkezés</h2>
            <?php if ($error): ?><div class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
            <form method="post">
                <label>Felhasználónév</label>
                <input type="text" name="username" required>
                <label>Jelszó</label>
                <input type="password" name="password" required>
                <button class="btn" type="submit">Belépés</button>
            </form>
            <div class="login-actions">
                <a href="../index.php">Vissza a főoldalra</a>
            </div>
        </section>
    </main>
</body>
</html>
