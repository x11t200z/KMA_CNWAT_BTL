<!-- index.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Nhiệm vụ 1 - Template</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <?php include 'pages/head.php'; ?>
    <?php include 'pages/menu.php'; ?>

    <div style="display:flex;">
        <div style="width:20%;">
            <?php include 'pages/left.php'; ?>
        </div>
        <div style="width:80%; padding: 30px;">
            <?php include 'pages/center.php'; ?>
        </div>
    </div>

    <?php include 'pages/footer.php'; ?>
</body>

</html>