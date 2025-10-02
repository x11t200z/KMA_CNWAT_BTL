<?php
session_start();
include '../db.php';

if (!isset($_SESSION['Role']) || $_SESSION['Role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$id = intval($_GET['id'] ?? 0);
$sql = "SELECT p.*, c.CategoryName 
        FROM Product p 
        LEFT JOIN Category c ON p.CategoryID = c.CategoryID
        WHERE ProductID = $id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

if (!$product) {
    echo "Không tìm thấy sản phẩm!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết sản phẩm</title>
    <style>
        body { font-family: Arial; background: #f5f6fa; padding: 20px; }
        .box { background: #fff; padding: 20px; border-radius: 8px; width: 500px; margin: auto; }
        h2 { text-align: center; }
        p { margin: 10px 0; }
        img { display: block; margin: auto; max-width: 200px; }
    </style>
</head>
<body>
    <div class="box">
        <h2><?= htmlspecialchars($product['ProductName']) ?></h2>
        <img src="../images/<?= $product['ImageURL'] ?>" alt="">
        <p><b>ID:</b> <?= $product['ProductID'] ?></p>
        <p><b>Loại:</b> <?= htmlspecialchars($product['CategoryName'] ?? 'Chưa phân loại') ?></p>
        <p><b>Giá:</b> <?= number_format($product['Price']) ?> VNĐ</p>
        <p><b>Số lượng:</b> <?= $product['Quantity'] ?></p>
        <p><b>Mô tả:</b> <?= nl2br(htmlspecialchars($product['Description'])) ?></p>
        <a href="productList.php">← Quay lại danh sách</a>
        
    </div>
</body>
</html>
