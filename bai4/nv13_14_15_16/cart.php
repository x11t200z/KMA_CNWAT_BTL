<?php
session_start();
include 'db.php';

// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Xử lý hành động
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Lấy thông tin sản phẩm từ DB
    $sql = "SELECT * FROM Product WHERE ProductID = $id";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();

        switch ($_GET['action']) {
            case "add":
                // Nếu sản phẩm đã có trong giỏ → tăng số lượng
                if (isset($_SESSION['cart'][$id])) {
                    $_SESSION['cart'][$id]['quantity']++;
                } else {
                    // Thêm mới vào giỏ
                    $_SESSION['cart'][$id] = [
                        "name" => $product['ProductName'],
                        "price" => $product['Price'],
                        "image" => $product['ImageURL'],
                        "quantity" => 1
                    ];
                }
                break;

            case "remove":
                // Xóa sản phẩm khỏi giỏ
                if (isset($_SESSION['cart'][$id])) {
                    unset($_SESSION['cart'][$id]);
                }
                break;

            case "update":
                // Cập nhật số lượng
                if (isset($_SESSION['cart'][$id]) && isset($_POST['quantity'])) {
                    $qty = intval($_POST['quantity']);
                    if ($qty > 0) {
                        $_SESSION['cart'][$id]['quantity'] = $qty;
                    } else {
                        unset($_SESSION['cart'][$id]);
                    }
                }
                break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        table, th, td { border: 1px solid #ccc; }
        th, td {
            padding: 10px;
            text-align: center;
        }
        img {
            max-width: 80px;
            max-height: 60px;
        }
        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 15px;
        }
        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            background: #007bff;
            color: #fff;
            cursor: pointer;
        }
        .btn:hover { background: #0056b3; }
        .back {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            padding: 6px 12px;
            background: #28a745;
            color: #fff;
            border-radius: 6px;
        }
        .back:hover { background: #1e7e34; }
    </style>
</head>
<body>
    <h1>Giỏ hàng của bạn</h1>

    <?php if (!empty($_SESSION['cart'])): ?>
        <form method="post" action="cart.php?action=update&id=<?php // để update từng item ?>">
        <table>
            <tr>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>Hành động</th>
            </tr>
            <?php 
            $total = 0;
            foreach ($_SESSION['cart'] as $id => $item): 
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            ?>
            <tr>
                <td><img src="images/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>"></td>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td><?= number_format($item['price'], 0, ',', '.') ?> VND</td>
                <td>
                    <form method="post" action="cart.php?action=update&id=<?= $id ?>">
                        <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1">
                        <button type="submit" class="btn">Cập nhật</button>
                    </form>
                </td>
                <td><?= number_format($subtotal, 0, ',', '.') ?> VND</td>
                <td><a href="cart.php?action=remove&id=<?= $id ?>" class="btn">Xóa</a></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p class="total">Tổng cộng: <?= number_format($total, 0, ',', '.') ?> VND</p>
    <?php else: ?>
        <p>Giỏ hàng trống.</p>
    <?php endif; ?>

    <a href="index.php" class="back">⬅ Tiếp tục mua sắm</a>
</body>
</html>
