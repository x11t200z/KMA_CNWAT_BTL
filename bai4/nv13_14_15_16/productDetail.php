<?php
include 'db.php';

// Kiểm tra tham số id trên URL
if (isset($_GET['id'])) {
    $productId = intval($_GET['id']); // ép kiểu để tránh SQL Injection đơn giản

    // Lấy thông tin sản phẩm
    $sql = "SELECT p.*, c.CategoryName 
            FROM Product p 
            JOIN Category c ON p.CategoryID = c.CategoryID 
            WHERE ProductID = $productId";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        die("Sản phẩm không tồn tại!");
    }
} else {
    die("Thiếu ID sản phẩm!");
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif;}
        .product-detail {
            display: flex;
            gap: 30px;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 2px 2px 8px #ddd;
        }
        .product-detail img {
            max-width: 350px;
            max-height: 250px;
        }
        .info {
            flex: 1;
        }
        .price {
            color: red;
            font-size: 22px;
            font-weight: bold;
        }
        .product-detail a{
            background-color: cornflowerblue;
            padding: 10px;
            text-decoration: none;
            border-radius: 8px;
            color: white;
        }
        .product-detail a:hover{
            background-color: cadetblue;
        }
        #back {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            padding: 8px 16px;
            background: #c90022ff;
            color: #ffffffff;
            border-radius: 6px;
        }
        #back:hover { background: #ff0000ff; }
    </style>
</head>
<body>
    <h1>Chi tiết sản phẩm</h1>
    <div class="product-detail">
        <div class="image">
            <img src="images/<?= htmlspecialchars($product['ImageURL']) ?>" alt="<?= htmlspecialchars($product['ProductName']) ?>">
        </div>
        <div class="info">
            <h2><?= htmlspecialchars($product['ProductName']) ?></h2>
            <p><strong>Loại:</strong> <?= htmlspecialchars($product['CategoryName']) ?></p>
            <p class="price"><?= number_format($product['Price'], 0, ',', '.') ?> VND</p>
            <p><strong>Mô tả:</strong><br><?= nl2br(htmlspecialchars($product['Description'])) ?></p>
            <a href="cart.php?action=add&id=<?= $product['ProductID'] ?>">Thêm vào giỏ hàng</a>
        </div>
    </div>
    <br>
    <a id="back" href="index.php">⬅ Quay lại Trang chủ</a>
</body>
</html>
