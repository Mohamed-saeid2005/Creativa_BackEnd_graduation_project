<?php
require_once __DIR__ . '/config/db.php';
checkAuth();

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $customer_name = $_POST['customer_name'];
    $table_number = $_POST['table_number'];
    $items = $_POST['items'];
    $total_price = $_POST['total_price'];
    $status = $_POST['status'];

    $sql = "INSERT INTO orders 
            (customer_name, table_number, items, total_price, status)
            VALUES 
            ('$customer_name', '$table_number', '$items', '$total_price', '$status')";

    $pdo->query($sql);

    header("Location: index.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إضافة طلب جديد</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container" style="max-width: 600px;">
    <h2>إضافة طلب جديد للمطعم</h2>
    <?php if ($error): ?>
        <div class="alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="create.php">
        <div class="form-group">
            <label>اسم العميل:</label>
            <input type="text" name="customer_name" required>
        </div>
        <div class="form-group">
            <label>رقم الطاولة:</label>
            <input type="number" name="table_number" min="1" required>
        </div>
        <div class="form-group">
            <label>الأصناف المطلوبة:</label>
            <textarea name="items" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label>إجمالي الحساب (ر.س):</label>
            <input type="number" step="0.01" name="total_price" required>
        </div>
        <div class="form-group">
            <label>حالة الطلب:</label>
            <select name="status">
                <option value="pending">قيد الانتظار (Pending)</option>
                <option value="cooking">جاري الطهي (Cooking)</option>
                <option value="served">تم التقديم (Served)</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">حفظ الطلب</button>
        <a href="index.php" class="btn" style="background-color: #7f8c8d;">إلغاء وعودة</a>
    </form>
</div>
</body>
</html>
