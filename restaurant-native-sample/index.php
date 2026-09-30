<?php
require_once __DIR__ . '/config/db.php';
checkAuth();

//////// get all data (list) /////////////////

?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>لوحة الطلبات - المطعم</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <header>
        <div>
            <h1>نظام إدارة طلبات المطعم</h1>
            <p>مرحباً بك، <strong><?= htmlspecialchars($_SESSION['user_name']) ?></strong></p>
        </div>
        <div>
            <a href="create.php" class="btn btn-success">+ طلب جديد</a>
            <a href="logout.php" class="btn btn-danger">تسجيل خروج</a>
        </div>
    </header>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>اسم العميل</th>
                <th>رقم الطاولة</th>
                <th>الوجبات المطلوبة</th>
                <th>الإجمالي</th>
                <th>الحالة</th>
                <th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($orders) > 0): ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order['id'] ?></td>
                        <td><?= htmlspecialchars($order['customer_name']) ?></td>
                        <td><?= htmlspecialchars($order['table_number']) ?></td>
                        <td><?= nl2br(htmlspecialchars($order['items'])) ?></td>
                        <td><?= number_format($order['total_price'], 2) ?> ر.س</td>
                        <td>
                            <span class="badge badge-<?= $order['status'] ?>">
                                <?= $order['status'] ?>
                            </span>
                        </td>
                        <td>
                            <a href="edit.php?id=<?= $order['id'] ?>" class="btn btn-warning" style="padding: 4px 8px; font-size: 12px;">تعديل</a>
                            <a href="delete.php?id=<?= $order['id'] ?>" class="btn btn-danger" style="padding: 4px 8px; font-size: 12px;" onclick="return confirm('هل أنت متأكد من حذف هذا الطلب؟');">حذف</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align: center;">لا توجد طلبات مسجلة حالياً.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
