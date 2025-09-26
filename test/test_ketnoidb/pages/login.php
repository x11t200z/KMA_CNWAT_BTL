<!-- login.php -->
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Kết nối CSDL
    $servername = "localhost";
    $usernamedb = "root";
    $passworddb = "";
    $dbname = "testdb";

    $conn = new mysqli($servername, $usernamedb, $passworddb, $dbname);
    if ($conn->connect_error) {
        die("Ket noi that bai:" . $conn->connect_error);
    }

    // Xử lý khi submit form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Kiểm tra thông tin đăng nhập
    $sql = "SELECT * FROM users WHERE username='$username' AND password=MD5('$password')";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) { // Đăng nhập thành công, chuyển đến trang admin
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header('Location: admin/index.php');
        exit;
    } else {
        $error = 'Tên đăng nhập hoặc mật khẩu không đúng';
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
</head>

<body>
    <?php if (isset($error)): ?>
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