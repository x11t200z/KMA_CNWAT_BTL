<?php
$page = $_GET['page'] ?? 'home'; //Mặc định là trang Home
?>
<?php
session_start();

// Kiểm tra session xem đã được tạo chưa, nếu chưa thì đưa người dùng trở lại trang đăng nhập
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header('Location: ../index.php?page=login');
    //../pages/login.php
    exit;
}
// Kiểm tra trên nhằm ngăn chặn người dùng truy cập thẳng vào trang index của admin tại localhost:8080/luuducthang/bai4/nv5/admin/index.php
// Nên để kiểm tra xem đoạn code kiểm tra session bên trên có hoạt động không thì chỉ cẩn truy cập thẳng vào trang index của admin, ta sẽ bị chặn lại và bắt buộc phải đăng nhập


// Kiểm tra thông tin đăng nhập
if ($_SESSION['username'] != 'admin' || $_SESSION['password'] != 'admin') {
    session_destroy(); // Hủy session ngay nếu phát hiện tài khoản đăng nhập không phải là admin, tránh tình trạng sử dụng session cũ
    header('Location: ../pages/login.php');
    exit;
}
?>
<!-- index.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Trang quản trị</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <?php include '../../nv1_template/pages/head.php'; ?>
    <?php include 'menu.php'; ?>
    <div style="display:flex;">
        <div style="width:20%;">
            <?php include '../../nv1_template/pages/left.php'; ?>
        </div>
        <div style="width:80%; padding: 30px;">
            <?php
            switch ($page) {
                case 'home':
                    include 'pages/home.php';
                    break;
                case 'logout':
                    include 'pages/logout.php';
                    break;
                case 'cookie':
                    include 'pages/cookie.php';
                    break;
                default:
                    include 'pages/home.php';
                    break;
            }
            ?>

        </div>
    </div>

    <?php include '../../nv1_template/pages/footer.php'; ?>
</body>

</html>