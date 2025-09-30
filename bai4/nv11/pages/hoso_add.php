<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mahs = $_POST['mahs'];
    $hoten = $_POST['hoten'];
    $ngaysinh = $_POST['ngaysinh'];
    $diachi = $_POST['diachi'];
    $lop = $_POST['lop'];
    $toan = $_POST['toan'];
    $ly = $_POST['ly'];
    $hoa = $_POST['hoa'];

    $sql = "INSERT INTO HOSO VALUES('$mahs', '$hoten', '$ngaysinh', '$diachi', '$lop', $toan, $ly, $hoa)";
    $conn->query($sql);
    header("Location: ?page=hoso");
}
?>
<form method="post">
    Mã HS: <input type="text" name="mahs"><br>
    Họ tên: <input type="text" name="hoten"><br>
    Ngày sinh: <input type="date" name="ngaysinh"><br>
    Địa chỉ: <input type="text" name="diachi"><br>
    Lớp: <input type="text" name="lop"><br>
    Điểm Toán: <input type="text" name="toan"><br>
    Điểm Lý: <input type="text" name="ly"><br>
    Điểm Hóa: <input type="text" name="hoa"><br>
    <input type="submit" value="Thêm mới">
</form>
