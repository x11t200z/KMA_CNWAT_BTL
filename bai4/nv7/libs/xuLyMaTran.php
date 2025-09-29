<?php
// Hàm tìm giá trị lớn nhất trong ma trận
function maxMatran($mang2Chieu) {
    if (empty($mang2Chieu)) {
        return null;
    }
    $max = $mang2Chieu[0][0];
    foreach ($mang2Chieu as $row) {
        foreach ($row as $value) {
            if ($value > $max) {
                $max = $value;
            }
        }
    }
    return $max;
}

// Hàm tìm giá trị nhỏ nhất trong ma trận
function minMatran($mang2Chieu) {
    if (empty($mang2Chieu)) {
        return null;
    }
    $min = $mang2Chieu[0][0];
    foreach ($mang2Chieu as $row) {
        foreach ($row as $value) {
            if ($value < $min) {
                $min = $value;
            }
        }
    }
    return $min;
}

// Hàm tính tổng các phần tử trên đường chéo chính
function tongTrenCheoChinh($mang2Chieu) {
    if (empty($mang2Chieu)) {
        return null;
    }
    $sum = 0;
    $n = count($mang2Chieu);
    for ($i = 0; $i < $n; $i++) {
        $sum += $mang2Chieu[$i][$i];
    }
    return $sum;
}

// Hàm tính tổng các phần tử trên đường chéo phụ
function tongTrenCheoPhu($mang2Chieu) {
    if (empty($mang2Chieu)) {
        return null;
    }
    $sum = 0;
    $n = count($mang2Chieu);
    for ($i = 0; $i < $n; $i++) {
        $sum += $mang2Chieu[$i][$n - 1 - $i];
    }
    return $sum;
}

// Hàm tính tổng của hai ma trận
function tinhMatranTong($matran1, $matran2) {
    if (empty($matran1) || empty($matran2) || count($matran1) != count($matran2) || count($matran1[0]) != count($matran2[0])) {
        return null;
    }
    $result = [];
    $rows = count($matran1);
    $cols = count($matran1[0]);
    for ($i = 0; $i < $rows; $i++) {
        $row = [];
        for ($j = 0; $j < $cols; $j++) {
            $row[] = $matran1[$i][$j] + $matran2[$i][$j];
        }
        $result[] = $row;
    }
    return $result;
    
}// Hàm tính hiệu của hai ma trận
function tinhMatranHieu($matran1, $matran2) {
    if (empty($matran1) || empty($matran2) || count($matran1) != count($matran2) || count($matran1[0]) != count($matran2[0])) {
        return null;
    }
    $result = [];
    $rows = count($matran1);
    $cols = count($matran1[0]);
    for ($i = 0; $i < $rows; $i++) {
        $row = [];
        for ($j = 0; $j < $cols; $j++) {
            $row[] = $matran1[$i][$j] - $matran2[$i][$j];
        }
        $result[] = $row;
    }
    return $result;
}

// Hàm tính tích của hai ma trận
function tinhMatranTich($matran1, $matran2) {
    if (empty($matran1) || empty($matran2) || count($matran1[0]) != count($matran2)) {
        return null;
    }
    $result = [];
    $rows1 = count($matran1);
    $cols1 = count($matran1[0]);
    $cols2 = count($matran2[0]);
    for ($i = 0; $i < $rows1; $i++) {
        $row = [];
        for ($j = 0; $j < $cols2; $j++) {
            $sum = 0;
            for ($k = 0; $k < $cols1; $k++) {
                $sum += $matran1[$i][$k] * $matran2[$k][$j];
            }
            $row[] = $sum;
        }
        $result[] = $row;
    }
    return $result;
}
?>