<!-- menu.php -->
<style>
    /* Chỉ áp dụng cho các a bên trong ul.menunv4 */
    ul.menunv4 a {
        display: block;
        color: white;
        padding: 14px 20px;
        text-decoration: none;
    }

    /* Chỉ áp dụng cho li bên trong ul.menunv4 */
    ul.menunv4 li {
        float: left;
    }

    ul.menunv4 li:hover {
        background-color: #585858ff;
    }

    /* Chỉ áp dụng cho ul có class menunv4 */
    ul.menunv4 {
        list-style: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background: #6c6c6c;
    }
</style>

<ul class="menunv4">
    <li><a href="index.php?page=home">Home</a></li>
    <li><a href="index.php?page=login">Đăng nhập trung gian </a></li>
</ul>