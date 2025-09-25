<?php
// Kiểm tra session xem đã được tạo chưa, nếu chưa thì đưa người dùng trở lại trang đăng nhập
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header('Location: ../../index.php?page=login');
    //../pages/login.php
    exit;
}
// Kiểm tra trên nhằm ngăn chặn người dùng truy cập thẳng vào trang home của admin tại localhost:8080/luuducthang/bai4/nv5/admin/pages/home.php
// Nên để kiểm tra xem đoạn code kiểm tra session bên trên có hoạt động không thì chỉ cẩn truy cập thẳng vào trang index của admin, ta sẽ bị chặn lại và bắt buộc phải đăng nhập


// Kiểm tra thông tin đăng nhập
if ($_SESSION['username'] != 'admin' || $_SESSION['password'] != 'admin') {
    session_destroy(); // Hủy session ngay nếu phát hiện tài khoản đăng nhập không phải là admin, tránh tình trạng sử dụng session cũ
    header('Location: ../../pages/login.php');
    exit;
}
?>
<h1>Xin chào Admin!</h1>
<p>Bạn đã đăng nhập thành công.</p>
<p>Đây là trang quản trị</p>

<!-- Thêm nút logout nếu cần
<a href="../logout.php">Đăng xuất</a> -->