<!-- index.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Trang Calculate</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <?php include '../nv1_template/pages/head.php'; ?>
    <?php include '../nv1_template/pages/menu.php'; ?>

    <div style="display:flex;">
        <div style="width:20%;">
            <?php include '../nv1_template/pages/left.php'; ?>
        </div>
        <div style="width:80%; padding: 30px;">
            <?php
            // Giai thừa của 10
            $factorial = 1;
            for ($i = 1; $i <= 10; $i++) {
                $factorial *= $i;
            }

            // Diện tích hình tròn bán kính 10
            $r = 10;
            $area = pi() * pow($r, 2);

            // Thể tích khối cầu bán kính 10
            $volume = (4 / 3) * pi() * pow($r, 3);

            echo "Giai thừa của 10 = $factorial <br>";
            echo "Diện tích hình tròn bán kính 10 = $area <br>";
            echo "Thể tích khối cầu bán kính 10 = $volume <br>";

            // Dòng chữ Hello chuyển động (dùng marquee cho đơn giản)
            echo '<marquee>Hello</marquee>';
            ?>
        </div>
    </div>

    <?php include '../nv1_template/pages/footer.php'; ?>
</body>

</html>