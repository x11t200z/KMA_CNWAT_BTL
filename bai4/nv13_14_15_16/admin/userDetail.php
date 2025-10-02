<?php
include '../db.php';

// Kiểm tra có ID truyền vào không
if (!isset($_GET['id'])) {
    die("Không tìm thấy ID người dùng.");
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM user WHERE UserID = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Không tìm thấy người dùng.");
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết người dùng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Chi tiết người dùng</h2>

    <div class="card shadow p-4">
        <p><strong>ID:</strong> <?= $user['UserID'] ?></p>
        <p><strong>Tên đăng nhập:</strong> <?= $user['Username'] ?></p>
        <p><strong>Email:</strong> <?= $user['Email'] ?></p>
        <p><strong>Vai trò:</strong> <?= $user['Role'] ?></p>
    </div>

    <a href="userList.php" class="btn btn-secondary mt-3">Quay lại danh sách</a>
</div>
</body>
</html>
