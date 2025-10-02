<?php
$page = $_GET['page'] ?? 'home'; //Mặc định là trang Home
?>
<?php
include 'db.php';

// Lấy danh mục sản phẩm
$categories = $conn->query("SELECT * FROM Category");

// Lấy mỗi loại 2 sản phẩm mới nhất
$productsByCategory = [];
if ($categories) {
    while ($cat = $categories->fetch_assoc()) {
        $catId = $cat['CategoryID'];
        $sql = "SELECT * FROM Product 
                WHERE CategoryID = $catId 
                ORDER BY CreatedAt DESC 
                LIMIT 2";
        $result = $conn->query($sql);
        $productsByCategory[$cat['CategoryName']] = [
            "id" => $catId,
            "items" => $result ? $result->fetch_all(MYSQLI_ASSOC) : []
        ];
    }
}
if (isset($_GET['min_price']) || isset($_GET['max_price']) || isset($_GET['category_id']) || isset($_GET['sort']) || isset($_GET['keyword'])) {
    header("Location: productSearch.php?" . $_SERVER['QUERY_STRING']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Trang chủ - Bán Laptop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: block;
            height: 100%;
        }

        .container {
            display: flex;
        }

        .header {
            width: 100%;
            background: #007bff;
            padding: 10px 0px;
            color: white;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            /* không cố định nữa */
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header form {
            margin: 0;
        }

        .header input[type="text"] {}

        .header button {
            background: rgba(222, 222, 222, 1);
            border: none;
            cursor: pointer;
        }

        a:visited {
            color: inherit;
        }
    </style>
</head>

<body>
    <!-- Tìm kiếm sản phẩm -->
    <div class="header">
        <a href="index.php" style="text-decoration: none;">
            <h1>AT190447 - Website Bán Laptop</h1>
        </a>

        <!-- <form action="productSearch.php" method="get">
            <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm..." required>
            <button type="submit">Tìm</button>
        </form> -->
        <form action="index.php" method="get" class="search-form">
            <input type="hidden" name="page" value="productSearch">
            <input type="text" name="keyword" placeholder="Tìm sản phẩm...">
            <button type="submit">Tìm kiếm</button>
        </form>
        <a href="cart.php">🛒Giỏ hàng</a>
        <a href="login.php">Đăng nhập</a>
    </div>
    <div class="container">
        <?php
        switch ($page) {
            case 'home':
                include 'pages/home.php';
                break;
            case 'productSearch':
                include 'productSearch.php';
                break;
            // case 'productDetail':
            //     include 'productDetail.php';
            //     break;
            default:
                'home';
                include 'pages/home.php';
                break;
        }
        ?>
    </div>
    <footer>
        <div style="text-align: center; padding: 10px; background: #333; color: white;">
            &copy; 2025 Website Bán Laptop. Lưu Đức Thắng - AT190447.
        </div>
    </footer>
</body>

</html>