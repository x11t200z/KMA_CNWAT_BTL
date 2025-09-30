<?php
if (!isset($_GET['id'])) {
    die('Không có ID sinh viên.');
}
$id = intval($_GET['id']); // Chuyển sang kiểu số nguyên để tránh lỗi
$lines = file('pages/student.txt');
if (!isset($lines[$id])) {
    die('Sinh viên không tồn tại.');
}
$parts = explode('|', trim($lines[$id]));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $birthday = $_POST['birthday'] ?? '';
    $address = $_POST['address'] ?? '';
    $class = $_POST['class'] ?? '';
    $image = $parts[3]; // Giữ ảnh cũ nếu không upload mới

    // Xử lý upload ảnh mới
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
    }

    // Cập nhật dòng
    $line = implode('|', [$name, $birthday, $address, $image, $class]) . "\n";
    $lines[$id] = $line;
    file_put_contents('pages/student.txt', implode('', $lines));

    header('Location: ?page=list');
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">

<body>
    <h2>Chỉnh sửa thông tin sinh viên</h2>
    <form method="post" enctype="multipart/form-data">
        Full name: <input type="text" name="name" value="<?php echo htmlspecialchars($parts[0]); ?>"><br><br>
        Birthday: <input type="text" name="birthday" value="<?php echo htmlspecialchars($parts[1]); ?>"><br><br>
        Address: <input type="text" name="address" value="<?php echo htmlspecialchars($parts[2]); ?>"><br><br>
        Image: <input type="file" name="image"> (Hiện tại: <?php echo htmlspecialchars($parts[3] ?: 'Không có'); ?>)<br><br>
        Class: <input type="text" name="class" value="<?php echo htmlspecialchars($parts[4]); ?>"><br><br>
        <input type="reset" value="Nhập lại">
        <input type="submit" value="Lưu">
    </form>
</body>
</html>