<?php
include 'db.php';

$sql = "SELECT * FROM LOP";
$result = $conn->query($sql);
?>
<h2>Danh sách Lớp</h2>
<table border="1" cellpadding="5">
<tr><th>MALOP</th><th>TENLOP</th><th>KHOAHOC</th><th>GVCN</th><th>Thao tác</th></tr>
<?php
while($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['MALOP']}</td>
        <td>{$row['TENLOP']}</td>
        <td>{$row['KHOAHOC']}</td>
        <td>{$row['GVCN']}</td>
        <td>
            <a href='index.php?page=lopedit&id={$row['MALOP']}'>Sửa</a> |
            <a href='index.php?page=lopdelete&id={$row['MALOP']}'>Xóa</a>
        </td>
    </tr>";
}
?>
</table>
<a href="index.php?page=lopadd">Thêm lớp mới</a>
