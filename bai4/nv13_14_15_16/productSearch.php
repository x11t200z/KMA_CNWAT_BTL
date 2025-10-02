<?php
session_start();
include 'db.php';

// Xử lý parameters từ GET
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$min_price = isset($_GET['min_price']) ? (int)$_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) ? (int)$_GET['max_price'] : 0;
$category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'default'; // 'asc', 'desc', hoặc 'default'

// Fetch categories cho filter
$cat_sql = "SELECT * FROM Category";
$cat_result = $conn->query($cat_sql);
$categories = [];
while ($cat_row = $cat_result->fetch_assoc()) {
    $categories[] = $cat_row;
}

// Xây dựng SQL động
$sql = "SELECT * FROM Product";
$where_conditions = [];
$params = [];

if (!empty($keyword)) {
    $where_conditions[] = "ProductName LIKE '%" . $conn->real_escape_string($keyword) . "%'";
}
if ($min_price > 0) {
    $where_conditions[] = "Price >= " . $min_price;
}
if ($max_price > 0) {
    $where_conditions[] = "Price <= " . $max_price;
}
if ($category_id > 0) {
    $where_conditions[] = "CategoryID = " . $category_id;
}

if (!empty($where_conditions)) {
    $sql .= " WHERE " . implode(" AND ", $where_conditions);
}

if ($sort === 'asc') {
    $sql .= " ORDER BY Price ASC";
} elseif ($sort === 'desc') {
    $sql .= " ORDER BY Price DESC";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Kết quả tìm kiếm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            grid-template-columns: 1fr 3fr; /* Sidebar 25%, nội dung 75% */
            padding: 20px;
            gap: 20px;
            box-sizing: border-box;
        }
        .sidebar {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            height: fit-content;
        }
        .sidebar h3 {
            margin-top: 0;
        }
        .sidebar label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .sidebar input, .sidebar select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .sidebar button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .sidebar button:hover {
            background-color: #0056b3;
        }
        .main-content {
            padding: 0;
        }
        .filters-info {
            background-color: #e9ecef;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .filters-info a {
            color: #007bff;
            text-decoration: none;
        }
        li {
            margin-bottom: 15px;
            background-color: darkgray;
            border-radius: 8px;
            padding: 10px;
            list-style: none;
        }
        li:hover {
            background-color: lightgray;
        }
        li a {
            text-decoration: none;
            color: black;
            display: flex;
        }
        .product-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #333;
            margin: 5px 0;
        }
        .product-link img {
            margin-right: 10px;
            border-radius: 5px;
        }
        .product-text {
            font-size: 16px;
        }
        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr; /* Stack trên mobile */
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar: Bộ lọc -->
        <div class="sidebar">
            <h3>Bộ lọc</h3>
            
            <form method="GET">
                <!-- Keyword (giữ nguyên) -->
                <?php if (!empty($keyword)): ?>
                    <input type="hidden" name="keyword" value="<?php echo htmlspecialchars($keyword); ?>">
                <?php endif; ?>
                
                <!-- Khoảng giá -->
                <label for="min_price">Giá tối thiểu (VNĐ):</label>
                <input type="number" id="min_price" name="min_price" value="<?php echo $min_price; ?>" min="0" step="100000">
                
                <label for="max_price">Giá tối đa (VNĐ):</label>
                <input type="number" id="max_price" name="max_price" value="<?php echo $max_price; ?>" min="0" step="100000">
                
                <!-- Category -->
                <label for="category_id">Hãng sản xuất:</label>
                <select id="category_id" name="category_id">
                    <option value="0">Tất cả</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat['CategoryID']; ?>" <?php echo ($category_id == $cat['CategoryID']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat['CategoryName']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <!-- Sắp xếp -->
                <label for="sort">Sắp xếp theo giá:</label>
                <select id="sort" name="sort">
                    <option value="default" <?php echo ($sort == 'default') ? 'selected' : ''; ?>>Mặc định</option>
                    <option value="asc" <?php echo ($sort == 'asc') ? 'selected' : ''; ?>>Tăng dần</option>
                    <option value="desc" <?php echo ($sort == 'desc') ? 'selected' : ''; ?>>Giảm dần</option>
                </select>
                
                <button type="submit">Áp dụng bộ lọc</button>
            </form>
            
            <br>
            <a href="?<?php echo !empty($keyword) ? 'keyword=' . urlencode($keyword) : ''; ?>">Xóa bộ lọc</a>
        </div>
        
        <!-- Nội dung chính -->
        <div class="main-content">
            <h2>Kết quả tìm kiếm cho: "<?php echo htmlspecialchars($keyword); ?>"</h2>
            
            <!-- Hiển thị thông tin bộ lọc hiện tại -->
            <?php if ($min_price > 0 || $max_price > 0 || $category_id > 0 || $sort != 'default'): ?>
                <div class="filters-info">
                    <strong>Bộ lọc đang áp dụng:</strong>
                    <?php
                    $filter_text = [];
                    if ($min_price > 0 || $max_price > 0) {
                        $filter_text[] = "Khoảng giá: " . number_format($min_price) . " - " . number_format($max_price) . " VNĐ";
                    }
                    if ($category_id > 0) {
                        $cat_name = array_column($categories, 'CategoryName', 'CategoryID')[$category_id] ?? 'Không xác định';
                        $filter_text[] = "Hãng: " . $cat_name;
                    }
                    if ($sort != 'default') {
                        $filter_text[] = "Sắp xếp: " . ($sort == 'asc' ? 'Tăng dần' : 'Giảm dần');
                    }
                    echo implode(' | ', $filter_text);
                    ?>
                    <a href="?<?php echo !empty($keyword) ? 'keyword=' . urlencode($keyword) : ''; ?>"> (Xóa)</a>
                </div>
            <?php endif; ?>
            
            <?php if ($result && $result->num_rows > 0): ?>
                <ul>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <li>
                            <a href="productDetail.php?id=<?php echo $row['ProductID']; ?>" class="product-link">
                                <img src="images/<?php echo htmlspecialchars($row['ImageURL']); ?>" alt="" width="100">
                                <span class="product-text">
                                    <?php echo htmlspecialchars($row['ProductName']); ?> -
                                    <?php echo number_format($row['Price']); ?> VNĐ
                                </span>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>Không tìm thấy sản phẩm nào phù hợp.</p>
            <?php endif; ?>
            
            <a href="index.php">Quay lại trang chủ</a>
        </div>
    </div>
</body>

</html>