<!-- index.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Trang resultRegister</title>
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
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];

            echo "<h2>Kết quả đăng ký:</h2>";
            echo "Họ tên: $fullname <br>";
            echo "Email: $email <br>";
            ?>
        </div>
    </div>

    <?php include '../nv1_template/pages/footer.php'; ?>
</body>

</html>