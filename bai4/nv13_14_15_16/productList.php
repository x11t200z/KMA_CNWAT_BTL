<?php
include 'db.php';

// Kiểm tra tham số cat (CategoryID) trên URL
if (isset($_GET['cat'])) {
    $catId = intval($_GET['cat']); // ép kiểu để tránh lỗi

    // Lấy tên loại sản phẩm
    $catSql = "SELECT CategoryName FROM Category WHERE CategoryID = $catId";
    $catResult = $conn->query($catSql);
    if ($catResult && $catResult->num_rows > 0) {
        $category = $catResult->fetch_assoc();
        $categoryName = $category['CategoryName'];
    } else {
        die("Loại sản phẩm không tồn tại!");
    }

    // Lấy danh sách sản phẩm thuộc loại này
    $sql = "SELECT * FROM Product WHERE CategoryID = $catId ORDER BY CreatedAt DESC";
    $products = $conn->query($sql);
} else {
    die("Thiếu tham số loại sản phẩm!");
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm - <?= htmlspecialchars($categoryName) ?></title>
    <style>
        body { font-family: Arial, sans-serif;}
        h1 { margin-bottom: 20px; }
        .product-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .product {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            width: 220px;
            text-align: center;
            box-shadow: 2px 2px 6px #ddd;
        }
        .product img {
            max-width: 200px;
            max-height: 150px;
        }
        .price { color: red; font-weight: bold; }
        a.detail {
            display: inline-block;
            margin-top: 8px;
            padding: 6px 12px;
            background: #007bff;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
        }
        a.detail:hover { background: #0056b3; }
        .back { margin-top: 20px; display: inline-block; }
    </style>
</head>
<body>
    <h1><?= htmlspecialchars($categoryName) ?></h1>

    <div class="product-list">
        <?php if ($products && $products->num_rows > 0): ?>
            <?php while ($p = $products->fetch_assoc()): ?>
                <div class="product">
                    <img src="images/<?= htmlspecialchars($p['ImageURL']) ?>" alt="<?= htmlspecialchars($p['ProductName']) ?>">
                    <h3><?= htmlspecialchars($p['ProductName']) ?></h3>
                    <p class="price"><?= number_format($p['Price'], 0, ',', '.') ?> VND</p>
                <a href="?page=productDetail&id=<?= $p['ProductID'] ?>">Xem chi tiết</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Chưa có sản phẩm trong loại này.</p>
        <?php endif; ?>
    </div>

    <a href="index.php" class="back">⬅ Quay lại Trang chủ</a>
</body>
</html>
