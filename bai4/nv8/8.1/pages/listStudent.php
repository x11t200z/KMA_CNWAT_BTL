<?php
// Khởi tạo mảng để lưu dữ liệu sinh viên
$sinhVien = array();

// Đọc file và xử lý dữ liệu
if ($file = fopen("student.txt", "r")) {
    $stt = 1;  // Biến đếm STT
    while (!feof($file)) {
        // Đọc 3 dòng liên tiếp cho mỗi sinh viên
        $ten = trim(fgets($file));
        if ($ten === '')
            continue; // Bỏ qua nếu dòng đầu là trống

        $diaChi = trim(fgets($file));
        if ($diaChi === '')
            continue; // Bỏ qua nếu dòng địa chỉ là trống

        $tuoi = trim(fgets($file));
        if ($tuoi === '')
            continue; // Bỏ qua nếu dòng tuổi là trống

        // Kiểm tra dữ liệu không rỗng
        if ($ten && $diaChi && $tuoi) {
            $sinhVien[] = array(
                'stt' => $stt++,
                'ten' => $ten,
                'diaChi' => $diaChi,
                'tuoi' => $tuoi
            );
        }
    }
    fclose($file);
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <h1>Danh sách sinh viên</h1>
    <table>
        <tr>
            <th>STT</th>
            <th>Tên sinh viên</th>
            <th>Địa chỉ</th>
            <th>Tuổi</th>
        </tr>
        <?php foreach ($sinhVien as $sv) { ?>
            <tr>
                <td><?php echo $sv['stt']; ?></td>
                <td><?php echo $sv['ten']; ?></td>
                <td><?php echo $sv['diaChi']; ?></td>
                <td><?php echo $sv['tuoi']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>