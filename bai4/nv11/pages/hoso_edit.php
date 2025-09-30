<?php
include 'db.php';
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hoten = $_POST['hoten'];
    $ngaysinh = $_POST['ngaysinh'];
    $diachi = $_POST['diachi'];
    $lop = $_POST['lop'];
    $toan = $_POST['toan'];
    $ly = $_POST['ly'];
    $hoa = $_POST['hoa'];

    $sql = "UPDATE HOSO SET HOTEN='$hoten', NGAYSINH='$ngaysinh', DIACHI='$diachi', 
            LOP='$lop', DIEMTOAN=$toan, DIEMLY=$ly, DIEMHOA=$hoa WHERE MAHS='$id'";
    $conn->query($sql);
    header("Location: ?page=hoso");
}

$row = $conn->query("SELECT * FROM HOSO WHERE MAHS='$id'")->fetch_assoc();
?>
<form method="post">
    Họ tên: <input type="text" name="hoten" value="<?=$row['HOTEN']?>"><br>
    Ngày sinh: <input type="date" name="ngaysinh" value="<?=$row['NGAYSINH']?>"><br>
    Địa chỉ: <input type="text" name="diachi" value="<?=$row['DIACHI']?>"><br>
    Lớp: <input type="text" name="lop" value="<?=$row['LOP']?>"><br>
    Điểm Toán: <input type="text" name="toan" value="<?=$row['DIEMTOAN']?>"><br>
    Điểm Lý: <input type="text" name="ly" value="<?=$row['DIEMLY']?>"><br>
    Điểm Hóa: <input type="text" name="hoa" value="<?=$row['DIEMHOA']?>"><br>
    <input type="submit" value="Cập nhật">
</form>
