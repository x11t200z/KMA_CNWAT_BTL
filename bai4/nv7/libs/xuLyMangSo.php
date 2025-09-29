<?php
// Hàm tìm giá trị nhỏ nhất trong mảng số
function minMang($mangSo) {
    if (empty($mangSo)) {
        return null;
    }
    return min($mangSo);
}

// Hàm tìm giá trị lớn nhất trong mảng số
function maxMang($mangSo) {
    if (empty($mangSo)) {
        return null;
    }
    return max($mangSo);
}

// Hàm tính trung bình cộng của mảng số
function avgMang($mangSo) {
    if (empty($mangSo)) {
        return null;
    }
    return array_sum($mangSo) / count($mangSo);
}

// Hàm sắp xếp mảng số theo thứ tự tăng dần
function sortMang($mangSo) {
    $result = $mangSo;
    sort($result);
    return $result;
}

// Hàm đảo ngược mảng số
function daoNguocMang($mangSo) {
    return array_reverse($mangSo);
}
?>