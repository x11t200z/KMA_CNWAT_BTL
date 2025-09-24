<?php
$sum = 0;
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $lop = $_POST['lop'];
    $diem1 = $_POST['diem1'];
    $diem2 = $_POST['diem2'];
    $diem3 = $_POST['diem3'];
    $sum = $diem1 + $diem2 + $diem3;
}
?>

<form action="" method="post">
    <label for="name">Họ và tên: <input type="text" name="name"></label><br><br>
    <label for="lop">Lớp: <input type="text" name="lop"></label><br><br>
    <label for="diem1">Điểm M1: <input type="number" name="diem1" required></label><br><br>
    <label for="diem2">Điểm M2: <input type="number" name="diem2" required></label><br><br>
    <label for="diem3">Điểm M3: <input type="number" name="diem3" required></label><br><br>
    <?php echo "Tổng điểm: " .$sum; ?>
    <br><br>
    <input type="submit" name="submit" value="OK">
    <button type="button" onclick="window.location.href=window.location.href">Làm mới</button>  <!-- Phải làm mới lại trang mới reset được hiển thị-->


</form>
