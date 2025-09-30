<?php
// saveAccount.php
header('Content-Type: application/json');

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

try {
    // Lưu thông tin vào file account.txt
    $content = "$username:$password\n";
    $result = file_put_contents('account.txt', $content, FILE_APPEND);
    
    if ($result === false) {
        throw new Exception('Không thể lưu thông tin vào file');
    }
    
    echo json_encode(['status' => 'success']);
} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>