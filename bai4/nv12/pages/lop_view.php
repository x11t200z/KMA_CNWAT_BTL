<?php
include 'db.php';

$sql = "SELECT * FROM LOP";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Danh sách lớp</title>
</head>

<body>
    <h2>Danh sách lớp</h2>
    <ul>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <li style="list-style-type: none; margin-bottom: 8px;">
                <a href="index.php?page=hocsinh_view&MaLop=<?php echo $row['MALOP']; ?>">
                    <?php echo $row['TENLOP'] . " - " . $row['KHOAHOC'] . " - " . $row['GVCN']; ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</body>

</html>