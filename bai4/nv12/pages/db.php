<?php
$servername = "localhost";
$username = "root";   // thay bằng user MySQL của bạn
$password = "";       // thay bằng mật khẩu MySQL của bạn
$dbname = "testdb";     // tên CSDL

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
