<?php
if (!isset($_GET['id'])) {
    die('Không có ID sinh viên.');
}
$id = intval($_GET['id']);
$lines = file('pages/student.txt');
if (!isset($lines[$id])) {
    die('Sinh viên không tồn tại.');
}
$parts = explode('|', trim($lines[$id]));
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    
    <style>
        img {
            border: 1px solid #ccc;
            padding: 20px;
            background: #f9f9f9;
        }

    </style>
</head>
<body>
    <h2>Chi tiết thông tin sinh viên</h2>
    <?php if (!empty($parts[3])): ?>
        <img src="uploads/<?php echo htmlspecialchars($parts[3]); ?>" width="100" alt="Anh" style="float: left; margin-right: 10px;">
    <?php endif; ?>
    <p><strong><?php echo htmlspecialchars($parts[0]); ?></strong></p>
    <p><?php echo htmlspecialchars($parts[1]); ?></p>
    <p><?php echo htmlspecialchars($parts[2]); ?></p>
    <p><?php echo htmlspecialchars($parts[4]); ?></p>
    <br style="clear: both;">
    <a href="?page=list">Quay lại danh sách sinh viên</a>
</body>
</html>