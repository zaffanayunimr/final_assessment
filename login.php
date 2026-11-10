<?php
require_once __DIR__ . '/auth.php';

if (!empty($_SESSION['logged_in'])) {
    header('Location: index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username !== '' && $password !== '') {
        session_regenerate_id(true);
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    }
    $error = 'Nama pengguna atau kata laluan tidak tepat.';
}
?>
<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Masuk | Student Grading System</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; display: grid; place-items: center; padding: 24px; font-family: Arial, sans-serif; color: #172033; background: linear-gradient(135deg, #e9f0ff, #f7f9fc); }
        .login-card { width: min(100%, 420px); padding: 40px; background: #fff; border-radius: 18px; box-shadow: 0 18px 50px #243b631a; }
        .brand { width: 48px; height: 48px; display: grid; place-items: center; border-radius: 14px; background: #3157d5; color: white; font-size: 23px; font-weight: 700; }
        h1 { margin: 22px 0 8px; font-size: 26px; }
        .subtitle { margin: 0 0 28px; color: #697386; line-height: 1.5; }
        label { display: block; margin: 18px 0 8px; font-size: 14px; font-weight: 600; }
        input { width: 100%; padding: 13px 14px; border: 1px solid #d8deea; border-radius: 9px; font: inherit; }
        input:focus { outline: 3px solid #3157d522; border-color: #3157d5; }
        button { width: 100%; margin-top: 24px; padding: 14px; border: 0; border-radius: 9px; background: #3157d5; color: white; font-size: 15px; font-weight: 700; cursor: pointer; }
        button:hover { background: #2446b8; }
        .error { padding: 11px 12px; border-radius: 8px; background: #fff0f0; color: #b42318; font-size: 14px; }
        .hint { margin: 20px 0 0; color: #8790a0; font-size: 12px; text-align: center; }
    </style>
</head>
<body>
    <main class="login-card">
        <div class="brand" aria-hidden="true">S</div>
        <h1>Selamat kembali</h1>
        <p class="subtitle">Log masuk untuk menguruskan rekod pelajar.</p>
        <?php if ($error !== ''): ?><p class="error" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
        <form method="post" action="login.php">
            <label for="username">Nama pengguna</label>
            <input id="username" name="username" type="text" autocomplete="username" required autofocus>
            <label for="password">Kata laluan</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required>
            <button type="submit">Log Masuk</button>
        </form>
        <p class="hint">Nama pengguna dan kata laluan boleh diisi dengan apa-apa nilai.</p>
    </main>
</body>
</html>
