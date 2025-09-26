<!-- index.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Trang register</title>
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
            <form action="resultRegister.php" method="post">
                Họ tên: <input type="text" name="fullname"><br>
                Email: <input type="email" name="email"><br>
                <input type="submit" value="Đăng ký">
            </form>
        </div>
    </div>

    <?php include '../nv1_template/pages/footer.php'; ?>
</body>

</html>