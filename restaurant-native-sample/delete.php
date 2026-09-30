<?php
require_once __DIR__ . '/config/db.php';
checkAuth();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM orders WHERE id = $id";
    $pdo->query($sql);
}

header("Location: index.php");
exit;
