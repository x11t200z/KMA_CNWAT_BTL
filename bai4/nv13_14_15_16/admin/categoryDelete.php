<?php
include '../db.php';

$id = $_GET['id'];
$sql = "DELETE FROM Category WHERE CategoryID=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: categoryList.php");
    exit();
} else {
    echo "Lỗi: " . $conn->error;
}
?>
