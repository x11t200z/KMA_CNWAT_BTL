<?php
// Đảm bảo file ngôn ngữ đã được include từ index.php
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo CONTACT_PAGE; ?></title>
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        .contact-info p {
            margin: 10px 0;
            color: #555;
        }
        .contact-form label {
            display: block;
            margin: 10px 0 5px;
        }
        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .contact-form button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .contact-form button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><?php echo CONTACT_PAGE; ?></h2>
        <div class="contact-info">
            <p><?php echo CONTACT_MESSAGE; ?></p>
            <p><strong>Email:</strong> example@email.com</p>
            <p><strong>Phone:</strong> +84 123 456 789</p>
        </div>
        <div class="contact-form">
            <form method="post" action="">
                <label for="name"><?php echo NAME; ?></label>
                <input type="text" id="name" name="name" required>

                <label for="email"><?php echo 'Email'; // Thêm hằng số nếu cần ?></label>
                <input type="email" id="email" name="email" required>

                <label for="message"><?php echo MESSAGE; // Thêm hằng số nếu cần ?></label>
                <textarea id="message" name="message" rows="4" required></textarea>

                <button type="submit"><?php echo SAVE; // Sử dụng SAVE làm nút gửi ?></button>
            </form>
        </div>
    </div>
</body>
</html>