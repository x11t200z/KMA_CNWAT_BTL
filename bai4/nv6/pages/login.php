<!-- login.php -->
<?php
session_start();

// Kiểm tra nếu đã đăng nhập rồi
if(isset($_SESSION['username']) && isset($_SESSION['password'])) {
    header('Location: admin/index.php');
    exit;
}

// Xử lý khi submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Kiểm tra thông tin đăng nhập
    if ($username == 'admin' && $password == 'admin') {
        // Lưu thông tin vào session
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;

        // Lưu thông tin vào cookie - Điểm khác biệt so với nhiệm vụ 5
        setcookie('username', $username, time() + 86400 ); // Hết hạn sau 1 ngày
        setcookie('password', $password, time() + 86400 );

        // Chuyển đến trang admin
        header('Location: admin/index.php');
        exit;
    } else {
        $error = 'Tên đăng nhập hoặc mật khẩu không đúng';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
</head>
<body>
    <?php if(isset($error)): ?>
        <div style="color: red;"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">
        <label>Tên đăng nhập:</label><br>
        <input type="text" name="username"><br><br>
        
        <label>Mật khẩu:</label><br>
        <input type="password" name="password"><br><br>

        <button type="submit">Đăng nhập</button>
        <input type="reset" value="Nhập Lại">
    </form>
</body>
</html>