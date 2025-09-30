<?php
$page = $_GET['page'] ?? 'home'; //Mặc định là trang Home
?>
<!-- index.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Nhiệm vụ 9</title>
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
                case 'list':
                    include 'pages/list.php';
                    break;
                case 'detail':
                    include 'pages/detail.php';
                    break;
                case 'edit':
                    include 'pages/edit.php';
                    break;
                case 'add':
                    include 'pages/add.php';
                    break;
                // case 'delete':
                //     include 'pages/delete.php';
                //     break;
                default:
                    'home';
                    include 'pages/home.php';
                    break;
            }
            ?>

        </div>
    </div>

    <?php include '../nv1_template/pages/footer.php'; ?>
</body>

</html>