<?php
include 'libs/xuLyMaTran.php';

function validateMatrix($matrix)
{
    // Kiểm tra xem có phải mảng không rỗng
    if (!is_array($matrix))
        return false;

    // Lấy số cột của hàng đầu tiên
    $cols = count($matrix[0]);

    // Kiểm tra tất cả các hàng có cùng số lượng cột hay không
    foreach ($matrix as $row) {
        if (count($row) !== $cols)
            return false;
    }
    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["calculate"])) {
    // Chuyển đổi dữ liệu từ POST thành ma trận
    $matran1 = array_map(function ($row) {
        return array_map('floatval', $row); // chuyển ràng $row thành mảng số rồi trả thành kết quả cho function, mảng ấy lại tiếp tục
    }, $_POST["matran1"]);
    /*
    Từ trong ra ngoài:
        Trong: Áp dụng 'floatval' lên từng phần tử trong hàng $row
        Ngoài: Áp dụng function lên từng hàng của ma trận $_POST["matran1"]
    */

    $matran2 = array_map(function ($row) {
        return array_map('floatval', $row);
    }, $_POST["matran2"]);

    // Kiểm tra tính hợp lệ của ma trận
    if (!validateMatrix($matran1) || !validateMatrix($matran2)) {
        $error = "Ma trận không hợp lệ!";
    } elseif (count($matran1) !== count($matran2) || count($matran1[0]) !== count($matran2[0])) {
        $error = "Các ma trận phải có cùng kích thước!";
    } else {
        //Tính toán các kết quả
        $max1 = maxMatran($matran1);
        $max2 = maxMatran($matran2);
        $min1 = minMatran($matran1);
        $min2 = minMatran($matran2);
        $tongcheo1 = tongTrenCheoChinh($matran1);
        $tongcheo2 = tongTrenCheoChinh($matran2);
        $tongcheophu1 = tongTrenCheoPhu($matran1);
        $tongcheophu2 = tongTrenCheoPhu($matran2);
        $tongMatran = tinhMatranTong($matran1, $matran2);
        $hieuMatran = tinhMatranHieu($matran1, $matran2);
        $tichMatran = tinhMatranTich($matran1, $matran2);
    }
}
?>

<head>
    <style>
        .input-group {
            margin-bottom: 10px;
        }

        input[type="text"] {
            padding: 5px;
            width: 50px;
            margin: 2px;
        }

        table {
            border-collapse: collapse;
            margin: 10px 0;
        }

        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
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
    <h2>Sử dụng mảng để tính, tổng, tích 2 ma trận</h2>
    <form method="post">
        <div class="input-group">
            <table>
                <tr>
                    <td>Nhập Ma trận 1</td>
                    <td>Nhập Ma trận 2</td>
                </tr>
                <tr>
                    <td>
                        <?php
                        $defaultMatran1 = [[2, 2, 2], [3, 3, 3], [4, 4, 4]];
                        for ($i = 0; $i < 3; $i++) {
                            for ($j = 0; $j < 3; $j++) {
                                echo "<input type='text' name='matran1[" . $i . "][" . $j . "]' value='" . htmlspecialchars($defaultMatran1[$i][$j]) . "' size='2'>";
                            } // type='text' cho xử lý tốt hơn vì có thể nhận vào số âm. Dữ liệu từ type="number" vẫn là chuỗi (["2", "3"]), nên code xử lý không thay đổi, vẫn phụ thuộc vào array_map.
                            echo "<br>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        $defaultMatran2 = [[1, 2, 3], [4, 5, 6], [7, 8, 9]];
                        for ($i = 0; $i < 3; $i++) {
                            for ($j = 0; $j < 3; $j++) {
                                echo "<input type='text' name='matran2[" . $i . "][" . $j . "]' value='" . htmlspecialchars($defaultMatran2[$i][$j]) . "' size='2'>";
                            }
                            echo "<br>";
                        }
                        ?>
                    </td>
                </tr>
            </table>
            <br>
            <button type="submit" name="calculate">Tính</button>
        </div>
    </form>

    <?php
    if (isset($tongMatran)) {
        echo "<div class='result'>";
        echo "<h3>KẾT QUẢ:</h3>";
        // Thêm hiển thị Ma trận 1
        echo "Ma trận 1:<br>";
        echo "<table>";
        for ($i = 0; $i < count($matran1); $i++) {
            echo "<tr>";
            for ($j = 0; $j < count($matran1[0]); $j++) {
                echo "<td>" . $matran1[$i][$j] . "</td>";
            }
            echo "</tr>";
        }
        echo "</table><br>";

        // Thêm hiển thị Ma trận 2
        echo "Ma trận 2:<br>";
        echo "<table>";
        for ($i = 0; $i < count($matran2); $i++) {
            echo "<tr>";
            for ($j = 0; $j < count($matran2[0]); $j++) {
                echo "<td>" . $matran2[$i][$j] . "</td>";
            }
            echo "</tr>";
        }
        echo "</table><br>";

        // Hiển thị các kết quả từ các hàm
        echo "<h4>Kết quả từ các hàm xử lý:</h4>";

        // Max và Min
        echo "Max của Ma trận 1: " . ($max1 !== null ? $max1 : "Không thể tính") . "<br>";
        echo "Min của Ma trận 1: " . ($min1 !== null ? $min1 : "Không thể tính") . "<br>";
        echo "Max của Ma trận 2: " . ($max2 !== null ? $max2 : "Không thể tính") . "<br>";
        echo "Min của Ma trận 2: " . ($min2 !== null ? $min2 : "Không thể tính") . "<br><br>";

        // Tổng chéo chính và phụ
        echo "Tổng đường chéo chính Ma trận 1: " . ($tongcheo1 !== null ? $tongcheo1 : "Không thể tính") . "<br>";
        echo "Tổng đường chéo phụ Ma trận 1: " . ($tongcheophu1 !== null ? $tongcheophu1 : "Không thể tính") . "<br>";
        echo "Tổng đường chéo chính Ma trận 2: " . ($tongcheo2 !== null ? $tongcheo2 : "Không thể tính") . "<br>";
        echo "Tổng đường chéo phụ Ma trận 2: " . ($tongcheophu2 !== null ? $tongcheophu2 : "Không thể tính") . "<br><br>";

        // Ma trận Tổng
        echo "Ma trận Tổng:<br>";
        if ($tongMatran !== null) {
            echo "<table>";
            for ($i = 0; $i < count($tongMatran); $i++) {
                echo "<tr>";
                for ($j = 0; $j < count($tongMatran[0]); $j++) {
                    echo "<td>" . $tongMatran[$i][$j] . "</td>";
                }
                echo "</tr>";
            }
            echo "</table><br>";
        } else {
            echo "Không thể tính<br><br>";
        }

        // Ma trận Hiệu
        echo "Ma trận Hiệu:<br>";
        if ($hieuMatran !== null) {
            echo "<table>";
            for ($i = 0; $i < count($hieuMatran); $i++) {
                echo "<tr>";
                for ($j = 0; $j < count($hieuMatran[0]); $j++) {
                    echo "<td>" . $hieuMatran[$i][$j] . "</td>";
                }
                echo "</tr>";
            }
            echo "</table><br>";
        } else {
            echo "Không thể tính<br><br>";
        }

        // Ma trận Tích
        echo "Ma trận Tích:<br>";
        if ($tichMatran !== null) {
            echo "<table>";
            for ($i = 0; $i < count($tichMatran); $i++) {
                echo "<tr>";
                for ($j = 0; $j < count($tichMatran[0]); $j++) {
                    echo "<td>" . $tichMatran[$i][$j] . "</td>";
                }
                echo "</tr>";
            }
            echo "</table><br>";
        } else {
            echo "Không thể tính<br><br>";
        }
        echo "</div>";
    }
    ?>
</body>

</html>