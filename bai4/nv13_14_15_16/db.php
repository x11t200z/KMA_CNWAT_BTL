<?php
// Thông tin kết nối MySQL
$host = "localhost";      // máy chủ (nếu bạn dùng XAMPP thì giữ nguyên localhost)
$user = "root";           // tài khoản MySQL (mặc định của XAMPP là root)
$pass = "";               // mật khẩu (XAMPP mặc định là rỗng, nếu bạn đã đặt thì điền vào)
$dbname = "laptop_store";   // tên CSDL bạn đã tạo

// Kết nối
$conn = new mysqli($host, $user, $pass, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Thiết lập bảng mã UTF-8 để hỗ trợ tiếng Việt
$conn->set_charset("utf8");
?>
