<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $birthday = $_POST['birthday'] ?? '';
    $address = $_POST['address'] ?? '';
    $class = $_POST['class'] ?? '';
    $image = '';

    // Xử lý upload ảnh
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        if (!is_dir('uploads')) {
            mkdir('uploads');
        }
        $image = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
    }

    // Thêm vào file
    $line = implode('|', [$name, $birthday, $address, $image, $class]) . "\n";
    file_put_contents('pages/student.txt', $line, FILE_APPEND);

    header('Location: ?page=list');
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">

<body>
    <h2>Thêm sinh viên mới</h2>
    <form method="post" enctype="multipart/form-data">
        Full name: <input type="text" name="name"><br><br>
        Birthday: <input type="text" name="birthday"><br><br>
        Address: <input type="text" name="address"><br><br>
        Image: <input type="file" name="image"><br><br>
        Class: <input type="text" name="class"><br><br>
        <input type="reset" value="Nhập lại">
        <input type="submit" value="Lưu">
    </form>
</body>
</html>