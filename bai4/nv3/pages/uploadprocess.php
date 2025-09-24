<?php
// Cấu hình thư mục uploads
$upload_dir = "uploads/";

// Kiểm tra thư mục uploads
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755);
}

// Lấy danh sách file từ thư mục uploads
$files = [];
if ($handle = opendir($upload_dir)) { // Gán thư mục uploads với handle $handle
    while (false !== ($file = readdir($handle))) { // Lặp qua các file trong thư mục uploads (vì hàm readdir() tra ve tên các mục trong thư mục uploads(các mục có thể là file hoặc là thư mục))
        // Bỏ qua các file đặc biệt . và ..
        if ($file == "." || $file == "..") {
            continue;
        }
        
        // Lấy thông tin file
        $filepath = $upload_dir . $file;
        if (is_file($filepath)) { // Kiểm tra đường dẫn tới mục đó thực sự là một file (true) hay là một thư mục (false)
            $files[$file] = [
                'path' => $filepath,
                'size' => filesize($filepath),
                'mtime' => filemtime($filepath)
            ];
        }
    }
    closedir($handle);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Danh sách file đã upload</title>
    <style>
        .file-list { margin: 20px 0; }
        .file-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .file-item small {
            color: #666;
        }
        .file-item a {
            text-decoration: none;
            color: #337ab7;
        }
        .file-item a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Danh sách file đã upload</h2>
    
    <?php if (!empty($files)): ?> <!--Nếu danh sách các file thu thập trước đó không trống thì tiến hành hiển thị-->
    <div class="file-list">
        <?php foreach ($files as $filename => $fileinfo): ?> <!--$filename là tên file, $fileinfo là thống tin file-->
        <div class="file-item">
            <div>
                <a href="<?= htmlspecialchars($fileinfo['path']) ?>" download>
                    <?= htmlspecialchars($filename) ?>
                </a>
            </div>
            <div>
                <small>
                    <?= date('d/m/Y H:i', $fileinfo['mtime']) ?>
                </small>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <p>Chưa có file nào trong thư mục uploads.</p>
    <?php endif; ?>
</body>
</html>