<?php
include 'db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM HOSO WHERE MAHS='$id'");
header("Location: ?page=hoso");
?>
