<?php
// Xử lý xóa sinh viên
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $lines = file('pages/student.txt');
    if (isset($lines[$id])) {
        unset($lines[$id]);
        file_put_contents('pages/student.txt', implode('', $lines));
    }
    header('Location: ?page=list');
    exit;
}

// Đọc danh sách sinh viên
$students = file('pages/student.txt');
?>

<!DOCTYPE html>
<html lang="vi">

<body>
    <h2>Danh sách sinh viên</h2>
    <table border="1">
        <tr>
            <th>STT</th>
            <th>Ten</th>
            <th>Ngay sinh</th>
            <th>Dia chi</th>
            <th>Anh</th>
            <th>Lop</th>
            <th>Thao tac</th>
        </tr>
        <?php foreach ($students as $i => $line): ?>
            <?php if (trim($line) === '') continue; ?>
            <?php $parts = explode('|', trim($line)); ?>
            <tr>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo htmlspecialchars($parts[0]); ?></td>
                <td><?php echo htmlspecialchars($parts[1]); ?></td>
                <td><?php echo htmlspecialchars($parts[2]); ?></td>
                <td>
                    <?php if (!empty($parts[3])): ?>
                        <img src="uploads/<?php echo htmlspecialchars($parts[3]); ?>" width="50" alt="Anh">
                    <?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars($parts[4]); ?></td>
                <td>
                    <a href="index.php?page=detail&id=<?php echo $i; ?>">Chi tiết</a> |
                    <a href="index.php?page=edit&id=<?php echo $i; ?>">Chỉnh sửa</a> |
                    <a href="index.php?page=list&delete=<?php echo $i; ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?');">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <button><a href="index.php?page=add">Thêm sinh viên mới</a></button>
</body>
</html>