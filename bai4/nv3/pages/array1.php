<?php
$resultSum = $resultSub = $resultMul = [];

if (isset($_POST['submit'])) {
    $rows = 3;
    $cols = 3;

    // Lấy dữ liệu từ form
    $A = $_POST['A'];
    $B = $_POST['B'];

    // Tính tổng và hiệu
    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < $cols; $j++) {
            $resultSum[$i][$j] = $A[$i][$j] + $B[$i][$j];
            $resultSub[$i][$j] = $A[$i][$j] - $B[$i][$j];
        }
    }

    // Tính tích
    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < $cols; $j++) {
            $resultMul[$i][$j] = 0;
            for ($k = 0; $k < $cols; $k++) {
                $resultMul[$i][$j] += $A[$i][$k] * $B[$k][$j];
            }
        }
    }
}
?>
<style>
    input {
        width: 50px;
    }
</style>
<form method="post">
    <h3>Nhập Ma trận 1</h3>
    <?php for ($i = 0; $i < 3; $i++): ?>
        <?php for ($j = 0; $j < 3; $j++): ?>
            <input type="number" name="A[<?php echo $i; ?>][<?php echo $j; ?>]" size="4" required>
        <?php endfor; ?>
        <br>
    <?php endfor; ?>

    <h3>Nhập Ma trận 2</h3>
    <?php for ($i = 0; $i < 3; $i++): ?>
        <?php for ($j = 0; $j < 3; $j++): ?>
            <input type="number" name="B[<?php echo $i; ?>][<?php echo $j; ?>]" size="4" required>
        <?php endfor; ?>
        <br>
    <?php endfor; ?>

    <br>
    <input type="submit" name="submit" value="Tính">
    <input type="reset" value="Nhập Lại">
</form>

<?php
    if (!empty($resultSum)) {
    echo "<h3>KẾT QUẢ</h3>";

    echo "<p><b>Ma trận Tổng:</b></p>";
    foreach ($resultSum as $row) {
        echo implode(" ", $row) . "<br>";
    }

    echo "<p><b>Ma trận Hiệu:</b></p>";
    foreach ($resultSub as $row) {
        echo implode(" ", $row) . "<br>";
    }

    echo "<p><b>Ma trận Tích:</b></p>";
    foreach ($resultMul as $row) {
        echo implode(" ", $row) . "<br>";
    }
}
?>