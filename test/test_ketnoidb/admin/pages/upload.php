<?php

// Kiểm tra session xem đã được tạo chưa, nếu chưa thì đưa người dùng trở lại trang đăng nhập
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header('Location: ../../index.php?page=login');
    //../pages/login.php
    exit;
}
// Kiểm tra trên nhằm ngăn chặn người dùng truy cập thẳng vào trang upload của admin tại localhost:8080/luuducthang/bai4/nv5/admin/pages/upload.php
// Nên để kiểm tra xem đoạn code kiểm tra session bên trên có hoạt động không thì chỉ cẩn truy cập thẳng vào trang index của admin, ta sẽ bị chặn lại và bắt buộc phải đăng nhập


// Kiểm tra thông tin đăng nhập
if ($_SESSION['username'] != 'admin' || $_SESSION['password'] != 'admin') {
    session_destroy(); // Hủy session ngay nếu phát hiện tài khoản đăng nhập không phải là admin, tránh tình trạng sử dụng session cũ
    header('Location: ../../pages/login.php');
    exit;
}
?>
<?php
// Thư mục để lưu file upload, khác so với nhiệm vụ 3 là file upload nằm ngoài cả upload.php nên cần ../ để lùi ra thư mục bên ngoài rồi mới vào thư mục uploads
$uploadDir = "../uploads/";

// Nếu nhấn nút Upload
if (isset($_POST['upload'])) {
    // Tạo mảng kết hợp để lưu thông tin file
    $uploadedFiles = [];

    // Lặp qua 10 file input
    for ($i = 1; $i <= 10; $i++) {
        $fileName = $_FILES['file' . $i]['name']; // Tên file
        $fileTmp = $_FILES['file' . $i]['tmp_name']; // Đường dẫn tạm thời mà php đang lưu file

        if (!empty($fileName)) {
            $targetFile = $uploadDir . basename($fileName); // Đường dẫn tới file khi được lưu trong thư mục uploads có dạng uploads/file.jpg
            // Hàm basename có thể tự nhận diện trên đường dẫn và cắt ra đúng tên_file.extension
            // Di chuyển file từ tmp sang thư mục uploads

            /*Hàm move_uploaded_file() trong PHP được dùng để di chuyển một file đã được tải lên (upload) từ vị trí tạm thời do PHP tạo ra sang một vị trí mới trên server. 
            Hàm này đảm bảo rằng file chỉ được di chuyển nếu nó thực sự là file được upload qua HTTP POST, giúp tăng cường bảo mật khi xử lý file upload. */
            if (move_uploaded_file($fileTmp, $targetFile)) { // Di chuyển file từ tmp sang thư mục uploads
                $uploadedFiles["File " . $i] = $targetFile;
                //Slot nào có file tải lên thì sẽ được lưu theo cặp key-path  là "File i - Đường dẫn file"
            } else {
                $uploadedFiles["File " . $i] = "Upload lỗi!";
                //Còn slot nào mà file tải lên lại ko có trong tmp thì sẽ đánh dấu là lỗi và lưu thành "File i - Upload lỗi!"
            }
        } else {
            $uploadedFiles["File " . $i] = "Chưa chọn file";
            // Tương tự với "File i - Chưa chọn file" cho những slot không tải lên file gì
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Upload nhiều file</title>
</head>

<body>
    <h3>Sử dụng mảng kết hợp - Upload 10 file</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <!-- Tạo 10 input file -->
        <?php for ($i = 1; $i <= 10; $i++): ?>
            File <?= $i ?>: <input type="file" name="file<?= $i ?>"><br><br>
        <?php endfor; ?>
        <input type="reset" value="Reset">
        <input type="submit" name="upload" value="Upload">
    </form>

    <?php if (!empty($uploadedFiles)): ?>
        <h3>Kết quả Upload:</h3>
        <ul>
            <?php foreach ($uploadedFiles as $key => $filePath): ?>
                <li>
                    <?= $key ?>:
                    <?php if ($filePath !== "Upload lỗi!" && $filePath !== "Chưa chọn file"): ?>
                        <?= basename($filePath) . "<br>Đường dẫn: " . $filePath . "<br>" ?>
                    <?php else: ?>
                        <?= $filePath ?>
                    <?php endif; ?>
                </li><br><br>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>

</html>