<?php
$servername = "localhost"; // Đổi lại địa chỉ servername nếu cần
$username = "root";
$password = ""; // Đảm bảo nhập đúng mật khẩu nếu database yêu cầu
$dbname = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
    
    // Test PHP version
    echo "PHP Version: " . phpversion();
}
?>