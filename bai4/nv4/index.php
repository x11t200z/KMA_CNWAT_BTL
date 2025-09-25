<?php
$page = $_GET['page'] ?? 'home'; //Mặc định là trang Home
?>
<!-- index.php -->
<!DOCTYPE html>
<html>
<title>Nhiệm vụ 4</title>

<head>
    <meta charset="UTF-8">
    <title>Website Demo</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <?php include '../nv1_template/pages/head.php'; ?>
    <?php include 'menu.php'; ?>
    <div style="display:flex;">
        <div style="width:20%;">
            <?php include '../nv1_template/pages/left.php'; ?>
        </div>
        <div style="width:80%; padding: 30px;">
            <?php 
            switch ($page) {
                case 'home':
                    include 'pages/home.php';
                    break;
                case 'register':
                    include 'pages/register.php';
                    break;
                case 'registerProcess':
                    include 'pages/registerProcess.php';
                    break;
                case 'contact':
                    include 'pages/contact.php';
                    break;
            }
            ?>

        </div>
    </div>

    <?php include '../nv1_template/pages/footer.php'; ?>
</body>

</html>