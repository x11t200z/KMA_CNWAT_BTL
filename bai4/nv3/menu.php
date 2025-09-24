<!-- menu.php -->
<style>
    /* Chỉ áp dụng cho các a bên trong ul.menunv3 */
    ul.menunv3 a {
        display: block;
        color: white;
        padding: 14px 20px;
        text-decoration: none;
    }

    /* Chỉ áp dụng cho li bên trong ul.menunv3 */
    ul.menunv3 li {
        float: left;
    }

    ul.menunv3 li:hover {
        background-color: #585858ff;
    }

    /* Chỉ áp dụng cho ul có class menunv3 */
    ul.menunv3 {
        list-style: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background: #6c6c6c;
    }
</style>

<ul class="menunv3">
    <li><a href="index.php?page=home">Home</a></li>
    <li><a href="index.php?page=drawTable">Draw Table</a></li>
    <li><a href="index.php?page=loop">Loop</a></li>
    <li><a href="index.php?page=calculate1">Calculate 1</a></li>
    <li><a href="index.php?page=calculate2"> Calculate 2</a></li>
    <li><a href="index.php?page=array1">Array 1</a></li>
    <li><a href="index.php?page=array2">Array 2</a></li>
    <li><a href="index.php?page=uploadprocess">Upload Form</a></li>
</ul>