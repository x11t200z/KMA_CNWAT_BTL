<?php
session_start();
include '../db.php';

if (!isset($_SESSION['Role']) || $_SESSION['Role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM user WHERE UserID = $id");
$user = $result->fetch_assoc();

if (!$user) {
    echo "User không tồn tại!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $fullname = $_POST['FullName'];
    $email = $_POST['Email'];
    $phone = $_POST['Phone'];
    $role = $_POST['Role'];

    $sql = "UPDATE user 
            SET Username='$username', Password='$password', FullName='$fullname', 
                Email='$email', Phone='$phone', Role='$role'
            WHERE UserID=$id";
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
    <title>Sửa User</title>
    <style>
        body { font-family: Arial; background: #f5f6fa; padding: 20px; }
        form { background: #fff; padding: 20px; border-radius: 8px; width: 400px; margin: auto; }
        input, select { width: 100%; padding: 8px; margin: 10px 0; }
        button { background: #00b894; color: #fff; border: none; padding: 10px; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <form method="post">
        <h2>Sửa User</h2>
        Username<input type="text" name="Username" value="<?= htmlspecialchars($user['Username']) ?>" required>
        Password<input type="text" name="Password" value="<?= htmlspecialchars($user['Password']) ?>" required>
        FullName<input type="text" name="FullName" value="<?= htmlspecialchars($user['FullName']) ?>">
        Email<input type="email" name="Email" value="<?= htmlspecialchars($user['Email']) ?>">
        Số điện thoại<input type="text" name="Phone" value="<?= htmlspecialchars($user['Phone']) ?>">
        Quyền<select name="Role">
            <option value="customer" <?= $user['Role']=='customer'?'selected':'' ?>>Customer</option>
            <option value="admin" <?= $user['Role']=='admin'?'selected':'' ?>>Admin</option>
        </select>
        <button type="submit">Lưu</button>
    </form>
</body>
</html>
