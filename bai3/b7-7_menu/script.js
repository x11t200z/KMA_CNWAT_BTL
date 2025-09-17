// Lấy các phần tử menu
const menuItems = document.querySelectorAll('.menu li');
const titleDisplay = document.getElementById('selected-task');
menuItems.forEach(item => {
    item.addEventListener('click', function () {
        // Xóa class 'selected' khỏi tất cả
        menuItems.forEach(i =>
            i.classList.remove('selected'));

        // Thêm class 'selected' cho item hiện tại
        this.classList.add('selected');
        // Hiển thị tiêu đề tương ứng
        const title = this.getAttribute('data-title');
        titleDisplay.textContent = `»${title}`;
    });
});