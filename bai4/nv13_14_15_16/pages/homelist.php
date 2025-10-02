<h1>Trang chủ bán Laptop</h1>

    <?php foreach ($productsByCategory as $categoryName => $data): ?>
        <h2><?= htmlspecialchars($categoryName) ?></h2>
        <?php foreach ($data['items'] as $p): ?>
            <div class="product">
                <img src="images/<?= htmlspecialchars($p['ImageURL']) ?>" alt="<?= htmlspecialchars($p['ProductName']) ?>">
                <h3><?= htmlspecialchars($p['ProductName']) ?></h3>
                <p class="price"><?= number_format($p['Price'], 0, ',', '.') ?> VND</p>
                <a href="?page=productDetail&id=<?= $p['ProductID'] ?>">Xem chi tiết</a>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>