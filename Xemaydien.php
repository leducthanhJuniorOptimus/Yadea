<?php
require_once "config.php"; 

$ds_xe_dien = $conn->query("SELECT * FROM sanpham WHERE loai_xe = 'Xe máy điện' ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Các Loại Xe Máy Điện</title>
    <link rel="icon" href="image/logo-yadea.svg" type="image/svg+xml">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <style>
        .HopTac{
            height: 500px !important;
        }
        .HopTacChu{
            bottom: 209px !important;
                left: 25% !important    ;
        }
    </style>
</head>
<body>
    <?php 
        include "header.php";
    ?>
    <div class="HopTac">
    <div class="HopTacChu">
        <strong>Xe Máy Điện</strong>
    </div>
</div>
        <div class="product-grid">
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
                    <a href="thongtinsanpham/yadea-voltguard-u" class="btn-buy">CHỌN MUA SẢN PHẨM →</a>
                </div>
            </div>
            <div class="product-card">
                <div class="product-top">
                    <div class="product-label">
                    <span>HIỆN ĐẠI - THÔNG MINH</span>
                    <span class="tag-new">MỚI</span>
                    </div>
                    <div class="product-image">
                    <img src="image/Anh-sp-chinh-1200x880-trang.png" alt="YADEA Voltguard U">
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
                    <a href="thongtinsanpham/yadea-voltguard-p" class="btn-buy">CHỌN MUA SẢN PHẨM →</a>
                </div>
            </div>
            <div class="product-card">
                <div class="product-top">
                    <div class="product-label">
                    <span>HIỆN ĐẠI - THÔNG MINH</span>
                    <span class="tag-new">MỚI</span>
                    </div>
                    <div class="product-image">
                    <img src="image/oris-xoay-480x389.png" alt="YADEA Voltguard U">
                    </div>
                    <div class="product-dots">
                    <span class="dot active"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    </div>
                </div>
                <div class="product-info">
                    <h3>YADEA Oris</h3>
                    <p class="price">22,990,000 VND</p>
                    <a href="thongtinsanpham/yadea-voltguard-u" class="btn-buy">CHỌN MUA SẢN PHẨM →</a>
                </div>
            </div>
                        <div class="product-card">
                <div class="product-top">
                    <div class="product-label">
                    <span>HIỆN ĐẠI - THÔNG MINH</span>
                    <span class="tag-new">MỚI</span>
                    </div>
                    <div class="product-image">
                    <img src="image/anh-sp-ossy1-480x390.png" alt="YADEA Voltguard U">
                    </div>
                    <div class="product-dots">
                    <span class="dot active"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    </div>
                </div>
                <div class="product-info">
                    <h3>YADEA Ossy</h3>
                    <p class="price">21,990,000 VND</p>
                    <a href="thongtinsanpham/yadea-voltguard-u" class="btn-buy">CHỌN MUA SẢN PHẨM →</a>
                </div>
            </div>
                        <div class="product-card">
                <div class="product-top">
                    <div class="product-label">
                    <span>HIỆN ĐẠI - THÔNG MINH</span>
                    <span class="tag-new">MỚI</span>
                    </div>
                    <div class="product-image">
                    <img src="image/orla-beige-480x330.png" alt="YADEA Voltguard U">
                    </div>
                    <div class="product-dots">
                    <span class="dot active"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    </div>
                </div>
                <div class="product-info">
                    <h3>YADEA ORLA 2024</h3>
                    <p class="price">20,490,000 VND</p>
                    <a href="thongtinsanpham/yadea-voltguard-u" class="btn-buy">CHỌN MUA SẢN PHẨM →</a>
                </div>
            </div>
                        <div class="product-card">
                <div class="product-top">
                    <div class="product-label">
                    <span>HIỆN ĐẠI - THÔNG MINH</span>
                    <span class="tag-new">MỚI</span>
                    </div>
                    <div class="product-image">
                    <img src="image/odoras-white-1-480x389.png" alt="YADEA Voltguard U">
                    </div>
                    <div class="product-dots">
                    <span class="dot active"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    </div>
                </div>
                <div class="product-info">
                    <h3>YADEA OĐORA S</h3>
                    <p class="price">18,490,000 VND</p>
                    <a href="thongtinsanpham/yadea-voltguard-u" class="btn-buy">CHỌN MUA SẢN PHẨM →</a>
                </div>
            </div>
        </div>
            <?php if ($ds_xe_dien && $ds_xe_dien->num_rows > 0): ?>
                <?php while ($sp = $ds_xe_dien->fetch_assoc()): ?>
                <div class="product-card">
                    <div class="product-top">
                        <div class="product-label">
                            <span>HIỆN ĐẠI - THÔNG MINH</span>
                            <span class="tag-new">MỚI</span>
                        </div>
                        <div class="product-image">
                            <img src="<?php echo !empty($sp['hinh_anh']) ? htmlspecialchars($sp['hinh_anh']) : 'image/no-image.png'; ?>" alt="<?php echo htmlspecialchars($sp['ten_san_pham']); ?>">
                        </div>
                        <div class="product-dots">
                            <span class="dot active"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3><?php echo htmlspecialchars($sp['ten_san_pham']); ?></h3>
                        <p class="price"><?php echo htmlspecialchars($sp['gia']); ?></p>
                        <a href="thongtinsanpham.php?id=<?php echo $sp['id']; ?>" class="btn-buy">CHỌN MUA SẢN PHẨM →</a>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Hiện chưa có sản phẩm xe máy điện nào.</p>
            <?php endif; ?>
    </div>
</div>
</body>
</html>