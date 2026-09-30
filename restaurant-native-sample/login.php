<?php
require_once __DIR__ . '/config/db.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: index.php");
            exit;
        } else {
            $error = 'البريد الإلكتروني أو كلمة المرور غير صحيحة.';
        }
    } else {
        $error = 'يرجى ملء جميع الحقول.';
    }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول - نظام إدارة المطعم</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container" style="max-width: 400px; margin-top: 80px;">
    <h2>تسجيل الدخول</h2>
    <p style="margin-bottom: 15px; color: #666; font-size: 13px;">الحساب التجريبي: admin@restaurant.com / password123</p>
    
    <?php if ($error): ?>
        <div class="alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <div class="form-group">
            <label for="email">البريد الإلكتروني</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="password">كلمة المرور</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="submit" class="btn" style="width: 100%;">دخول</button>
    </form>
</div>
</body>
</html>
