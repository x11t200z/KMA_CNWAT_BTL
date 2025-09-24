<?php
$result = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a = isset($_POST['a']) ? (int) $_POST['a'] : 0;
    $b = isset($_POST['b']) ? (int) $_POST['b'] : 0;
    $operator = $_POST['operator'] ?? '';
    switch ($operator) {
        case '+':
            $result = "$a + $b = " . ($a + $b);
            break;
        case '-':
            $result = "$a - $b = " . ($a - $b);
            break;
        case '*':
            $result = "$a * $b = " . ($a * $b);
            break;
        case '/':
            if ($b == 0) {
                $result = "Không thể chia cho 0";
            } else {
                $result = "$a / $b = " . ($a / $b);
            }
            break;
        default:
            $result = "Vui lòng chọn phép tính.";
    }
}
?>
<style>
    label {
        margin-right: 10px;
    }
    form {
        margin-top: 20px;
    }
</style>
<h3>Trang tính toán</h3>
<form method="post" action="">
    <input type="number" name="a" required>
    <input type="number" name="b" required>
    <br>
    <label><input type="radio" name="operator" value="+">+</label>
    <label><input type="radio" name="operator" value="-">-</label>
    <label><input type="radio" name="operator" value="*">*</label>
    <label><input type="radio" name="operator" value="/">/</label>
    <br><br>
    <button type="submit" class="button">Caculate</button>
    <br><br>
    <strong>Kết quả: </strong>
    <?php
    echo $result;
    ?>
</form>