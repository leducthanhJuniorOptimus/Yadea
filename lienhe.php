<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên Hệ - YADEA Việt Nam</title>
    <link rel="icon" href="image/logo-yadea.svg" type="image/svg+xml">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <style>
        *{
                font-family: 'Montserrat', sans-serif;

        }
       .text-orange {
    color: rgb(255, 95, 0);
  }
  .border-orange {
    border-color: rgb(255, 95, 0) !important;
  }
  .btn-orange {
    background-color: rgb(255, 95, 0);
    border: none;
    transition: background-color 0.3s ease;
  }
  .btn-orange:hover {
    background-color: #e65c00;
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
            <img src="image/Anh-V002P-chinh-480x389.png" alt="YADEA Voltguard P">
            <p>YADEA Voltguard P</p>
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

<div class="HopTac">
    <div class="HopTacChu">
        <strong>LIÊN HỆ</strong>
        <h6><a href="index.html"  class="lmaop">Trang Chủ</a>   /  Cơ Hội Hợp Tác </h6>
    </div>
</div>
<br><br>
<div class="container py-5">
  <div class="row g-4 align-items-start">
    <!-- Thông tin liên lạc -->
    <div class="col-lg-8">
      <h4 class="fw-bold mb-3 text-uppercase">Thông tin liên lạc</h4>
      <p>
        Với sứ mệnh <b class="text-orange">“Electrify your life”</b>, YADEA tập trung vào đổi mới công nghệ tiên tiến, để cung cấp đến người dùng giải pháp di chuyển xanh, tạo nên một tương lai bền vững.
      </p>
      <hr class="border-3 border-orange opacity-100 my-4">
      <p><b class="text-orange">Số điện thoại:</b> 0309.5856.11</p>
      <p><b class="text-orange">Email:</b> market@yadea.com.vn</p>
    </div>

    <!-- Form liên hệ -->
    <div class="col-lg-4">
      <div class="card shadow rounded-4 border-0">
        <div class="card-body p-4">
          <h5 class="fw-bold text-center mb-4">Liên hệ với YADEA</h5>
          <form method="post" action="guimail.php">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="name" name="name" placeholder="Quý danh khách hàng" required>
              <label for="name">Quý danh khách hàng</label>
            </div>
            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
              <label for="email">Email</label>
            </div>
            <div class="form-floating mb-3">
              <input type="tel" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" required>
              <label for="phone">Số điện thoại</label>
            </div>
            <div class="mb-3">
              <textarea class="form-control" id="noidung" name="noidung" placeholder="Nội dung liên hệ..." rows="5" required></textarea>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-orange fw-bold text-white rounded-pill">Gửi Thông Tin</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
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
                        <li><a href="#">YADEA Voltguard</a></li>
                        <li><a href="#">YADEA Oris</a></li>
                        <li><a href="#">YADEA Orla 2024</a></li>
                        <li><a href="#">YADEA iFUN</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <ul class="footer-list">
                        <p><strong>Về Chúng Tôi</strong></p>
                        <li><a href="#">Về YADEA</a></li>
                        <li><a href="#">Cửa Hàng</a></li>
                        <li><a href="#">Công Nghệ</a></li>
                        <li><a href="#">Tin Tức</a></li>
                        <li><a href="#">Tuyển Dụng</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <ul class="footer-list">
                        <p><strong>Hỗ Trợ</strong></p>
                        <li><a href="#">Hỗ Trợ & Bảo Hành</a></li>
                        <li><a href="#">Thanh Toán</a></li>
                        <li><a href="#">Vận Chuyển</a></li>
                        <li><a href="#">Chính Sách Đổi Trả</a></li>
                        <li><a href="#">Chính Sách Bảo Mật</a></li>
                        <li><a href="#">Cơ Hội Hợp Tác</a></li>
                        <li><a href="#">Liên Hệ</a></li>
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
<script>function toggleMenu() {
        const menu = document.getElementById('mainMenu');
        menu.classList.toggle('active');
    }</script>
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