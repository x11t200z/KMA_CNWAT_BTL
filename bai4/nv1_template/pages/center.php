<!-- center.php -->
<div>
    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        if ($page == "about") {
            echo "<h2>Giới thiệu</h2><p>Đây là trang giới thiệu.</p>";
        } elseif ($page == "contact") {
            echo "<h2>Liên hệ</h2><p>Thông tin liên hệ ở đây.</p>";
        } elseif ($page == "news") {
            echo "<h2>Tin tức</h2><p>Tin tức mới nhất...</p>";
        } elseif ($page == "events") {
            echo "<h2>Sự kiện</h2><p>Các sự kiện sắp diễn ra...</p>";
        } elseif ($page == "help") {
            echo "<h2>Trợ giúp</h2><p>Hướng dẫn sử dụng...</p>";
        } else {
            echo "<h2>Trang không tồn tại!</h2>";
        }
    } else {
        echo "<h2>Chào mừng đến với website!</h2>
        <p>Họ và tên: Lưu Đức Thắng<br>Ngành học: An toàn thông tin<br>Khóa học: 2022 - 2027<br>Lớp: AT19D</p>";
    }
    ?>
</div>