// Bắt sự kiện mở/đóng nút
const toggler = document.querySelectorAll(".folder"); // lấy ra tất cả các element toggle (tức là mấy cái dấu + -)
console.log(toggler);
toggler.forEach(folder => {
    folder.addEventListener("click", function (e) {
        e.stopPropagation(); // không lan sang cha
        this.parentElement.querySelector(".nested").classList.toggle("active");
        console.log(this.parentElement);

        this.classList.toggle("folder-down");

        // Xử lý chọn node
        document.querySelectorAll("li span").forEach(s => s.classList.remove("selected"));
        this.classList.add("selected");
    });
});

// Nếu click vào node không có con (chỉ text thường)
document.querySelectorAll("li").forEach(li => {
    li.addEventListener("click", function (e) {
        e.stopPropagation();
        document.querySelectorAll("li span").forEach(s => s.classList.remove("selected"));
        if (this.querySelector("span")) {
            this.querySelector("span").classList.add("selected");
        }
    });
});