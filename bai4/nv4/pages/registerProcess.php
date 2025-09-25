<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Lấy dữ liệu từ form
    $username = $_POST['username'] ?? ''; // Nếu người dùng có điền vào username thì $_POST['username'] sẽ là giá trị người dùng nhập với input name="username", ngược lại, nếu không điền thì biến $username sẽ nhận giá trị bên phải là ''
    $password = $_POST['password'] ?? '';
    $gender   = $_POST['gender'] ?? '';
    $address  = $_POST['address'] ?? '';
    $langs    = $_POST['lang'] ?? []; // có thể là 1 mảng
    $skill    = $_POST['skill'] ?? '';
    $note     = $_POST['note'] ?? '';

    // Hiển thị kết quả
    echo "<h2>Kết quả đăng ký</h2>";
    echo "<p><strong>Username:</strong> " . htmlspecialchars($username) . "</p>"; // hàm này để xử lý các ký tự đặc biết nếu người dùng có nhập vào thì hàm sẽ sanitize hoặc escape để đảm bảo an toàn, chống tấn công XSS
    echo "<p><strong>Password:</strong> " . htmlspecialchars($password) . "</p>";
    echo "<p><strong>Gender:</strong> " . htmlspecialchars($gender) . "</p>";
    echo "<p><strong>Address:</strong> " . htmlspecialchars($address) . "</p>";

    echo "<p><strong>Programming Languages:</strong> ";
    if (!empty($langs)) {
        // Nếu chọn nhiều checkbox thì $_POST['lang'] sẽ là mảng
        if (is_array($langs)) {
            echo implode(", ", array_map('htmlspecialchars', $langs)); 
            /* Đọc từ trong ra, đầu tiên là hàm array_map để thực hiện đồng loạt hàm htmlspecialchars với từng phần tử của $langs, 
            sau đó hàm implode sẽ thực hiện hiển thị các phần tử, phân chia các phần tử ra bằng dau phay */
        } else { // Nếu $langs không phải mảng tức là nó chỉ có 1 phần tử, thực hiện sanitize luôn
            echo htmlspecialchars($langs);
        }
    } else {
        echo "Không chọn";
    }
    echo "</p>";

    echo "<p><strong>Skill:</strong> " . htmlspecialchars($skill) . "</p>";
    echo "<p><strong>Note:</strong><br>" . nl2br(htmlspecialchars($note)) . "</p>";
    /* Hàm nl2br sử dụng để chuyển đổi các kí tự xuống dòng trong note của người dùng thành phần tử <br> (vì trình duyệt web chỉ nhận diện được việc xuống dòng bằng<br>) 
    Nên việc thêm xử lý hàm này vào note của người dùng để đảm bảo hình thức người dùng nhập vào được giữ nguyên*/
} else {
    echo "<p>Không có dữ liệu nào được gửi!</p>";
}
?>
