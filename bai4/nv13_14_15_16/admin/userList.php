<?php
session_start();
include '../db.php';

// Kiểm tra quyền admin
if (!isset($_SESSION['Role']) || $_SESSION['Role'] !== 'admin') {
  header("Location: login.php");
  exit;
}

// Xóa user
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  $conn->query("DELETE FROM user WHERE UserID = $id");
  header("Location: userList.php");
  exit;
}

// Lấy danh sách user
$result = $conn->query("SELECT * FROM user");
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Quản lý User</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f6fa;
      padding: 20px;
    }

    h2 {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      margin-top: 20px;
    }

    table th,
    table td {
      padding: 10px;
      border: 1px solid #dcdde1;
      text-align: center;
    }

    table th {
      background: #0984e3;
      color: white;
    }

    a.btn {
      padding: 6px 10px;
      border-radius: 5px;
      text-decoration: none;
      color: white;
      font-size: 14px;
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
  <h2>Quản lý User</h2>
  <a href="userAdd.php" class="btn btn-add">+ Thêm User</a>
  <table>
    <tr>
      <th>ID</th>
      <th>Tên đăng nhập</th>
      <th>Họ tên</th>
      <th>Email</th>
      <th>Điện thoại</th>
      <th>Quyền</th>
      <th>Hành động</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['UserID'] ?></td>
        <td><?= htmlspecialchars($row['Username']) ?></td>
        <td><?= htmlspecialchars($row['FullName']) ?></td>
        <td><?= htmlspecialchars($row['Email']) ?></td>
        <td><?= htmlspecialchars($row['Phone']) ?></td>
        <td><?= htmlspecialchars($row['Role']) ?></td>
        <td>
          <a href="userDetail.php?id=<?= $row['UserID'] ?>" class="btn btn-view">Chi tiết</a>
          <a href="userEdit.php?id=<?= $row['UserID'] ?>" class="btn btn-edit">Sửa</a>
          <a href="userDelete.php?delete=<?= $row['UserID'] ?>" class="btn btn-delete"
            onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
  <br>
  <a href="index.php" class="btn btn-add">← Quay lại Dashboard</a>
</body>

</html>