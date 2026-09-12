<?php
require_once '../config.php';

$slug = $_GET['slug'] ?? '';
if ($slug === '') {
    $requestUri = $_SERVER['REQUEST_URI'] ?? '';
    $basePath = '/Yadea/sanpham/';
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

// Ảnh theo từng màu (nếu admin có thêm); nếu không có thì chỉ dùng 1 ảnh đại diện, không hiện bộ chọn màu
$danh_sach_mauxe = [];
$stmt2 = $conn->prepare("SELECT hinh_anh FROM sanpham_mauxe WHERE sanpham_id = ? ORDER BY thu_tu ASC");
$stmt2->bind_param("i", $sp['id']);
$stmt2->execute();
$res2 = $stmt2->get_result();
while ($row = $res2->fetch_assoc()) { $danh_sach_mauxe[] = '../' . $row['hinh_anh']; }

// Nếu chưa có ảnh màu nào thì lấy tạm ảnh đại diện làm ảnh duy nhất
if (empty($danh_sach_mauxe)) {
    $danh_sach_mauxe[] = !empty($sp['hinh_anh']) ? '../' . $sp['hinh_anh'] : '../image/no-image.png';
}

$mau_chu_dao = !empty($sp['mau_chu_dao']) ? $sp['mau_chu_dao'] : '#ff6200';

function hien_thi($sp, $key) {
    return !empty($sp[$key]) ? htmlspecialchars($sp[$key]) : '';
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?php echo hien_thi($sp, 'ten_san_pham'); ?> - YADEA</title>
  <link rel="icon" href="../image/logo-yadea.svg" type="image/svg+xml">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Montserrat', sans-serif;
    }

    body {
      margin: 0;
      padding: 0;
      background-color: #fff;
      height: 100vh;
      --accent: <?php echo htmlspecialchars($mau_chu_dao); ?>;
    }

    .container {
      display: flex;
      flex-direction: row;
      height: 100vh;
    }

    .back-button {
      position: absolute;
      top: 20px;
      left: 20px;
      color: var(--accent);
      text-decoration: none;
      font-size: 16px;
      z-index: 10;
    }

    .product-image {
      width: 55%;
      background-color: #f9f9f9;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 30px;
      position: relative;
    }

    .bike-image {
      width: 800px;
      max-width: 100%;
      height: auto;
      border-radius: 10px;
      object-fit: contain;
    }

    .specs {
      display: flex;
      justify-content: space-between;
      margin-top: 30px;
      width: 100%;
      max-width: 500px;
      color: #666;
      font-size: 23px;
    }

    .spec-item {
      text-align: center;
      flex: 1;
    }

    .spec-item span {
      display: block;
      color: var(--accent);
      font-weight: bold;
      margin-top: 5px;
    }

    .nav-buttons {
      position: absolute;
      top: 50%;
      width: 100%;
      display: flex;
      justify-content: space-between;
      transform: translateY(-50%);
    }

    .nav-buttons button {
      background-color: rgba(255, 255, 255, 0.7);
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      font-size: 18px;
      border-radius: 5px;
      color: var(--accent);
    }

    .product-details {
      width: 45%;
      padding: 40px;
      display: flex;
      flex-direction: column;
    }

    .product-details h1 {
      font-size: 2.8rem;
      color: #000;
    }

    .color-options {
      margin-bottom: 20px;
    }

    .color-options label.chon-mau-label {
      font-size: 1rem;
      color: #333;
      margin-right: 10px;
    }

    .color-picker {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 10px;
    }

    /* Mỗi màu = 1 ảnh thumbnail thay vì hình tròn màu đơn sắc */
    .color-thumb {
      width: 56px;
      height: 56px;
      border-radius: 10px;
      object-fit: cover;
      cursor: pointer;
      border: 3px solid transparent;
      transition: border-color 0.2s;
    }

    .color-thumb.active,
    .color-thumb:hover {
      border-color: var(--accent);
    }

    .price-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .price-section b {
      font-size: 1rem;
      color: #666;
    }

    .price-sp {
      margin-left: auto;
      display: flex;
      align-items: flex-end;
      justify-content: flex-end;
    }

    .price-sp h4 {
      font-size: 1.5rem;
      color: var(--accent);
      margin: 0;
    }

    .buy-now {
      background-color: var(--accent);
      color: #fff;
      border: none;
      padding: 15px 30px;
      font-size: 1.2rem;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
      transition: opacity 0.3s ease;
    }

    .buy-now:hover {
      opacity: 0.9;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        height: auto;
      }

      .product-image, .product-details {
        width: 100%;
      }

      .product-details {
        padding: 20px;
      }

      .specs {
        flex-wrap: wrap;
      }
    }
  </style>
</head>
<body>
  <a href="../thongtinsanpham/<?php echo htmlspecialchars($sp['slug']); ?>" class="back-button">&lt; Trở lại</a>
  <div class="container">
    <div class="product-image">
      <?php if (count($danh_sach_mauxe) > 1): ?>
      <div class="nav-buttons">
        <button onclick="prevColor()">&#10094;</button>
        <button onclick="nextColor()">&#10095;</button>
      </div>
      <?php endif; ?>
      <img id="bikeImage" src="<?php echo htmlspecialchars($danh_sach_mauxe[0]); ?>" alt="<?php echo hien_thi($sp, 'ten_san_pham'); ?>" class="bike-image" />
      <div class="specs">
        <?php if (!empty($sp['toc_do_toi_da'])): ?>
          <div class="spec-item">Tốc độ<br><span><?php echo hien_thi($sp, 'toc_do_toi_da'); ?></span></div>
        <?php endif; ?>
        <?php if (!empty($sp['quang_duong'])): ?>
          <div class="spec-item">Quãng đường<br><span><?php echo hien_thi($sp, 'quang_duong'); ?></span></div>
        <?php endif; ?>
        <?php if (!empty($sp['dung_luong_pin'])): ?>
          <div class="spec-item">Dung lượng pin<br><span><?php echo hien_thi($sp, 'dung_luong_pin'); ?></span></div>
        <?php endif; ?>
      </div>
    </div>
    <div class="product-details">
      <h1><?php echo hien_thi($sp, 'ten_san_pham'); ?></h1>

      <?php if (count($danh_sach_mauxe) > 1): ?>
      <div class="color-options">
        <label class="chon-mau-label">Chọn màu sắc:</label>
        <div class="color-picker" id="colorPicker">
          <?php foreach ($danh_sach_mauxe as $i => $anh): ?>
            <img src="<?php echo htmlspecialchars($anh); ?>"
                 class="color-thumb <?php echo $i === 0 ? 'active' : ''; ?>"
                 onclick="changeColor(<?php echo $i; ?>)">
          <?php endforeach; ?>
        </div>
        <center><hr width="100%" size="1px"/></center>
      </div>
      <?php endif; ?>

      <div class="price-section">
        <b>Số tiền thanh toán :</b>
        <div class="price-sp">
          <h4><?php echo hien_thi($sp, 'gia'); ?></h4>
        </div>
      </div>
      <p style="font-size: 0.7em; color: #999; margin-top: -10px; margin-bottom: 20px;">
        *Giá bán xe đã bao gồm thuế VAT, chưa bao gồm thuế trước bạ và biển số
      </p>

      <form id="checkoutForm" method="POST" action="../thanhtoan/">
        <input type="hidden" name="product_id" value="<?php echo (int)$sp['id']; ?>">
        <input type="hidden" name="product_image" id="product_image">
        <input type="hidden" name="product_color" id="product_color">
        <input type="hidden" name="product_price" id="product_price" value="<?php echo hien_thi($sp, 'gia'); ?>">
        <input type="hidden" name="product_name" id="product_name" value="<?php echo hien_thi($sp, 'ten_san_pham'); ?>">
        <button type="submit" class="buy-now">MUA NGAY</button>
      </form>
    </div>
  </div>

  <script>
    const images = <?php echo json_encode($danh_sach_mauxe); ?>;
    const soLuongMau = images.length;
    let currentIndex = 0;

    function updateImage() {
      document.getElementById('bikeImage').src = images[currentIndex];
      document.querySelectorAll('.color-thumb').forEach((el, i) => {
        el.classList.toggle('active', i === currentIndex);
      });
    }

    function nextColor() {
      currentIndex = (currentIndex + 1) % images.length;
      updateImage();
    }

    function prevColor() {
      currentIndex = (currentIndex - 1 + images.length) % images.length;
      updateImage();
    }

    function changeColor(index) {
      currentIndex = index;
      updateImage();
    }

    document.getElementById('checkoutForm').addEventListener('submit', function () {
      document.getElementById('product_image').value = images[currentIndex];
      document.getElementById('product_color').value = soLuongMau > 1 ? ('Màu ' + (currentIndex + 1)) : '';
    });
  </script>
</body>
</html>