<!-- <h2>Trang quản trị</h2>
<a href="../logout.php">Đăng xuất</a> -->

<?php
session_start();

// Kiểm tra quyền admin
if (!isset($_SESSION['Role']) || $_SESSION['Role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang quản trị</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }
        .sidebar {
            width: 220px;
            height: 100vh;
            background: #2d3436;
            color: #dfe6e9;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
        }
        .sidebar h2 {
            text-align: center;
            padding: 20px;
            margin: 0;
            background: #0984e3;
            color: white;
        }
        .sidebar a {
            padding: 15px;
            text-decoration: none;
            color: #dfe6e9;
            display: block;
            border-bottom: 1px solid #636e72;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background: #0984e3;
        }
        .content {
            margin-left: 220px;
            padding: 20px;
        }
        h1 {
            margin-top: 0;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="userList.php">👤 Quản lý User</a>
        <a href="productList.php">💻 Quản lý Product</a>
        <a href="categoryList.php">📂 Quản lý Category</a>
        <a href="../logout.php">🚪 Đăng xuất</a>
    </div>

    <div class="content">
        <div class="card">
            <h2>Dashboard</h2>
            <p>Hệ thống quản trị. Hãy chọn mục bên trái để bắt đầu quản lý dữ liệu.</p>
        </div>
    </div>
</body>
</html>
