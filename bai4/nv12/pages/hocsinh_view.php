<?php
include 'db.php';
if (isset($_GET['MaLop'])) {
    $malop = $_GET['MaLop'];

    // Lấy tên lớp
    $lop = $conn->query("SELECT TenLop FROM LOP WHERE MALOP='$malop'");
    $lopRow = $lop->fetch_assoc();

    // Lấy danh sách học sinh của lớp
    $sql = "SELECT * FROM HOSO WHERE LOP='$malop'";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Danh sách học sinh</title>
</head>

<body>
    <h2>Danh sách học sinh - Lớp <?php echo $malop; ?></h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Mã HS</th>
            <th>Họ tên</th>
            <th>Ngày sinh</th>
            <th>Địa chỉ</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['MAHS']; ?></td>
                <td><?php echo $row['HOTEN']; ?></td>
                <td><?php echo $row['NGAYSINH']; ?></td>
                <td><?php echo $row['DIACHI']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <a href="?page=lop">← Quay lại danh sách lớp</a>
</body>

</html>