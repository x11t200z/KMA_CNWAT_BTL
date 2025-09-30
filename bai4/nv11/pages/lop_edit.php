<?php
include 'db.php';

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tenlop = $_POST['tenlop'];
    $khoahoc = $_POST['khoahoc'];
    $gvcn = $_POST['gvcn'];
    $sql = "UPDATE LOP SET TENLOP='$tenlop', KHOAHOC=$khoahoc, GVCN='$gvcn' WHERE MALOP='$id'";
    $conn->query($sql);
    header("Location: ?page=lop");
    exit;
}
$result = $conn->query("SELECT * FROM LOP WHERE MALOP='$id'");
$row = $result->fetch_assoc();
?>
<form method="post">
    Tên lớp: <input type="text" name="tenlop" value="<?=$row['TENLOP']?>"><br>
    Khóa học: <input type="number" name="khoahoc" value="<?=$row['KHOAHOC']?>"><br>
    GVCN: <input type="text" name="gvcn" value="<?=$row['GVCN']?>"><br>
    <input type="submit" value="Cập nhật">
</form>
