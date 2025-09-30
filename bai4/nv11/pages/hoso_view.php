<?php
include 'db.php';


$sql = "SELECT * FROM HOSO";
$result = $conn->query($sql);

?>
<h2>Danh sách Học sinh</h2>
<table border="1" cellpadding="5">
<tr><th>MAHS</th><th>HOTEN</th><th>NGAYSINH</th><th>DIACHI</th><th>LOP</th><th>TOÁN</th><th>LÝ</th><th>HÓA</th><th>Thao tác</th></tr>
<?php
while($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['MAHS']}</td>
        <td>{$row['HOTEN']}</td>
        <td>{$row['NGAYSINH']}</td>
        <td>{$row['DIACHI']}</td>
        <td>{$row['LOP']}</td>
        <td>{$row['DIEMTOAN']}</td>
        <td>{$row['DIEMLY']}</td>
        <td>{$row['DIEMHOA']}</td>
        <td>
            <a href='index.php?page=hosoedit&id={$row['MAHS']}'>Sửa</a> |
            <a href='index.php?page=hosodelete&id={$row['MAHS']}'>Xóa</a>
        </td>
    </tr>";
}
?>
</table>
<br>
<a href="index.php?page=hosoadd">Thêm học sinh mới</a>
