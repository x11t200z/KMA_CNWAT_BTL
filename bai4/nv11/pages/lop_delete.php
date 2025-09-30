<?php
include 'db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM LOP WHERE MALOP='$id'");
header("Location: ?page=lop");
?>
