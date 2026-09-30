<?php
require_once __DIR__ . '/config/db.php';
checkAuth();


///////////////////////////////////////////////////////////
// 1- catch id
// 2- get the record (fetch)
// 3- catch all sended data (from form -post request-)
// 4- update record
///////////////////////////////////////////////////////////


?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تعديل الطلب #<?= $order['id'] ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container" style="max-width: 600px;">
    <h2>تعديل الطلب رقم #<?= $order['id'] ?></h2>
    <?php if ($error): ?>
        <div class="alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="edit.php?id=<?= $order['id'] ?>">
        <div class="form-group">
            <label>اسم العميل:</label>
            <input type="text" name="customer_name" value="<?= htmlspecialchars($order['customer_name']) ?>" required>
        </div>
        <div class="form-group">
            <label>رقم الطاولة:</label>
            <input type="number" name="table_number" value="<?= $order['table_number'] ?>" min="1" required>
        </div>
        <div class="form-group">
            <label>الأصناف المطلوبة:</label>
            <textarea name="items" rows="3" required><?= htmlspecialchars($order['items']) ?></textarea>
        </div>
        <div class="form-group">
            <label>الإجمالي (ر.س):</label>
            <input type="number" step="0.01" name="total_price" value="<?= $order['total_price'] ?>" required>
        </div>
        <div class="form-group">
            <label>حالة الطلب:</label>
            <select name="status">
                <option value="pending" <?= $order['status'] === 'pending' ? 'selected' : '' ?>>قيد الانتظار</option>
                <option value="cooking" <?= $order['status'] === 'cooking' ? 'selected' : '' ?>>جاري الطهي</option>
                <option value="served" <?= $order['status'] === 'served' ? 'selected' : '' ?>>تم التقديم</option>
                <option value="cancelled" <?= $order['status'] === 'cancelled' ? 'selected' : '' ?>>ملغي</option>
            </select>
        </div>
        <button type="submit" class="btn btn-warning">تحديث الطلب</button>
        <a href="index.php" class="btn" style="background-color: #7f8c8d;">إلغاء</a>
    </form>
</div>
</body>
</html>
