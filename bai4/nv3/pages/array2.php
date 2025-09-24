<?php
// Thư mục để lưu file upload
$uploadDir = "uploads/";

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

            // Di chuyển file từ tmp sang thư mục uploads
            /*Hàm move_uploaded_file() trong PHP được dùng để di chuyển một file đã được tải lên (upload) từ vị trí tạm thời do PHP tạo ra sang một vị trí mới trên server. Hàm này đảm bảo rằng file chỉ được di chuyển nếu nó thực sự là file được upload qua HTTP POST, giúp tăng cường bảo mật khi xử lý file upload. */
            if (move_uploaded_file($fileTmp, $targetFile)) { // Di chuyển file từ tmp sang thư mục uploads
                $uploadedFiles["File " . $i] = $targetFile;
            } else {
                $uploadedFiles["File " . $i] = "Upload lỗi!";
            }
        } else {
            $uploadedFiles["File " . $i] = "Chưa chọn file";
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
                        <?= basename($filePath). "<br>Đường dẫn: " . $filePath . "<br>" ?>
                    <?php else: ?>
                        <?= $filePath ?>
                    <?php endif; ?>
                </li><br><br>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>

</html>