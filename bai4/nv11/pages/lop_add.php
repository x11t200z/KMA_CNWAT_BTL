<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $malop = $_POST['malop'];
    $tenlop = $_POST['tenlop'];
    $khoahoc = $_POST['khoahoc'];
    $gvcn = $_POST['gvcn'];
    $sql = "INSERT INTO LOP VALUES('$malop', '$tenlop', $khoahoc, '$gvcn')";
    $conn->query($sql);
    header("Location: ?page=lop");
}
?>
<form method="post">
    Mã lớp: <input type="text" name="malop"><br>
    Tên lớp: <input type="text" name="tenlop"><br>
    Khóa học: <input type="number" name="khoahoc"><br>
    GVCN: <input type="text" name="gvcn"><br>
    <input type="submit" value="Thêm mới">
</form>
