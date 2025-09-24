<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "testdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error){
        die("Ket noi that bai:".$conn->connect_error);
    }

    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$user' AND password=MD5('$pass')";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        echo "Dang nhap thanh cong! Xin chao". $user;
    } else {
        echo "Sai username hoac password";
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <h2>Đăng nhập</h2>
        <form action="" method="POST">
            <label for="">Username: </label><br>
            <input type="text" name="username" required><br><br>
            <label for="">Password: </label><br>
            <input type="password" name="password" required><br><br>
            <button type="submit">Login</button>
        </form>
    </body>
</html>