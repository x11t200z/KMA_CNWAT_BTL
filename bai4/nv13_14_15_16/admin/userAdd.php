<?php
session_start();
include '../db.php';

// Kiểm tra quyền admin
if (!isset($_SESSION['Role']) || $_SESSION['Role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['Username'];
    $password = $_POST['Password']; // đang để plain text
    $fullname = $_POST['FullName'];
    $email = $_POST['Email'];
    $phone = $_POST['Phone'];
    $role = $_POST['Role'];

    $sql = "INSERT INTO user (Username, Password, FullName, Email, Phone, Role) 
            VALUES ('$username', '$password', '$fullname', '$email', '$phone', '$role')";
    if ($conn->query($sql)) {
        header("Location: userList.php");
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
    <title>Thêm User</title>
    <style>
        body { font-family: Arial; background: #f5f6fa; padding: 20px; }
        form { background: #fff; padding: 20px; border-radius: 8px; width: 400px; margin: auto; }
        input, select { width: 100%; padding: 8px; margin: 10px 0; }
        button { background: #0984e3; color: #fff; border: none; padding: 10px; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <form method="post">
        <h2>Thêm User</h2>
        <input type="text" name="Username" placeholder="Tên đăng nhập" required>
        <input type="password" name="Password" placeholder="Mật khẩu" required>
        <input type="text" name="FullName" placeholder="Họ tên">
        <input type="email" name="Email" placeholder="Email">
        <input type="text" name="Phone" placeholder="Số điện thoại">
        <select name="Role">
            <option value="customer">Customer</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit">Thêm</button>
    </form>
</body>
</html>
