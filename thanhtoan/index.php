<?php
$product_image = $_POST['product_image'] ?? '';
$product_price = $_POST['product_price'] ?? '';
$product_name = $_POST['product_name'] ?? '';
$showrooms = [
    "Yadea Shop Hưng Lộc Phát",
    "Yadea Shop Xe Hai Bánh",
    "Yadea Shop Bách Đại Dũng",
    "Yadea Shop Đức Minh",
    "Yadea Shop Trần Cương",
    "Yadea Shop Hòa Điệp",
    "Yadea Shop Thưởng Lan",
    "Yadea Shop Thanh Tùng",
    "Yadea Shop Duy Hùng",
    "Yadea Shop Đức Hòa – 9 Hoàng Văn Thụ",
    "Yadea Shop Thiện Anh",
    "Yadea Shop Mai Châu",
    "Yadea Shop Hoàn Thúy",
    "Yadea Shop Hoàn Hảo",
    "Yadea Shop Đoàn Gia Trang",
    "Yadea Shop Thanh Tâm",
    "Yadea Shop Đạt Thắng",
    "Yadea Shop Việt Thanh – Chính Thanh",
    "Yadea Shop Việt Thanh – TP Bắc Ninh",
    "Yadea Shop Bình Hương",
    "Yadea Shop Kiên Huyền",
    "Yadea Shop Hương Lụa",
    "Yadea Shop Ứng Tâm 2",
    "Yadea Shop Đức Hiệu",
    "Yadea Shop Liên Đá – Tân Thành, Kim Sơn",
    "Yadea Shop Long Tơ",
    "Yadea Shop Chung Dung",
    "Yadea Shop Ngân Hà – 04 Trần Phú",
    "Yadea Shop Hải Quân",
    "Yadea Shop Toàn Phát – Ngô Quyền",
    "Yadea Shop Phương Nghi",
    "Yadea Shop Tân Bảo Long",
    "Yadea Shop Phi Hùng",
    "Yadea Shop Thế Giới Xe Đạp Vũng Tàu",
    "Yadea Shop Huy Linh – Vũ Văn Cẩn",
    "Yadea Shop Vĩnh Huyền",
    "Yadea Shop Phong Loan",
    "Yadea Shop Ngọ Hương",
    "Yadea Shop Minh Giang",
    "Yadea Shop Anh Cường",
    "Yadea Shop Siêu Tốc Độ",
    "Yadea Shop Việt Thanh – 521 Nguyễn Trãi",
    "Yadea Shop Chuẩn Phát",
    "Yadea Shop Hoàng Cầu",
    "Yadea Shop Quang Phương – 131 Châu Văn Liêm",
    "Yadea Shop Hồng Anh 2",
    "Yadea Shop Xe Điện Tốt Hoà Bình",
    "Yadea Shop Thọ Huyền",
    "Yadea Shop Duy Đức",
    "Yadea Shop Yên Phong",
    "Yadea Shop Tuấn Tú",
    "Yadea Shop Đức Tâm",
    "Yadea Shop Phùng Hoan",
    "Yadea Shop Nhạn Hùng – Quảng Bình",
    "Yadea Shop Xe Điện Max – 103 Hoàng Văn Thụ",
    "Yadea Shop Xe Điện Max – 60 Lũy Bán Bích",
    "Yadea Shop Quốc Hùng – TP Long Khánh",
    "Yadea Shop Việt Hồng Chinh – 346 Lê Duẩn",
    "Yadea Shop Hà Thành",
    "Yadea Shop TT-EV",
    "Yadea Shop Quang Phương – 105 Nguyễn Tri Phương",
    "Yadea Shop Xe Điện Xanh Sài Gòn – Thủ Đức",
    "Yadea Shop Xe Điện Xanh Sài Gòn – 787 Quang Trung",
    "Yadea Shop Việt Thanh – 127 Phạm Văn Đồng",
    "Yadea Shop Việt Thanh – Hai Bà Trưng",
    "Yadea Shop Thanh Tùng",
    "Yadea Shop Việt Thanh – TP Bắc Giang",
    "Yadea Shop Khiêm Huyền",
    "Yadea Shop Toàn Phát – Cư Mga",
    "Yadea Shop Xe Điện Tuyên Tư",
    "Yadea Shop Phú Hương",
    "Yadea Shop Hoàng 5",
    "Yadea Shop Liên Đá – Cồn Thoi, Kim Sơn",
    "Yadea Shop Duy Hùng 4",
    "Yadea Shop Việt Hồng Chinh – TX Quảng Trị",
    "Yadea Shop Thắng Huyền",
    "Yadea Shop Thanh Giang",
    "Yadea Shop Huy Tuyết",
    "Yadea Shop Hậu Dung",
    "Yadea Shop Nam Bình – TP Cà Mau",
    "Yadea Shop Tươi Nghị",
    "Yadea Shop Thanh Phong",
    "Yadea Shop Việt Trung",
    "Yadea Shop Phong Gia ITC – Bình Dương",
    "Yadea Shop Long Hưng – Eakar",
    "Yadea Shop Hiệp Hòa",
    "Yadea Shop Đông Nam",
    "Yadea Shop Phong Gia ITC – Đồng Nai",
    "Yadea Shop Tân Tiến Đạt",
    "Yadea Shop Hưng Đào",
    "Yadea Shop Việt Thanh – Lê Chân",
    "Yadea Shop Duy Hùng",
    "Yadea Shop Phùng Tuyến",
    "Yadea Shop Hòa Bình",
    "Yadea Shop Thắng Lợi",
    "Yadea Shop Bảo Tín",
    "Yadea Shop Bình Minh – 28 Trần Hưng Đạo",
    "Yadea Shop Bình Minh – 456 Hoàng Liên",
    "Yadea Shop Tín Kim",
    "Yadea Shop Minh Chính",
    "Yadea Shop Như Ý Mỹ",
    "Yadea Shop Hòa Nhàn",
    "Yadea Shop Thái Bảo",
    "Yadea Shop Thành Phát – 1052 Phú Riềng Đỏ",
    "Yadea Shop Trung Thành",
    "Yadea Shop Hải Hà",
    "Yadea Shop Lan Điệp",
    "Yadea Shop Thảo Ái",
    "Yadea Shop Bình Minh",
    "Yadea Shop Bông Cẩm",
    "Yadea Shop Long Hưng – Buôn Hồ",
    "Yadea Shop Toàn Phát – Lý Thường Kiệt",
    "Yadea Shop TKH",
    "Yadea Shop Xe Điện Move",
    "Yadea Shop Quang Nga",
    "Yadea Shop Trọng Loan",
    "Yadea Shop Đức Hòa – 99 Bắc Sơn",
    "Yadea Shop Phát Gia",
    "Yadea Shop Trường Phượng",
    "Yadea Shop Tấn Tiến Phát",
    "Yadea Shop Kiên Nga",
    "Yadea Shop Quỳnh Lâm",
    "Yadea Shop TP Biker",
    "Yadea Shop Hải Toàn",
    "Yadea Shop Mạnh Phong",
    "Yadea Shop Ân Hiển 2",
    "Yadea Shop Ân Hiển – Phủ",
    "Yadea Shop Xe Điện Hà Thành",
    "Yadea Shop Quang Phương – 390 Nguyễn Trãi",
    "Yadea Shop Xe Điện Xanh Sài Gòn – 150 Nguyễn Oanh",
    "Yadea Shop Hóc Môn – Chi Nhánh Lý Thường Kiệt",
    "Yadea Shop Quang Phương – 458 Nguyễn Trí Thanh",
    "Yadea Shop Hải Nhường",
    "Yadea Shop Huy Bộ",
    "Yadea Shop Đình Đông",
    "Yadea Shop Ngân Hà – 39A Lê Hồng Phong",
    "Yadea Shop Sơn Quy",
    "Yadea Shop Tiến Nam",
    "Yadea Shop Quang Dũng",
    "Yadea Shop Hà Anh",
    "Yadea Shop Liên Đá – TP Ninh Bình",
    "Yadea Shop Hùng Hồng Ba Đồn",
    "Yadea Shop Dũng Lập",
    "Yadea Shop Phong Lý",
    "Yadea Shop Thanh Hoa",
    "Yadea Shop Hồng Sơn Star",
    "Yadea Shop Hà Ninh",
    "Yadea Shop Triệu Đô",
    "Yadea Shop Trung Ngân",
    "Yadea Shop Cường Thịnh",
    "Yadea Shop Kim Thanh",
    "Yadea Shop Thanh Vương Phát",
    "Yadea Shop Nam Bình – Trần Văn Thời",
    "Yadea Shop Ngân Thượng",
    "Yadea Shop Minh Hòa",
    "Yadea Shop Việt Ngọc Phương – Lê Đại Hành",
    "Yadea Shop Thanh Tín",
    "Yadea Shop Tân Hưng Yên",
    "Yadea Shop Thảo Linh",
    "Yadea Shop Minh Hoàng Huy",
    "Yadea Shop XeDap.vn",
    "Yadea Shop Sâm Huấn",
    "Yadea Shop Việt Thanh – 78 Ô Chợ Dừa",
    "Yadea Shop Tú An Phát",
    "Yadea Shop Việt Thanh – 148 Cầu Bươu",
    "Yadea Shop Việt Đức",
    "Yadea Shop Mai Hưng",
    "Yadea Shop Thanh Tùng – 723 Trường Chinh",
    "Yadea Shop Thanh Tùng – An Dương",
    "Yadea Shop Martin 107",
    "Yadea Shop Xe Điện Xanh Sài Gòn – 222 Lê Văn Khương",
    "Yadea Shop Quang Phương – 349A Lê Đại Hành",
    "Yadea Shop Sài Gòn Emoto – Bình Tân",
    "Yadea Shop Việt Thanh – 308 Huỳnh Tấn Phát",
    "Yadea Shop Đồng Thắng – 658 Âu Cơ",
    "Yadea Shop Kỳ Anh – Phú Lộc"
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán - YADEA VIỆT NAM</title>
    <link rel="stylesheet" href="../anhthanh.css">
    <link rel="icon" href="../image/logo-yadea.svg" type="../image/svg+xml">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <style>
        main {
    margin: 40px auto;
    background-color: #ffffff;
    padding: 30px;
    border-radius: 10px;
}

 h1 {
            text-align: center;
            color: var(--primary);
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            margin-bottom: 30px;
            position: relative;
        }

        h1::after {
            content: '';
            width: 60px;
            height: 3px;
            background: var(--primary);
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .section-title {
            color: var(--primary);
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .card {
            border: none;
            border-radius: 10px;
            background-color: var(--light);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 18px rgba(0, 123, 255, 0.2);
        }

        .form-label {
            color: var(--dark);
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
            outline: none;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            margin-top: 20px;
            font-size: 14px;
            gap: 10px;
        }

        .checkbox-container label {
            margin: 0;
            color: var(--dark);
        }

        .checkbox-container a {
            color: var(--primary);
            text-decoration: none;
        }

        .checkbox-container a:hover {
            text-decoration: underline;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            border-radius: 8px;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
        }

        .product-preview {
            text-align: center;
            padding: 20px;
        }

        .product-preview img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .product-preview img:hover {
            transform: scale(1.02);
        }

        .product-preview .price {
            font-size: 20px;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            main {
                padding: 20px;
            }
        }
</style>

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
        <a href="/Yadea"><img src="../image/logo-yadea.svg" alt="Logo Thương Hiệu"></a>
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
        <img src="../image/themgiohang.jpg" width="40px" alt="Giỏ Hàng">
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
              <img src="../image/Anh-V002P-chinh-480x389.png" alt="YADEA Voltguard P">
            <p>YADEA Voltguard P</p>
            </a>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="../image/Orla-P-45-co-bong-480x389.png" alt="YADEA ORLA 2024">
            <p>YADEA ORLA 2024</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="../image/1807-chinh-anh-sang-oris-xanh-45-480x360.png" alt="YADEA ULike">
            <p>YADEA Oris</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="../image/anh-sp-ossy1-480x390.png" alt="YADEA ULike">
            <p>YADEA OSSY</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <a href="thongtinsanpham/yadea-voltguard-u"><img src="../image/V002-U-anh-chinh-1-480x361.png" alt="YADEA ULike"></a>
            <p>YADEA VOLTGUARD U</p>
          </div>
        </div>

        <!-- Dòng City -->
        <div class="row product-category" data-category="city" style="display:none">
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="../image/ocean-cyan-002-480x389.png" alt="City Bike 1">
            <p>YADEA OCEAN</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="../image/icute-1-480x422.png" alt="City Bike 2">
            <p>YADEA ICUTE</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="../image/odoras-white-1-480x389.png" alt="City Bike 2">
            <p>YADEA ODORAS</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="../image/m6i-img-480x389.png" alt="City Bike 2">
            <p>YADEA M61i</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="../image/virgo-black-1-480x389.png" alt="City Bike 2">
            <p>YADEA VIRGO</p>
          </div>
        </div>

        <!-- Dòng Sport -->
        <div class="row product-category" data-category="sport" style="display:none">
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="../image/xzone-cheo-xam-480x389.webp" alt="Sport Bike 1">
            <p>YADEA Xzone</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="../image/2-anh-cung-kich-thuoc-Vekoo-2-480x390.png" alt="Sport Bike 2">
            <p>YADEA Vekko</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="../image/xmen-1-480x390.png" alt="Sport Bike 2">
            <p>YADEA Xmen Neo</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="../image/2-anh-cung-kich-thuoc-XSKy-1-480x390.png" alt="Sport Bike 2">
            <p>YADEA XSky</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="../image/xbull-1-480x390.png" alt="Sport Bike 2">
            <p>YADEA XBull</p>
          </div>
        </div>

        <!-- YADEA -->
        <div class="row product-category" data-category="yadea" style="display:none">
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="../image/ossy.png" alt="YADEA Ossy">
            <p>YADEA Ossy</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="../image/V002-U-anh-chinh-1-480x361.png" alt="YADEA Voltguard U">
            <p>YADEA Voltguard U</p>
          </div>
        </div>
        <!-- Xe Đạp Điện -->
        <div class="row product-category" data-category="xedap" style="display:none">
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="../image/Anrh-nho-ben-tren-480x361-i8-gau-xanh-sua-480x361.png" alt="YADEA Bike 1">
            <p>YADEA i8 VINTAGE</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="../image/Anh-nho-ben-tren-480x361-1-480x361.png" alt="YADEA Bike 2">
            <p>YADEA I8</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="../image/product-i6-pin-lithium-480x389.png" alt="YADEA Bike 2">
            <p>YADEA I6</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="../image/YADEA-iFUN-anh-chinh-480x389.webp" alt="YADEA Bike 2">
            <p>YADEA iFUN</p>
          </div>
          <div class="col-6 col-md-4 col-lg-3 product-item">
            <img src="../image/igo-pink-1-480x389.png" alt="YADEA Bike 2">
            <p>YADEA Igo</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br><br>
<br>
<br>
<br>
<main>
    <h1>THANH TOÁN</h1>
    <div class="container">
        <form action="sendmail" method="post" enctype="multipart/form-data">
            <div class="row g-4">
                <!-- Form bên trái -->
                <div class="col-md-8">
                    <div class="card p-4 shadow-sm">
                        <h3 class="section-title">Thông Tin Khách Hàng</h3>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required>
                        </div>
                        <div class="mb-3">
                            <label for="cmnd" class="form-label">CMND/CCCD</label>
                            <input type="text" class="form-control" id="cmnd" name="cmnd" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <h3 class="section-title mt-4">Showroom Nhận Xe</h3>
                        <div class="mb-3">
                            <select name="showroom" class="form-select" id="showroom" required>
                                <option value="">-- Chọn Showroom --</option>
                                <?php foreach ($showrooms as $showroom): ?>
                                    <option value="<?= htmlspecialchars($showroom) ?>"><?= htmlspecialchars($showroom) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <p class="text-muted small">
                            Thông tin cá nhân của bạn sẽ được sử dụng để xử lý đơn hàng, tăng trải nghiệm sử dụng website và theo <a href="#" class="text-primary">chính sách riêng tư</a>.
                        </p>

                        <div class="checkbox-container">
                            <input type="checkbox" id="agree" name="agree" required>
                            <label for="agree">Tôi đồng ý với <a href="#" class="text-primary">điều khoản & điều kiện</a></label> của website *
                        </div>
                    </div>
                </div>

                <!-- Sản phẩm bên phải -->
                <div class="col-md-4">
                    <div class="card product-preview shadow-sm">
                        <div class="card-body">
                                <?php if ($product_image && $product_price): ?>
                                  <img src="<?= htmlspecialchars($product_image) ?>" alt="Sản phẩm" class="img-fluid rounded">
                                  <div class="price mt-3">Tên Sản Phẩm: <?= $product_name ?></div>
                                  <div class="price mt-3">Giá: <?= number_format($product_price, 0, ',', '.') ?> VND</div>
                                  <input type="hidden" name="product_image" value="<?= htmlspecialchars($product_image) ?>">
                                  <input type="hidden" name="product_price" value="<?= htmlspecialchars($product_price) ?>">
                                  <input type="hidden" name="product_name" value="<?= htmlspecialchars($product_name) ?>">
                                  <button type="submit" class="btn w-100 mt-4" style="background-color:#FE6E16;color:white; font-weight:600;font-size:20px;">Xác Nhận Đặt Hàng</button>

                              <?php else: ?>
                                  <p class="text-muted">Không có thông tin sản phẩm.</p>
                              <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
                            </main>
<footer>
    <div class="LienHe">
        <div class="container">
            <div class="row gy-4">
                <div class="col-md-3">
                    <div class="LienHeCongTy">
                        <img src="../image/logo-yadea.svg" alt="Logo Công Ty" style="max-width: 150px;">
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
                        <img src="../image/facebook.jpg" alt="Facebook">
                        <img src="../image/tiktok.png" alt="TikTok">
                        <img src="../image/tải xuống.jpg" alt="Instagram">
                        <img src="../image/youtube.png" alt="YouTube">
                        <img src="../image/zalo.png" alt="Zalo">
                    </div>
                    <div class="contact-info">
                        <p><strong>CSKH:</strong> 1900636803</p>
                        <p><strong>Liên Hệ Hợp Tác:</strong> (+84) 204 6299 288</p>
                        <p><strong>Email:</strong> market@yadea.com.vn</p>
                    </div>
                    <img src="../image/logoSaleNoti-300x114.png" alt="Chứng nhận" style="max-width: 100%;">
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>