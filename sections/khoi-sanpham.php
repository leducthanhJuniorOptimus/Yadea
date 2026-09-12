<center><h1 style="font-family: Comic San MS">Sản Phẩm Mới</h1></center>
<div class="product-grid">
<?php
$sp = $conn->query("SELECT * FROM sanpham ORDER BY id DESC LIMIT 6");
while ($row = $sp->fetch_assoc()):
?>
    <div class="product-card">
        <div class="product-top">
            <div class="product-label">
                <span>HIỆN ĐẠI - THÔNG MINH</span>
                <span class="tag-new">MỚI</span>
            </div>
            <div class="product-image">
                <img src="<?php echo htmlspecialchars($row['hinh_anh']); ?>" alt="<?php echo htmlspecialchars($row['ten_san_pham']); ?>">
            </div>
        </div>
        <div class="product-info">
            <h3><?php echo htmlspecialchars($row['ten_san_pham']); ?></h3>
            <p class="price"><?php echo htmlspecialchars($row['gia']); ?></p>
            <a href="thongtinsanpham/<?php echo htmlspecialchars($row['slug']); ?>" class="btn-buy">CHỌN MUA SẢN PHẨM →</a>
        </div>
        
    </div>
    
<?php endwhile; ?>
<div class="product-card">
        <div class="product-top">
            <div class="product-label">
                <span>HIỆN ĐẠI - THÔNG MINH</span>
                <span class="tag-new">MỚI</span>
            </div>
            <div class="product-image">
                <img src="image/Anh-sp-ngang-v002-U-1280x880-1-480x330.png" alt="YADEA Voltguard U">
            </div>
            <div class="product-dots">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
        <div class="product-info">
            <h3>YADEA Voltguard U</h3>
            <p class="price">45,990,000 VND</p>
            <a href="thongtinsanpham/yadea-voltguard-u.html" class="btn-buy">CHỌN MUA SẢN PHẨM →</a>
        </div>
    </div>

    <div class="product-card">
        <div class="product-top">
            <div class="product-label">
                <span>HIỆN ĐẠI - THÔNG MINH</span>
                <span class="tag-new">MỚI</span>
            </div>
            <div class="product-image">
                <img src="image/Anh-sp-chinh-1200x880-trang.png" alt="YADEA Voltguard P">
            </div>
            <div class="product-dots">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
        <div class="product-info">
            <h3>YADEA Voltguard P</h3>
            <p class="price">27,990,000 VNĐ</p>
            <a href="thongtinsanpham/yadea-voltguard-p.html" class="btn-buy">CHỌN MUA SẢN PHẨM →</a>
        </div>
    </div>

</div>
</div>

