<aside class="sidebar">
    <div class="sidebar-logo">
        <h2>Yadea<span>.</span></h2>
        <p>Trang quản trị</p>
    </div>
    <nav class="sidebar-nav">
        <a href="index.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">
            <i class="fas fa-home"></i> Trang chủ
        </a>
        <a href="them_tintuc.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'them_tintuc.php') ? 'active' : ''; ?>">
            <i class="fas fa-newspaper"></i> Thêm tin tức
        </a>
        <a href="thongso.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'thongso.php') ? 'active' : ''; ?>">
            <i class="fas fa-chart-bar"></i> Xem thông số
        </a>
        <a href="duyetdonhang.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'duyetdonhang.php') ? 'active' : ''; ?>">
            <i class="fas fa-shopping-cart"></i> Duyệt đơn hàng
        </a>
        <a href="giaodien.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'giaodien.php') ? 'active' : ''; ?>">
            <i class="fas fa-paint-brush"></i> Giao diện
        </a>
        <a href="dangnhap.php?logout=1" class="logout-link">
            <i class="fas fa-sign-out-alt"></i> Đăng xuất
        </a>
    </nav>
</aside>