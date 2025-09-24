<style>
    table {
        border-collapse: collapse;
        margin-top: 20px;
    }

    td {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
    }

    .form-box {
        border: 1px solid #ccc;
        padding: 15px;
        width: 250px;
        margin-bottom: 20px;
    }
</style>
<h2>Trang DrawTable:</h2>

<div class="form-box">
    <form method="post">
        Số dòng: <input type="number" name="rows" required><br><br>
        Số cột: <input type="number" name="cols" required><br><br>
        <input type="reset" value="Nhập Lại">
        <input type="submit" name="draw" value="Vẽ">
    </form>
</div>

<?php
if (isset($_POST['draw'])) {
    $rows = (int) $_POST['rows'];
    $cols = (int) $_POST['cols'];

    if ($rows > 0 && $cols > 0) { // Kiểm tra xem người dùng nhập vào số hàng, cột có dương không
        echo "<table>";
        for ($i = 1; $i <= $rows; $i++) {
            echo "<tr>";
            for ($j = 1; $j <= $cols; $j++) {
                echo "<td>$j</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Vui lòng nhập số dòng và số cột hợp lệ!</p>";
    }
}
?>