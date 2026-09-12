<?php
require_once '../config.php';

$slug = $_GET['slug'] ?? '';
if ($slug === '') {
    $requestUri = $_SERVER['REQUEST_URI'] ?? '';
    $basePath = '/Yadea/thongtinsanpham/';
    if (strpos($requestUri, $basePath) === 0) {
        $slug = trim(str_replace($basePath, '', $requestUri), '/');
    }
}

$sp = null;
if ($slug !== '') {
    $stmt = $conn->prepare("SELECT * FROM sanpham WHERE slug = ?");
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows > 0) {
        $sp = $res->fetch_assoc();
    }
}

if (!$sp) {
    http_response_code(404);
    echo "<h2 style='text-align:center;margin-top:80px;font-family:sans-serif;'>Không tìm thấy sản phẩm.</h2>";
    echo "<p style='text-align:center;'><a href='../index.php'>Quay về trang chủ</a></p>";
    exit();
}

// Album ảnh phụ
$anh_phu = [];
$stmt2 = $conn->prepare("SELECT duong_dan FROM sanpham_anh WHERE sanpham_id = ? ORDER BY thu_tu ASC");
$stmt2->bind_param("i", $sp['id']);
$stmt2->execute();
$res2 = $stmt2->get_result();
while ($row = $res2->fetch_assoc()) { $anh_phu[] = $row['duong_dan']; }

// Các khối "tính năng nổi bật" (ảnh + chữ bên cạnh, kiểu HỆ THỐNG ĐÈN FULL LED)
$danh_sach_tinhnang = [];
$stmt3 = $conn->prepare("SELECT * FROM sanpham_tinhnang WHERE sanpham_id = ? ORDER BY thu_tu ASC");
$stmt3->bind_param("i", $sp['id']);
$stmt3->execute();
$res3 = $stmt3->get_result();
while ($row = $res3->fetch_assoc()) { $danh_sach_tinhnang[] = $row; }

$mau_chu_dao  = !empty($sp['mau_chu_dao']) ? $sp['mau_chu_dao'] : '#FF5F00';
$anh_dai_dien = !empty($sp['hinh_anh']) ? '../' . $sp['hinh_anh'] : '../image/no-image.png';
$nen_banner   = !empty($sp['nen_banner']) ? '../' . $sp['nen_banner'] : '';

function hien_thi($sp, $key) {
    return !empty($sp[$key]) ? htmlspecialchars($sp[$key]) : '';
}

// Chuyển mô tả nhiều dòng -> danh sách gạch đầu dòng ⚡️
function xuat_gach_dau_dong($mo_ta)
{
    $dong = preg_split('/\r\n|\r|\n/', trim($mo_ta));
    $html = '<ul>';
    foreach ($dong as $d) {
        $d = trim($d);
        if ($d === '') continue;
        $html .= '<li>' . htmlspecialchars($d) . '</li>';
    }
    $html .= '</ul>';
    return $html;
}

$nhom_thong_so = [
    'KÍCH THƯỚC, TRỌNG LƯỢNG' => [
        'kich_thuoc'         => 'Dài x Rộng x Cao',
        'man_hinh'           => 'Màn hình',
        'khoi_luong'         => 'Khối lượng bản thân',
        'tai_trong_toi_da'   => 'Tải trọng tối đa',
        'dung_tich_cop'      => 'Dung tích cốp xe',
    ],
    'ĐỘNG CƠ' => [
        'cong_suat_danh_dinh' => 'Công suất danh định',
        'cong_suat_toi_da'    => 'Công suất tối đa',
        'toc_do_toi_da'       => 'Tốc độ tối đa',
        'gia_toc'             => 'Gia tốc',
        'leo_doc'             => 'Khả năng leo dốc',
    ],
    'ẮC QUY / PIN' => [
        'loai_acquy'      => 'Loại ắc quy',
        'dung_luong_pin'  => 'Dung lượng pin',
        'quang_duong'     => 'Quãng đường di chuyển',
        'thoi_gian_sac'   => 'Thời gian sạc',
    ],
    'THÔNG SỐ KHÁC' => [
        'loai_lop'                => 'Loại lốp',
        'he_thong_phanh'          => 'Hệ thống phanh',
        'do_sang_den_pha'         => 'Độ sáng đèn pha',
        'khoang_cach_chieu_sang'  => 'Khoảng cách chiếu sáng',
        'tieu_chuan_khang_nuoc'   => 'Tiêu chuẩn kháng nước',
    ],
];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo hien_thi($sp, 'ten_san_pham'); ?> - YADEA</title>
  <link rel="stylesheet" href="../style.css">
  <link rel="icon" href="../image/logo-yadea.svg" type="image/svg+xml">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <style>
    * { box-sizing: border-box; font-family: 'Montserrat', sans-serif; }
    body, html { margin: 0; padding: 0; height: 100%; }

    /* ===== HERO BANNER: ảnh nền lấy từ admin, có lớp phủ tối để chữ trắng luôn rõ ===== */
    .container-fluid.hero-banner {
      position: relative;
      background: <?php echo $nen_banner ? "url('" . htmlspecialchars($nen_banner) . "')" : 'linear-gradient(135deg, #1a1a1a, #333)'; ?>;
      background-size: cover;
      background-position: center;
      padding: 80px 20px;
    }
    .container-fluid.hero-banner::before {
      content: '';
      position: absolute;
      inset: 0;
      background: <?php echo $nen_banner ? 'rgba(0,0,0,0.45)' : 'transparent'; ?>;
    }
    .hero-banner .row { position: relative; z-index: 1; }
    .hero-banner .col-3, .hero-banner .col-6 { color: white; }

    .cssbuttons-io-button {
      background: var(--accent, #FF5F00);
      color: white;
      font-family: inherit;
      padding: 0.35em;
      padding-left: 1.2em;
      font-size: 17px;
      font-weight: 500;
      border-radius: 0.9em;
      border: none;
      letter-spacing: 0.05em;
      display: flex;
      align-items: center;
      overflow: hidden;
      position: relative;
      height: 2.8em;
      padding-right: 3.3em;
      cursor: pointer;
      margin-top: 20px;
    }
    .cssbuttons-io-button .icon {
      background: white;
      margin-left: 1em;
      position: absolute;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 2.2em;
      width: 2.2em;
      border-radius: 0.7em;
      right: 0.3em;
      transition: all 0.3s;
    }
    .cssbuttons-io-button:hover .icon { width: calc(100% - 0.6em); }
    .cssbuttons-io-button .icon svg { width: 1.1em; transition: transform 0.3s; color: var(--accent, #FF5F00); }
    .cssbuttons-io-button:hover .icon svg { transform: translateX(0.1em); }

    .tocdo {
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 12px;
      padding: 20px;
      margin-top: 20px;
    }
    .tocdo div { margin-bottom: 15px; font-size: 16px; }
    .tocdo b { display: block; font-size: 20px; color: var(--accent, #6FCAFF); }

    /* ===== KHỐI TÍNH NĂNG NỔI BẬT (ảnh + chữ xen kẽ) ===== */
    .tinhnang-section { background: #F2F3F5; padding: 70px 30px; }
    .tinhnang-row { margin-bottom: 60px; }
    .tinhnang-row:last-child { margin-bottom: 0; }
    .tinhnang-row h4 { color: black; font-weight: bold; font-size: 1.5rem; margin-bottom: 18px; }
    .tinhnang-row ul { list-style: none; padding: 0; margin: 0; }
    .tinhnang-row ul li {
      font-size: 1.05rem; color: #333; margin-bottom: 12px; padding-left: 26px; position: relative;
    }
    .tinhnang-row ul li::before {
      content: '▾'; position: absolute; left: 0; top: 0; color: var(--accent, #FE6E16);
    }
    .tinhnang-row img { border-radius: 12px; max-width: 100%; }

    .specs-section { background: #f6f6f6; padding: 60px 20px; }
    .title { text-align: center; font-size: 2.8rem; font-weight: bold; }
    .title span { color: var(--accent, #E75D19); }
    .specs-product { text-align: center; margin: 40px 0; }
    .specs-product .product-img { width: 280px; margin-bottom: 20px; }
    .product-name { font-weight: bold; }
    .product-price { color: var(--accent, #E75D19); font-size: 1.2rem; font-weight: 600; }

    .accordion { max-width: 100%; margin: auto; }
    .accordion-item { border: 1px solid #ddd; margin-bottom: 10px; border-radius: 6px; overflow: hidden; }
    .accordion-header {
      width: 100%; background: #eaeaea; padding: 15px 20px; font-weight: bold;
      text-align: left; border: none; outline: none; font-size: 1.1rem;
      display: flex; justify-content: space-between; cursor: pointer;
    }
    .accordion-body { background: #fff; padding: 15px 20px; display: none; }
    .accordion-item.active .accordion-body { display: block; }
    .accordion-item .arrow { transition: transform 0.3s; }
    .accordion-item.active .arrow { transform: rotate(90deg); }
    table { width: 100%; border-collapse: collapse; }
    td { padding: 10px; border-bottom: 1px solid #eee; color: #333; }

    .mo-ta-section { padding: 60px 30px; background: #fff; }
    .mo-ta-section h4 { font-weight: bold; margin-bottom: 15px; }
    .mo-ta-section p { font-size: 1.05rem; color: #333; line-height: 1.7; white-space: pre-line; }

    .gallery-section { padding: 40px 30px; text-align: center; }
    .gallery-section img {
      width: 220px; height: 160px; object-fit: cover; border-radius: 10px; margin: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body style="--accent: <?php echo htmlspecialchars($mau_chu_dao); ?>;">

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
    <div class="menu-nav">
      <ul>
        <li><a href="../xemaydien.php">Xe Máy Điện</a></li>
        <li><a href="../xeganmay.php">Xe Gắn Máy</a></li>
        <li><a href="../ve-yadea">Về YADEA</a></li>
        <li><a href="../cuahang">Cửa Hàng</a></li>
      </ul>
    </div>
  </div>

  <!-- ===== HERO: ẢNH NỀN ĐỘNG + ẢNH ĐẠI DIỆN + GIÁ + THÔNG SỐ NHANH ===== -->
  <div class="container-fluid hero-banner">
    <div class="row align-items-center">
      <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <b style="color: white; font-size: 38px;"><?php echo hien_thi($sp, 'ten_san_pham'); ?></b><br>
        <strong style="color: white; font-size: 20px;"><?php echo htmlspecialchars($sp['loai_xe']); ?></strong><br>
        <hr width="100%" size="5px"/>
        <p style="color: white;">Giá bán lẻ đề xuất:</p>
        <b style="color: var(--accent); font-size: 40px;"><?php echo hien_thi($sp, 'gia'); ?></b>
        <a href="#specs-section" style="text-decoration: none;">
          <button class="cssbuttons-io-button">
            Chọn Mua Sản Phẩm
            <div class="icon">
              <svg height="24" width="24" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0z" fill="none"></path>
                <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z" fill="currentColor"></path>
              </svg>
            </div>
          </button>
        </a>
      </div>
      <div class="col-6 text-center">
        <img src="<?php echo htmlspecialchars($anh_dai_dien); ?>" alt="<?php echo hien_thi($sp, 'ten_san_pham'); ?>" class="img-fluid">
      </div>
      <div class="col-3">
        <div class="tocdo">
          <?php if (!empty($sp['toc_do_toi_da'])): ?>
            <div>Tốc độ tối đa <b><?php echo hien_thi($sp, 'toc_do_toi_da'); ?></b></div>
          <?php endif; ?>
          <?php if (!empty($sp['quang_duong'])): ?>
            <div>Quãng đường <b><?php echo hien_thi($sp, 'quang_duong'); ?></b></div>
          <?php endif; ?>
          <?php if (!empty($sp['dung_luong_pin'])): ?>
            <div>Dung lượng pin <b><?php echo hien_thi($sp, 'dung_luong_pin'); ?></b></div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- ===== MÔ TẢ SẢN PHẨM ===== -->
  <?php if (!empty($sp['mo_ta'])): ?>
  <section class="mo-ta-section">
    <div class="row">
      <div class="col-md-12">
        <h4>GIỚI THIỆU SẢN PHẨM</h4>
        <p><?php echo nl2br(htmlspecialchars($sp['mo_ta'])); ?></p>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- ===== CÁC KHỐI TÍNH NĂNG NỔI BẬT: ẢNH + CHỮ XEN KẼ TRÁI/PHẢI ===== -->
  <?php if (!empty($danh_sach_tinhnang)): ?>
  <section class="tinhnang-section">
    <div class="container">
      <?php foreach ($danh_sach_tinhnang as $index => $tn): ?>
        <?php $anh_ben_phai = ($index % 2 === 0); // xen kẽ: khối chẵn ảnh bên phải, khối lẻ ảnh bên trái ?>
        <div class="row align-items-center tinhnang-row" data-aos="fade-up">
          <?php if (!$anh_ben_phai): ?>
          <div class="col-md-6 text-center" data-aos="fade-right">
            <?php if (!empty($tn['hinh_anh'])): ?>
              <img src="../<?php echo htmlspecialchars($tn['hinh_anh']); ?>" alt="<?php echo htmlspecialchars($tn['tieu_de']); ?>">
            <?php endif; ?>
          </div>
          <?php endif; ?>

          <div class="col-md-6" data-aos="fade-up">
            <h4><?php echo htmlspecialchars($tn['tieu_de']); ?></h4>
            <?php echo xuat_gach_dau_dong($tn['mo_ta']); ?>
          </div>

          <?php if ($anh_ben_phai): ?>
          <div class="col-md-6 text-center" data-aos="fade-left">
            <?php if (!empty($tn['hinh_anh'])): ?>
              <img src="../<?php echo htmlspecialchars($tn['hinh_anh']); ?>" alt="<?php echo htmlspecialchars($tn['tieu_de']); ?>">
            <?php endif; ?>
          </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
  <?php endif; ?>

  <!-- ===== ALBUM ẢNH PHỤ ===== -->
  <?php if (!empty($anh_phu)): ?>
  <section class="gallery-section">
    <h4 style="font-weight:bold; margin-bottom: 10px;">HÌNH ẢNH SẢN PHẨM</h4>
    <?php foreach ($anh_phu as $duong_dan): ?>
      <img src="../<?php echo htmlspecialchars($duong_dan); ?>" alt="<?php echo hien_thi($sp, 'ten_san_pham'); ?>">
    <?php endforeach; ?>
  </section>
  <?php endif; ?>

  <!-- ===== THÔNG SỐ KỸ THUẬT ===== -->
  <section class="specs-section" id="specs-section">
    <div class="container">
      <h2 class="title">THÔNG SỐ <span>KỸ THUẬT</span></h2>

      <div class="specs-product">
        <img src="<?php echo htmlspecialchars($anh_dai_dien); ?>" alt="<?php echo hien_thi($sp, 'ten_san_pham'); ?>" class="product-img" />
        <p class="product-name"><?php echo hien_thi($sp, 'ten_san_pham'); ?></p>
        <p class="product-price"><?php echo hien_thi($sp, 'gia'); ?></p>
        <center>
          <a href="../sanpham/<?php echo htmlspecialchars($sp['slug']); ?>" style="text-decoration: none;">
          <button class="cssbuttons-io-button">
          Chọn Mua Sản Phẩm
          <div class="icon">
            <svg height="24" width="24" viewBox="0 0 24 24">
              <path d="M0 0h24v24H0z" fill="none"></path>
              <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z" fill="currentColor"></path>
            </svg>
          </div>
        </button>
        </a>
        </center>
      </div>

      <div class="accordion">
        <?php $dau_tien = true; ?>
        <?php foreach ($nhom_thong_so as $ten_nhom => $danh_sach_truong): ?>
          <?php
            $co_du_lieu = false;
            foreach ($danh_sach_truong as $key => $label) {
                if (!empty($sp[$key])) { $co_du_lieu = true; break; }
            }
            if (!$co_du_lieu) continue;
          ?>
          <div class="accordion-item <?php echo $dau_tien ? 'active' : ''; ?>">
            <button class="accordion-header">
              <?php echo $ten_nhom; ?>
              <span class="arrow">▶</span>
            </button>
            <div class="accordion-body">
              <table>
                <?php foreach ($danh_sach_truong as $key => $label): ?>
                  <?php if (!empty($sp[$key])): ?>
                    <tr><td><?php echo $label; ?></td><td><?php echo hien_thi($sp, $key); ?></td></tr>
                  <?php endif; ?>
                <?php endforeach; ?>
              </table>
            </div>
          </div>
          <?php $dau_tien = false; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ===== FOOTER ===== -->
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
              <p><strong>Hỗ Trợ</strong></p>
              <li><a href="#">Hỗ Trợ & Bảo Hành</a></li>
              <li><a href="#">Thanh Toán</a></li>
              <li><a href="#">Vận Chuyển</a></li>
              <li><a href="#">Chính Sách Đổi Trả</a></li>
            </ul>
          </div>
          <div class="col-md-3">
            <p><strong>Theo Dõi YADEA</strong></p>
            <div class="contact-info">
              <p><strong>CSKH:</strong> 1900636803</p>
              <p><strong>Email:</strong> market@yadea.com.vn</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>AOS.init({ once: true });</script>
  <script>
    document.querySelectorAll('.accordion-header').forEach(button => {
      button.addEventListener('click', () => {
        button.parentElement.classList.toggle('active');
      });
    });
  </script>
</body>
</html>