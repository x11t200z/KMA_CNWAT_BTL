<?php
$page = $_GET['page'] ?? 'home'; //Mặc định là trang Home
?>
<!-- index.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Nhiệm vụ 8</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <?php include '../../nv1_template/pages/head.php'; ?>
    <?php include 'menu.php'; ?>
    <div style="display:flex;">
        <div style="width:20%;">
            <?php include '../../nv1_template/pages/left.php'; ?>
        </div>
        <div style="width:80%; padding: 30px;">
            <?php
            switch ($page) {
                case 'home':
                    include 'pages/home.php';
                    break;
                case 'listStudent':
                    include 'pages/listStudent.php';
                    break;
                case 'addStudent':
                    include 'pages/addStudent.php';
                    break;
                default: 'home';
                    include 'pages/home.php';
                    break;
            }
            ?>

        </div>
    </div>

    <?php include '../../nv1_template/pages/footer.php'; ?>
</body>

</html>