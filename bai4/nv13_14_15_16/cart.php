<?php
session_start();
include 'db.php';

// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Xử lý hành động
// 🟢 Nếu hành động là "checkout" (nút Mua hàng)
if (isset($_GET['action']) && $_GET['action'] === 'checkout' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_SESSION['cart'])) {
        $success = true;
        foreach ($_SESSION['cart'] as $id => $item) {
            $quantity = intval($item['quantity']);

            // Lấy số lượng tồn kho hiện tại
            $result = $conn->query("SELECT Quantity FROM Product WHERE ProductID = $id");
            if ($result && $result->num_rows > 0) {
                $currentStock = intval($result->fetch_assoc()['Quantity']);

                if ($currentStock >= $quantity) {
                    $update = $conn->prepare("UPDATE Product SET Quantity = Quantity - ? WHERE ProductID = ?");
                    $update->bind_param("ii", $quantity, $id);
                    $update->execute();
                } else {
                    $_SESSION['message'] = "Sản phẩm '{$item['name']}' chỉ còn $currentStock cái trong kho, không thể mua đủ!";
                    $success = false;
                }
            }
        }

        if ($success) {
            $_SESSION['cart'] = [];
            $_SESSION['message'] = "Mua hàng thành công! Cảm ơn bạn đã đặt hàng.";
        }
    } else {
        $_SESSION['message'] = "Giỏ hàng trống, không thể mua!";
    }

    header("Location: cart.php");
    exit;
}

// 🟢 Còn các hành động add, remove, update thì vẫn kiểm tra bằng GET
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT * FROM Product WHERE ProductID = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $stock = intval($product['Quantity']);

        switch ($_GET['action']) {
            case "add":
                if (isset($_SESSION['cart'][$id])) {
                    if ($_SESSION['cart'][$id]['quantity'] < $stock) {
                        $_SESSION['cart'][$id]['quantity']++;
                    } else {
                        $_SESSION['message'] = "Sản phẩm '{$product['ProductName']}' chỉ còn $stock cái trong kho!";
                    }
                } else {
                    $_SESSION['cart'][$id] = [
                        "name" => $product['ProductName'],
                        "price" => $product['Price'],
                        "image" => $product['ImageURL'],
                        "quantity" => 1,
                        "stock" => $stock
                    ];
                }
                break;

            case "remove":
                unset($_SESSION['cart'][$id]);
                break;

            case "update":
                if (isset($_SESSION['cart'][$id]) && isset($_POST['quantity'])) {
                    $qty = intval($_POST['quantity']);
                    if ($qty > $stock) {
                        $_SESSION['cart'][$id]['quantity'] = $stock;
                        $_SESSION['message'] = "Chỉ còn $stock sản phẩm trong kho!";
                    } elseif ($qty > 0) {
                        $_SESSION['cart'][$id]['quantity'] = $qty;
                    } else {
                        unset($_SESSION['cart'][$id]);
                    }
                }
                break;
        }
    }

    header("Location: cart.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
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

        .btn:hover {
            background: #0056b3;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            padding: 6px 12px;
            background: #28a745;
            color: #fff;
            border-radius: 6px;
        }

        .back:hover {
            background: #1e7e34;
        }

        .msg {
            padding: 10px;
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
            border-radius: 6px;
            margin-bottom: 12px;
        }

        .small {
            font-size: 13px;
            color: gray;
            margin-top: 6px;
        }
    </style>
</head>

<body>
    <h1>Giỏ hàng của bạn</h1>

    <?php
    if (!empty($_SESSION['message'])) {
        echo '<div class="msg">' . htmlspecialchars($_SESSION['message']) . '</div>';
        unset($_SESSION['message']);
    }
    ?>

    <?php if (!empty($_SESSION['cart'])): ?>
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
                // Cập nhật tồn kho mới nhất (phòng khi có thay đổi)
                $query = $conn->query("SELECT Quantity FROM Product WHERE ProductID = $id");
                $stock = $query && $query->num_rows > 0 ? intval($query->fetch_assoc()['Quantity']) : 0;

                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
                $remaining = max(0, $stock - $item['quantity']);
                ?>
                <tr>
                    <td><img src="images/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                    </td>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td><?= number_format($item['price'], 0, ',', '.') ?> VND</td>
                    <td>
                        <form method="post" action="cart.php?action=update&id=<?= $id ?>">
                            <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" max="<?= $stock ?>"
                                style="width:60px;">
                            <button type="submit" class="btn">Cập nhật</button>
                        </form>
                        <div class="small">Còn lại: <?= $remaining ?> sản phẩm</div>
                    </td>
                    <td><?= number_format($subtotal, 0, ',', '.') ?> VND</td>
                    <td><a href="cart.php?action=remove&id=<?= $id ?>" class="btn">Xóa</a></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <p class="total">Tổng cộng: <?= number_format($total, 0, ',', '.') ?> VND</p>
        <form method="post" action="cart.php?action=checkout">
            <button type="submit" class="btn" style="background:#dc3545;">Mua hàng</button>
        </form>

    <?php else: ?>
        <p>Giỏ hàng trống.</p>
    <?php endif; ?>

    <a href="index.php" class="back">⬅ Tiếp tục mua sắm</a>

</body>

</html>