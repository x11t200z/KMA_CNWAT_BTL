<?php
session_start();
include 'db.php'; // file kết nối CSDL

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Truy vấn kiểm tra tài khoản
    $sql = "SELECT * FROM user WHERE Username = '$username' AND Password = '$password' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Lưu thông tin session
        $_SESSION['UserID'] = $row['UserID'];
        $_SESSION['Username'] = $row['Username'];
        $_SESSION['Role'] = $row['Role'];

        // Điều hướng theo quyền
        if ($row['Role'] === 'admin') {

            header("Location:./admin/index.php"); // trang quản trị
            exit;
        } else {
            echo "<script>
                alert('Đăng nhập thành công!');
                window.location.href = 'index.php';
            </script>";
            header("Location: index.php"); // quay về trang mua hàng
            exit;
        }
    } else {
        echo "<p style='color:red;'>Sai tên đăng nhập hoặc mật khẩu!</p>";
        echo "<a href='login.php'>Quay lại</a>";
    }
}
?>