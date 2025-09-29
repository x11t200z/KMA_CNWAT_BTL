<?php
// Khởi tạo biến lưu trữ thông báo
$thongBao = '';

// Xử lý khi submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $ten = trim($_POST['ten']);
    $diaChi = trim($_POST['diaChi']);
    $tuoi = trim($_POST['tuoi']);

    // Kiểm tra tính hợp lệ của dữ liệu
    if (empty($ten) || empty($diaChi) || empty($tuoi)) {
        $thongBao = "Vui lòng điền đầy đủ thông tin!";
    } elseif (!is_numeric($tuoi) || $tuoi < 0) {
        $thongBao = "Tuổi phải là số và không âm!";
    } else {
        // Mở file để thêm dữ liệu
        $file = fopen("student.txt", "a");
        if ($file) {
            // Thêm dữ liệu vào file
            fwrite($file, "\n"); // Phòng trường hợp file không có dòng mới ở cuối thì thêm dòng nây
            fwrite($file, $ten . "\n");
            fwrite($file, $diaChi . "\n");
            fwrite($file, $tuoi . "\n");
            fclose($file);
            $thongBao = "Đã thêm sinh viên thành công!";
        } else {
            $thongBao = "Không thể mở file để ghi!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <style>
        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            padding: 5px;
            width: 300px;
        }

        .thong-bao {
            margin-top: 20px;
            padding: 10px;
            border-radius: 4px;
        }

        .thanh-cong {
            background-color: #dff0d8;
        }

        .loi {
            background-color: #f2dede;
        }
    </style>
</head>

<body>
    <h1>Thêm sinh viên</h1>
    <form method="post">
        <div class="form-group">
            <label for="ten">Tên Sinh Viên:</label>
            <input type="text" id="ten" name="ten" required>
        </div>
        <div class="form-group">
            <label for="diaChi">Địa Chỉ:</label>
            <input type="text" id="diaChi" name="diaChi" required>
        </div>
        <div class="form-group">
            <label for="tuoi">Tuổi:</label>
            <input type="number" id="tuoi" name="tuoi" required>
        </div>
        <button type="submit">Thêm Sinh Viên</button>
    </form>

    <?php if ($thongBao) { ?>
        <div class="thong-bao <?php echo strpos($thongBao, 'thành công') !== false ? 'thanh-cong' : 'loi'; ?>">
            <?php echo $thongBao; ?>
        </div>
    <?php } ?>
</body>

</html>