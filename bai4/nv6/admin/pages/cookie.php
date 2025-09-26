<?php
// Khởi tạo biến lưu trữ bookmarks từ cookie
$bookmarks = isset($_COOKIE['bookmarks']) ? json_decode($_COOKIE['bookmarks'], true) : [];

// Xử lý form thêm bookmark mới
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $url = trim($_POST['url']);

    // Kiểm tra dữ liệu đầu vào
    if (!empty($name) && !empty($url)) {
        // Thêm bookmark mới vào mảng bookmark, Toán tử [] đẩy phần tử mới vào cuối mảng mà không xóa các phần tử hiện có.
        $bookmarks[] = [
            'name' => htmlspecialchars($name),
            'url' => htmlspecialchars($url)
        ];

        // Lưu lại mảng bookmarks (đang chứa trong mảng bookmark) vào cookie (hết hạn sau 30 ngày)
        setcookie('bookmarks', json_encode($bookmarks), time() + 30 * 24 * 60 * 60, '/');
        // Bản chất cookie là file
        // file cookie này tên là 'bookmarks', trong nó value là mảng bookmarks (được chuyển thành dạng json)
        // Cookie không "nối tiếp" dữ liệu mà là ghi đè. Mảng $bookmarks được cập nhật (thêm phần tử mới vào cuối) trước khi gọi setcookie(), và toàn bộ mảng được lưu lại, giữ cả bookmark cũ và mới.
        header('Location: index.php');
        exit;
    }
}
if (isset($_GET['delete'])) {
    echo "Đã nhận tham số delete: " . $_GET['delete'];
} else {
    echo "Chưa nhận được tham số delete";
}
// Xóa bookmark
if (isset($_GET['delete']) && isset($bookmarks[$_GET['delete']])) {
    unset($bookmarks[$_GET['delete']]);
    // Cập nhật cookie sau khi xóa
    setcookie('bookmarks', json_encode($bookmarks), time() + 30 * 24 * 60 * 60, '/');

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Bookmark</title>
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .bookmark-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Quản lý Bookmark</h1>

        <!-- Form thêm bookmark mới -->
        <form method="post">
            <div>
                <label>Tên:</label><br>
                <input type="text" name="name" required>
            </div>
            <div>
                <label>URL:</label><br>
                <input type="url" name="url" required>
            </div>
            <button type="submit">Thêm</button>
        </form>


        <!-- Danh sách bookmarks -->
        <div>
            <h2>Danh sách Bookmark</h2>
            <?php foreach ($bookmarks as $index => $bookmark): ?>
            <!-- 
                vì mảng bookmarks luôn được json_encode tại các thời điểm cần đến nó nên nó sẽ luôn có cấu trúc kiểu kiểu nhưu sau:
                $bookmarks = [
                    ['name' => 'Google', 'url' => 'https://google.com'],
                    ['name' => 'Example', 'url' => 'https://example.com']
                ];
                các cặp ngoặc vuông bên trong $bookmarks tạo thành kiểu như các phần tử đơn lẻ(kiểu json), trong $bookmark có nhiều phần tử nhưu thế =>>> Đây là mảng số (numeric array)
                Do đó, trong vòng lặp foreach, $index sẽ lần lượt nhận các giá trị 0, 1, 2,... tương ứng với chỉ số của từng bookmark trong mảng.
                Mở rộng: Nếu là mảng kết hợp (associative array) thì $.... => $.... sẽ nhận theo cặp giá trị key-value tương ứng với từng phần tử trong mảng.
            -->
                <div class="bookmark-item">
                    <a href="<?php echo $bookmark['url']; ?>" target="_blank">
                        <?php echo $bookmark['name']; ?>
                    </a>
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=cookie&delete=<?php echo $index; ?>"
                        class="delete-link" onclick="return confirm('Bạn có chắc muốn xóa bookmark này?')">Xóa</a>
                    <!-- 
                        Giải thích thêm đoạn thẻ a 'Xóa' này: href sẽ dẫn đến chính trang hiện tại (index.php?page=cookie) kèm theo tham số delete với giá trị là chỉ số của bookmark hiện tại trong mảng (được lấy từ biến $index trong vòng lặp foreach).
                        $_SERVER['PHP_SELF'] chỉ trả về đường dẫn của trang hiện tại (index.php) vì trang cookie.php được nhúng trong index.php thông qua include chứ không phải cookie.php được chạy độc lập.
                        Nên nếu không có đoạn ?page=cookie& thì khi click vào link Xóa sẽ dẫn đến index.php (trang Home) chứ không phải trang cookie.php, do đó code thực thi việc xóa viết ở tít trên đầu kia sẽ không được chạy vì tham số truy vấn delete có đến được trang cookie.php đâu, nó đến trang index.php rồi.
                        -->
                </div>
            <?php endforeach; ?>

            <?php if (empty($bookmarks)): ?>
            <!-- Trường hợp nếu cookie bị xóa hoặc cookie hết hạn sẽ khiến $bookmarks trống =>> Không hiển thị được bookmark nào -->
                <p>Chưa có bookmark nào!</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>