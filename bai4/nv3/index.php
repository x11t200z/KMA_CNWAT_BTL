<?php
$page = $_GET['page'] ?? 'home'; //Mặc định là trang Home
?>
<!-- index.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Nhiệm vụ 3</title>
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
                case 'drawTable':
                    include 'pages/drawTable.php';
                    break;
                case 'loop':
                    include 'pages/loop.php';
                    break;
                case 'calculate1':
                    include 'pages/calculate1.php';
                    break;
                case 'calculate2':
                    include 'pages/calculate2.php';
                    break;
                case 'array1':
                    include 'pages/array1.php';
                    break;
                case 'array2':
                    include 'pages/array2.php';
                    break;
                case 'uploadprocess':
                    include 'pages/uploadprocess.php';
                    break;
                case 'uploadprocess':
                    include 'pages/uploadprocess.php';
                    break;
                case 'home':
                default:
                    include 'pages/home.php';
                    break;
            }
            ?>
        </div>
    </div>

    <?php include '../nv1_template/pages/footer.php'; ?>
</body>

</html>