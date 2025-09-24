<!-- head.php -->
<style>
    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #333;
        color: white;
        padding: 15px;
        height: 100px;
    }
    .header-left {
        display: flex;
        align-items: center;
    }

    .header-left img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin-right: 15px;
        border: 2px solid white;
    }

    .header-info h2 {
        margin: 0;
        font-size: 20px;
    }

    .header-info p {
        margin: 3px 0;
        font-size: 14px;
    }

    .header-right {
        flex: 1; 
        height: 100%;
        width: 100%;
        margin-left: 15px;
        /* flex = 1 để phần tử này tự chiếm hết không gian còn lại */
    }
    .header-right img {
        /* max-width: 100%; */
        height: 100%;
        width: 100%;
        display: block;
        object-fit: cover;
        /* border-radius: 8px; */
    }
</style>


<header>
    <!-- Bên trái -->
    <div class="header-left">
        <img src="/luuducthang/img/avatar.webp" alt="Ảnh đại diện">
        <div class="header-info">
            <h2>Lưu Đức Thắng</h2>
            <p>MSV: AT190447</p>
        </div>
    </div>

    <!-- Bên phải -->
    <div class="header-right">
        <img src="/luuducthang/img/pexels-apasaric-325185.jpg" alt="Banner">
    </div>
</header>