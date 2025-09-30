<?php
$page = $_GET['page'] ?? 'home'; //Mặc định là trang Home
?>
<!-- index.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Nhiệm vụ 11</title>
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
                case 'lop':
                    include 'pages/lop_view.php';
                    break;
                case 'lopedit':
                    include 'pages/lop_edit.php';
                    break;
                case 'lopadd':
                    include 'pages/lop_add.php';
                    break;
                case 'lopdelete':
                    include 'pages/lop_delete.php';
                    break;
                case 'hoso':
                    include 'pages/hoso_view.php';
                    break;
                case 'hosoedit':
                    include 'pages/hoso_edit.php';
                    break;
                case 'hosoadd':
                    include 'pages/hoso_add.php';
                    break;
                case 'hosodelete':
                    include 'pages/hoso_delete.php';
                    break;
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