<?php
// Khởi tạo session
session_start();

// Xử lý chọn ngôn ngữ
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'] === 'en' ? 'en' : 'vi';
    header('Location: index.php?page=' . ($_GET['page'] ?? 'home')); // Redirect về trang hiện tại
    exit;
}

// Check session ngôn ngữ, mặc định 'vi'
$lang = $_SESSION['lang'] ?? 'vi';

// Include file ngôn ngữ
$languageFile = 'lang/' . ($lang === 'en' ? 'english' : 'vietnamese') . '.php';
if (!file_exists($languageFile)) {
    die('File ngôn ngữ không tồn tại: ' . $languageFile);
}
include $languageFile;
$page = $_GET['page'] ?? 'home'; // Mặc định là trang Home
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <title>Nhiệm vụ 10</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .lang-switch {
            text-align: right;
            padding: 10px;
        }
    </style>
</head>
<body>
    <?php include '../nv1_template/pages/head.php'; ?>
    <?php include 'menu.php'; ?>

    <!-- Link chọn ngôn ngữ -->
    <div class="lang-switch">
        <a href="index.php?page=<?php echo $page; ?>&lang=vi"><?php echo VIETNAMESE; ?></a> |
        <a href="index.php?page=<?php echo $page; ?>&lang=en"><?php echo ENGLISH; ?></a>
    </div>

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