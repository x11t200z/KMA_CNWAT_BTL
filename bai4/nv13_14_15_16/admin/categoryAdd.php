<?php
session_start();
include '../db.php';

if (!isset($_SESSION['Role']) || $_SESSION['Role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['CategoryName']);
    $conn->query("INSERT INTO Category (CategoryName) VALUES ('$name')");
    header("Location: categoryList.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Category</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f6fa; padding: 20px; }
        .form-container { max-width: 400px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
        h2 { text-align: center; }
        input[type="text"], input[type="submit"] { width: 100%; padding: 10px; margin: 8px 0; border: 1px solid #ccc; border-radius: 5px; }
        input[type="submit"] { background: #0984e3; color: white; cursor: pointer; }
        input[type="submit"]:hover { background: #74b9ff; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Thêm Category</h2>
        <form method="POST">
            <label for="CategoryName">Tên Category</label>
            <input type="text" id="CategoryName" name="CategoryName" required>
            <input type="submit" value="Thêm">
        </form>
    </div>
</body>
</html>
