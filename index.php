<?php 
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhà máy sản xuất xe điện</title>
    <link rel="stylesheet" href="anhteo.css">
    <link rel="icon" href="image/logo-yadea.svg" type="image/svg+xml">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <style>
        *{
                font-family: 'Montserrat', sans-serif;

        }
        @media (max-width:786px)
        {
          nav{
            display: none;
          }
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="/Yadea/congnghe">Công Nghệ</a></li>
            <li><a href="/Yadea/hotrobaohanh">Hỗ trợ bảo hành</a></li>
            <li><a href="/Yadea/tintuc">Tin tức</a></li>
            <li><a href="/Yadea/hoptac">Cơ Hội Hợp Tác</a></li>
        </ul>
    </nav>
    <div class="menu">
    <div class="logo">
        <a href="/Yadea"><img src="image/logo-yadea.svg" alt="Logo Thương Hiệu"></a>
    </div>

    <button class="menu-toggle" onclick="toggleMenu()">☰</button>

    <div class="menu-nav" id="mainMenu">
        <ul>
            <li><a href="#" id="hoverXemay">Xe Máy Điện</a></li>
            <li><a href="#" id="hoverXedap">Xe Đạp Điện</a></li>
            <li><a href="/Yadea/ve-yadea">Về YADEA</a></li>
            <li><a href="/Yadea/cuahang">Cửa Hàng</a></li>
        </ul>
    </div>

    <div class="themgiohang">
        <img src="image/themgiohang.jpg" width="40px" alt="Giỏ Hàng">
    </div>
</div>
<div id="Tatcasanpham">
  <div class="container">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-12 col-md-3 sidebar">
        <h5>Các dòng sản phẩm</h5>
        <ul class="list-group">
          <li data-category="new">Sản phẩm mới</li>
          <li data-category="city">Dòng City</li>
          <li data-category="sport">Dòng Sport</li>
          <li data-category="yadea">YADEA</li>
        </ul>
      </div>

      <!-- Sản phẩm -->
      <div class="col-12 col-md-9 product-grid">
        <!-- Sản phẩm mới -->
        <div class="row product-category" data-category="new">
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <a href="thongtinsanpham/yadea-voltguard-p" style="text-decoration: none;">
              <img src="image/Anh-V002P-chinh-480x389.png" alt="YADEA Voltguard P">
            <p>YADEA Voltguard P</p>
            </a>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="image/Orla-P-45-co-bong-480x389.png" alt="YADEA ORLA 2024">
            <p>YADEA ORLA 2024</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="image/1807-chinh-anh-sang-oris-xanh-45-480x360.png" alt="YADEA ULike">
            <p>YADEA Oris</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="image/anh-sp-ossy1-480x390.png" alt="YADEA ULike">
            <p>YADEA OSSY</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <a href="thongtinsanpham/yadea-voltguard-u"><img src="image/V002-U-anh-chinh-1-480x361.png" alt="YADEA ULike"></a>
            <p>YADEA VOLTGUARD U</p>
          </div>
        </div>

        <!-- Dòng City -->
        <div class="row product-category" data-category="city" style="display:none">
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="image/ocean-cyan-002-480x389.png" alt="City Bike 1">
            <p>YADEA OCEAN</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="image/icute-1-480x422.png" alt="City Bike 2">
            <p>YADEA ICUTE</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="image/odoras-white-1-480x389.png" alt="City Bike 2">
            <p>YADEA ODORAS</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="image/m6i-img-480x389.png" alt="City Bike 2">
            <p>YADEA M61i</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="image/virgo-black-1-480x389.png" alt="City Bike 2">
            <p>YADEA VIRGO</p>
          </div>
        </div>

        <!-- Dòng Sport -->
        <div class="row product-category" data-category="sport" style="display:none">
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="image/xzone-cheo-xam-480x389.webp" alt="Sport Bike 1">
            <p>YADEA Xzone</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="image/2-anh-cung-kich-thuoc-Vekoo-2-480x390.png" alt="Sport Bike 2">
            <p>YADEA Vekko</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="image/xmen-1-480x390.png" alt="Sport Bike 2">
            <p>YADEA Xmen Neo</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="image/2-anh-cung-kich-thuoc-XSKy-1-480x390.png" alt="Sport Bike 2">
            <p>YADEA XSky</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="image/xbull-1-480x390.png" alt="Sport Bike 2">
            <p>YADEA XBull</p>
          </div>
        </div>

        <!-- YADEA -->
        <div class="row product-category" data-category="yadea" style="display:none">
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="image/ossy.png" alt="YADEA Ossy">
            <p>YADEA Ossy</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="image/V002-U-anh-chinh-1-480x361.png" alt="YADEA Voltguard U">
            <p>YADEA Voltguard U</p>
          </div>
        </div>
        <!-- Xe Đạp Điện -->
        <div class="row product-category" data-category="xedap" style="display:none">
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="image/Anrh-nho-ben-tren-480x361-i8-gau-xanh-sua-480x361.png" alt="YADEA Bike 1">
            <p>YADEA i8 VINTAGE</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="image/Anh-nho-ben-tren-480x361-1-480x361.png" alt="YADEA Bike 2">
            <p>YADEA I8</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="image/product-i6-pin-lithium-480x389.png" alt="YADEA Bike 2">
            <p>YADEA I6</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="image/YADEA-iFUN-anh-chinh-480x389.webp" alt="YADEA Bike 2">
            <p>YADEA iFUN</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="image/igo-pink-1-480x389.png" alt="YADEA Bike 2">
            <p>YADEA Igo</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br><br><br><br>

    <header>
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="image/Banner-web-2560x1120-ngang-1.jpg" class="d-block w-100" alt="Banner Về Xe Điện">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Đại Sứ Thương Hiệu YADEA Việt Nam</h5>
                    <p>Gặp Mặt Ngay Thần Tượng Soobin Hoàng Sơn Tại Sự Kiện Sắp Tới</p>
                </div>
                </div>
                <div class="carousel-item">
                <img src="image/Anh-bia-Vuong-Hac-De.jpg" class="d-block w-100" alt="Banner Về Xe Điện">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
                </div>
                <div class="carousel-item">
                <img src="image/Anh-bia-Tien-Linh-voi-YADEA.jpg" class="d-block w-100" alt="Banner quảng cáo về xe điện">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            </div>
    </header>
    <br>
    <main>
    <?php
    $ds_khoi = $conn->query("SELECT * FROM trangchu_khoi WHERE hien_thi = 1 ORDER BY thu_tu ASC");
    while ($khoi = $ds_khoi->fetch_assoc()) {
        $file = __DIR__ . '/sections/khoi-' . $khoi['ma_khoi'] . '.php';
        if (file_exists($file)) include $file;
    }
    ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    </main>
   <footer>
    <div class="LienHe">
        <div class="container">
            <div class="row gy-4">
                <div class="col-md-3">
                    <div class="LienHeCongTy">
                        <img src="image/logo-yadea.svg" alt="Logo Công Ty" style="max-width: 150px;">
                        <p><strong>CÔNG TY TNHH ELECTRIC MOTORCYCLE YADEA VIỆT NAM</strong></p>
                        <p>Mã Số Thuế: 2400866767 do Sở KHĐT Tỉnh Bắc Giang cấp lần đầu ngày 27/06/2019.</p>
                        <p><strong>Địa Chỉ:</strong> Lô O1-2... Quang Châu, Việt Yên, Bắc Giang, Việt Nam.</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <ul class="footer-list">
                        <p><strong>Sản phẩm mới</strong></p>
                        <li><a href="#">YADEA Ossy</a></li>
                        <li><a href="thongtinsanpham/yadea-voltguard-u">YADEA Voltguard U</a></li>
                        <li><a href="#">YADEA Oris</a></li>
                        <li><a href="#">YADEA Orla 2024</a></li>
                        <li><a href="#">YADEA iFUN</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <ul class="footer-list">
                        <p><strong>Về Chúng Tôi</strong></p>
                        <li><a href="ve-yadea">Về YADEA</a></li>
                        <li><a href="cuahang">Cửa Hàng</a></li>
                        <li><a href="congnghe">Công Nghệ</a></li>
                        <li><a href="tintuc">Tin Tức</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <ul class="footer-list">
                        <p><strong>Hỗ Trợ</strong></p>
                        <li><a href="hotrobaohanh">Hỗ Trợ & Bảo Hành</a></li>
                        <li><a href="phuong-thuc-thanh-toan/">Thanh Toán</a></li>
                        <li><a href="chinh-sach-van-chuyen/">Vận Chuyển</a></li>
                        <li><a href="chinh-sach-doi-tra/">Chính Sách Đổi Trả</a></li>
                        <li><a href="chinh-sach-bao-mat/">Chính Sách Bảo Mật</a></li>
                        <li><a href="hoptac">Cơ Hội Hợp Tác</a></li>
                        <li><a href="lienhe">Liên Hệ</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <p><strong>Theo Dõi YADEA</strong></p>
                    <div class="social-media">
                        <img src="image/facebook.jpg" alt="Facebook">
                        <img src="image/tiktok.png" alt="TikTok">
                        <img src="image/tải xuống.jpg" alt="Instagram">
                        <img src="image/youtube.png" alt="YouTube">
                        <img src="image/zalo.png" alt="Zalo">
                    </div>
                    <div class="contact-info">
                        <p><strong>CSKH:</strong> 1900636803</p>
                        <p><strong>Liên Hệ Hợp Tác:</strong> (+84) 204 6299 288</p>
                        <p><strong>Email:</strong> market@yadea.com.vn</p>
                    </div>
                    <img src="image/logoSaleNoti-300x114.png" alt="Chứng nhận" style="max-width: 100%;">
                </div>
            </div>
        </div>
    </div>
</footer>
    <script>
    function toggleMenu() {
        const menu = document.getElementById('mainMenu');
        menu.classList.toggle('active');
    }
    </script>
    <script>
  const hoverLink = document.getElementById("hoverXemay");
  const spBox = document.getElementById("Tatcasanpham");

  hoverLink.addEventListener("mouseenter", () => {
    spBox.style.display = "flex";
  });

  hoverLink.addEventListener("mouseleave", () => {
    setTimeout(() => {
      if (!spBox.matches(':hover')) {
        spBox.style.display = "none";
      }
    }, 200);
  });

  spBox.addEventListener("mouseleave", () => {
    spBox.style.display = "none";
  });

  spBox.addEventListener("mouseenter", () => {
    spBox.style.display = "flex";
  });
</script>
<script>
  // Xử lý click vào danh mục sản phẩm
  document.querySelectorAll('.sidebar ul li').forEach(item => {
    item.addEventListener('click', function() {
      // Lấy giá trị data-category từ item
      const selected = this.getAttribute('data-category');

      // Ẩn tất cả danh mục
      document.querySelectorAll('.product-category').forEach(category => {
        category.style.display = 'none';
      });

      // Hiện danh mục được chọn
      const target = document.querySelector(`.product-category[data-category="${selected}"]`);
      if (target) {
        target.style.display = 'flex';
        target.style.flexWrap = 'wrap';
        target.style.gap = '20px';
      }

      // Highlight item đang chọn
      document.querySelectorAll('.sidebar ul li').forEach(li => li.classList.remove('active'));
      this.classList.add('active');
    });
  });
</script>
<script>
  const hoverXedap = document.getElementById("hoverXedap");

  hoverXedap.addEventListener("mouseenter", () => {
    spBox.style.display = "flex";

    // Chỉ hiện danh mục xe đạp điện
    document.querySelectorAll('.product-category').forEach(category => {
      category.style.display = 'none';
    });
    const xedap = document.querySelector('.product-category[data-category="xedap"]');
    if (xedap) {
      xedap.style.display = 'flex';
      xedap.style.flexWrap = 'wrap';
      xedap.style.gap = '20px';
    }

    // Cập nhật sidebar active nếu có
    document.querySelectorAll('.sidebar ul li').forEach(li => li.classList.remove('active'));
    const activeLi = document.querySelector('.sidebar ul li[data-category="xedap"]');
    if (activeLi) activeLi.classList.add('active');
  });
</script>

</body>
</html>