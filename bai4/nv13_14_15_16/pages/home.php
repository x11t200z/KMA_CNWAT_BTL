<!-- Sidebar -->

<head>
    <style>
        /* Sidebar */
        .sidebar {
            width: 200px;
            background: #f8f9fa;
            border-right: 1px solid #ccc;
            height: auto;
            padding-left: 20px;
            box-sizing: border-box;
        }

        .sidebar h2 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #333;
        }

        .sidebar ul {
            list-style: none;
            padding-left: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #007bff;
        }

        .sidebar ul li a:hover {
            text-decoration: underline;
        }

        /* Nội dung chính */
        .main-content {
            flex: 1;
            /* Chiếm phần còn lại của không gian */
            padding-left: 20px;
            box-sizing: border-box;
        }

        .product {
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin: 10px;
            padding: 10px;
            width: 220px;
            text-align: center;
            box-shadow: 2px 2px 6px #ddd;
        }

        .product img {
            max-width: 200px;
            max-height: 150px;
        }

        .price {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<div class="sidebar">
    <h2>Danh mục</h2>
    <ul>
        <?php foreach ($productsByCategory as $catName => $data): ?>
            <li><a href="?page=productList&cat=<?= $data['id'] ?>"><?= htmlspecialchars($catName) ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>

<!-- Nội dung chính -->
<div class="main-content">
    <?php
    $page = $_GET['page'] ?? 'homelist';

    if ($page === 'productDetail' && isset($_GET['id'])) {
        include 'productDetail.php';
    } elseif ($page === 'productList' && isset($_GET['cat'])) {
        include 'productList.php';
    } else {
        include 'homelist.php'; // mặc định là trang chủ
    }
    ?>
</div>
