<?php
session_start();
include '../db.php';

if (!isset($_SESSION['Role']) || $_SESSION['Role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$id = intval($_GET['id']);
$product = $conn->query("SELECT * FROM Product WHERE ProductID=$id")->fetch_assoc();
if (!$product) { echo "Không tìm thấy sản phẩm!"; exit; }

$categories = $conn->query("SELECT * FROM Category");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['ProductName'];
    $cat = $_POST['CategoryID'];
    $price = $_POST['Price'];
    $qty = $_POST['Quantity'];
    $desc = $_POST['Description'];

    $img = $product['ImageURL'];
    if ($_FILES['ImageURL']['name']) {
        $img = $_FILES['ImageURL']['name'];
        move_uploaded_file($_FILES['ImageURL']['tmp_name'], "../images/" . $img);
    }

    $sql = "UPDATE Product SET ProductName='$name', CategoryID='$cat', Price='$price', 
            Quantity='$qty', Description='$desc', ImageURL='$img' WHERE ProductID=$id";
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
    <title>Sửa sản phẩm</title>
    <style>
        body { font-family: Arial; background: #f5f6fa; padding: 20px; }
        form { background: #fff; padding: 20px; border-radius: 8px; width: 400px; margin: auto; }
        input, select, textarea { width: 100%; padding: 8px; margin: 10px 0; }
        button { background: #00b894; color: #fff; border: none; padding: 10px; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <h2>Sửa sản phẩm</h2>
        <input type="text" name="ProductName" value="<?= htmlspecialchars($product['ProductName']) ?>" required>
        <select name="CategoryID">
            <?php while ($cat = $categories->fetch_assoc()): ?>
                <option value="<?= $cat['CategoryID'] ?>" <?= $cat['CategoryID']==$product['CategoryID']?'selected':'' ?>>
                    <?= htmlspecialchars($cat['CategoryName']) ?>
                </option>
            <?php endwhile; ?>
        </select>
        <input type="number" step="0.01" name="Price" value="<?= $product['Price'] ?>" required>
        <input type="number" name="Quantity" value="<?= $product['Quantity'] ?>" required>
        <textarea name="Description"><?= htmlspecialchars($product['Description']) ?></textarea>
        <p>Ảnh hiện tại: <img src="../images/<?= $product['ImageURL'] ?>" width="80"></p>
        <input type="file" name="ImageURL">
        <button type="submit">Lưu</button>
    </form>
</body>
</html>
