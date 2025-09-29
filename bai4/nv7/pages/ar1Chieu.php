<?php
include 'libs/xuLyMangSo.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["calculate"])) {
    /*
    Lấy chuỗi số từ form ($_POST["numbers"]).
    Chuyển đổi mỗi chuỗi con thành số thực, áp dụng hàm floatval.
    Lưu kết quả vào mảng $numbers để xử lý tiếp.
     */
    $numbers = array_map('floatval', $_POST["numbers"]);
    $tong = array_sum($numbers);
    $trungBinh = avgMang($numbers);
    $min = minMang($numbers);
    $max = maxMang($numbers);
    $sorted = sortMang($numbers);
    $reversed = daoNguocMang($numbers);
}
?>

<!DOCTYPE html>
<html>

<head>
    <style>
        input[type="text"] {
            padding: 5px;
            width: 30px;
            margin: 2px;
        }

        .result {
            margin-top: 20px;
        }

        button {
            padding: 5px 10px;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <h2>Thao tác trên mảng 1 chiều:</h2>
    <form method="post">
        <div class="input-group">
            Bài toán: nhập vào chuỗi số: tính tổng các số, giá trị trung bình, tìm min, max, trung bình cộng.<br><br>
            <?php
            $defaultNumbers = [0, 1, 3, 9, 5, 2, 7, 2, 6, 8];
            for ($i = 0; $i < count($defaultNumbers); $i++) {
                echo "<input type='text' name='numbers[]' value='" . htmlspecialchars($defaultNumbers[$i]) . "' size='2'>";
            }
            ?>
            <br><br>
            <button type="submit" name="calculate">Calculate</button>
            <button type="reset">Reset</button>
        </div>
    </form>

    <?php
    if (isset($tong)) {
        echo "<div class='result'>";
        echo "<h3>KẾT QUẢ:</h3>";

        // In mảng gốc
        echo "Mảng gốc: " . implode(', ', $numbers) . "<br><br>";

        // Kết quả từ các hàm xử lý
        echo "Tổng: " . ($tong !== null ? $tong : "Không thể tính") . "<br>";
        echo "Trung bình: " . ($trungBinh !== null ? number_format($trungBinh, 2) : "Không thể tính") . "<br>";
        echo "Min: " . ($min !== null ? $min : "Không thể tính") . "<br>";
        echo "Max: " . ($max !== null ? $max : "Không thể tính") . "<br><br>";

        // Mảng sắp xếp tăng dần
        echo "Mảng sắp xếp tăng dần: ";
        if ($sorted !== null) {
            echo implode(', ', $sorted) . "<br><br>";
        } else {
            echo "Không thể tính<br><br>";
        }

        // Mảng đảo ngược
        echo "Mảng đảo ngược: ";
        if ($reversed !== null) {
            echo implode(', ', $reversed) . "<br><br>";
        } else {
            echo "Không thể tính<br><br>";
        }

        echo "</div>";
    }
    ?>
</body>

</html>