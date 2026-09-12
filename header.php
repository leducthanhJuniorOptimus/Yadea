<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="anhteo.css">
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
            <li><a href="/Yadea/Xemaydien" id="hoverXemay">Xe Máy Điện</a></li>
            <li><a href="/Yadea/Xeganmay" id="hoverXedap">Xe Đạp Điện</a></li>
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