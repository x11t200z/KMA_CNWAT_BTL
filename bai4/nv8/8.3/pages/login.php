<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập</title>
</head>
<body>
    <h2>Sử dụng trang practicetestautomation.com</h2>
    <form id="loginForm">
        <div>
            <label>Tên đăng nhập:</label><br>
            <input type="text" id="username" required>
        </div>
        <div>
            <label>Mật khẩu:</label><br>
            <input type="password" id="password" required>
        </div>
        <div>
            <input type="checkbox" id="rememberMe"> 
            <label>Nhớ mật khẩu</label>
        </div>
        <button type="submit">Đăng Nhập</button>
    </form>

    <script src="pages/loginprocess.js"></script>
</body>
</html>