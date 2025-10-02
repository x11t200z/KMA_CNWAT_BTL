<?php
session_start();
include '../db.php';

if (!isset($_SESSION['Role']) || $_SESSION['Role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Lấy danh sách sản phẩm kèm tên Category
$sql = "SELECT p.*, c.CategoryName 
        FROM Product p 
        LEFT JOIN Category c ON p.CategoryID = c.CategoryID";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý Sản phẩm</title>
    <style>
        body {
            font-family: Arial;
            background: #f5f6fa;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background: #0984e3;
            color: white;
        }

        a.btn {
            padding: 6px 10px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
        }

        .btn-view {
            background: #6c5ce7;
        }

        .btn-edit {
            background: #00b894;
        }

        .btn-delete {
            background: #d63031;
        }

        .btn-add {
            background: #0984e3;
            display: inline-block;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h2>Quản lý Sản phẩm</h2>
    <a href="productAdd.php" class="btn btn-add">+ Thêm sản phẩm</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Loại</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Hình ảnh</th>
            <th>Hành động</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['ProductID'] ?></td>
                <td><?= htmlspecialchars($row['ProductName']) ?></td>
                <td><?= htmlspecialchars($row['CategoryName'] ?? 'Chưa phân loại') ?></td>
                <td><?= number_format($row['Price']) ?> VNĐ</td>
                <td><?= $row['Quantity'] ?></td>
                <td><img src="../images/<?= $row['ImageURL'] ?>" alt="" width="60"></td>
                <td>
                    <a href="productDetail.php?id=<?= $row['ProductID'] ?>" class="btn btn-view">Chi tiết</a>
                    <a href="productEdit.php?id=<?= $row['ProductID'] ?>" class="btn btn-edit">Sửa</a>
                    <a href="productDelete.php?delete=<?= $row['ProductID'] ?>" class="btn btn-delete"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="index.php" class="btn btn-add">← Quay lại Dashboard</a>

</body>

</html>