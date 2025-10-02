<?php
session_start();
include '../db.php';

if (!isset($_SESSION['Role']) || $_SESSION['Role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$id = intval($_GET['delete']);
$conn->query("DELETE FROM Product WHERE ProductID = $id");
header("Location: productList.php");
exit;
