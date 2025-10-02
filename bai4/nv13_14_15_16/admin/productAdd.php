<?php
session_start();
include '../db.php';

if (!isset($_SESSION['Role']) || $_SESSION['Role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Lấy danh sách Category để hiển thị trong form
$categories = $conn->query("SELECT * FROM Category");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['ProductName'];
    $cat = $_POST['CategoryID'];
    $price = $_POST['Price'];
    $qty = $_POST['Quantity'];
    $desc = $_POST['Description'];
    $img = $_FILES['ImageURL']['name'];

    if ($img) {
        move_uploaded_file($_FILES['ImageURL']['tmp_name'], "../images/" . $img);
    }

    $sql = "INSERT INTO Product (ProductName, CategoryID, Price, Quantity, Description, ImageURL) 
            VALUES ('$name', '$cat', '$price', '$qty', '$desc', '$img')";
    if ($conn->query($sql)) {
        header("Location: productList.php");
        exit;
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm</title>
    <style>
        body { font-family: Arial; background: #f5f6fa; padding: 20px; }
        form { background: #fff; padding: 20px; border-radius: 8px; width: 400px; margin: auto; }
        input, select, textarea { width: 100%; padding: 8px; margin: 10px 0; }
        button { background: #0984e3; color: #fff; border: none; padding: 10px; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <h2>Thêm sản phẩm</h2>
        <input type="text" name="ProductName" placeholder="Tên sản phẩm" required>
        <select name="CategoryID">
            <?php while ($cat = $categories->fetch_assoc()): ?>
                <option value="<?= $cat['CategoryID'] ?>"><?= htmlspecialchars($cat['CategoryName']) ?></option>
            <?php endwhile; ?>
        </select>
        <input type="number" step="0.01" name="Price" placeholder="Giá" required>
        <input type="number" name="Quantity" placeholder="Số lượng" required>
        <textarea name="Description" placeholder="Mô tả"></textarea>
        <input type="file" name="ImageURL">
        <button type="submit">Thêm</button>
    </form>
</body>
</html>
