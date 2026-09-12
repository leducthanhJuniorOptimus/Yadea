<?php
$bank_code = "VCB";                 
$account_number = "1043461831";     
$account_name = "Lê Đức Thành";
$bank_name = "Ngân hàng TMCP Ngoại thương Việt Nam (Vietcombank)";

$product_id    = $_POST['product_id'] ?? '';
$product_image = $_POST['product_image'] ?? '';
$product_price = $_POST['product_price'] ?? '';
$product_name  = $_POST['product_name'] ?? '';
$product_color = $_POST['product_color'] ?? '';
$price_clean = floatval(str_replace(',', '', $product_price));
$grandTotal = $price_clean;
$content = "Thanh toan cho san pham: $product_name, Gia: " . number_format($price_clean, 0, ',', '.') . " VND";
$qr_url = "https://img.vietqr.io/image/{$bank_code}-{$account_number}-compact2.png?amount={$grandTotal}&addInfo=" . urlencode($content);
// Thêm sản phẩm vào danh sạch duyệt đơn hàng.php (duyetdonhang.php)
require_once '../config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_SESSION['last_sent']) && time() - $_SESSION['last_sent'] < 30) {
        echo "<script>alert('Vui lòng chờ 30 giây trước khi gửi lại.'); history.back();</script>";
        exit;
    }

    $_SESSION['last_sent'] = time();

    $ten            = trim($_POST['fullname'] ?? '');
    $sdt            = trim($_POST['phone'] ?? '');
    $email          = trim($_POST['email'] ?? '');
    $cmnd           = trim($_POST['cmnd'] ?? '');
    $showroom       = trim($_POST['showroom'] ?? '');
    $payment_method = trim($_POST['payment_method'] ?? 'Thanh toán trực tiếp tại showroom');
    
    $product_id     = !empty($_POST['product_id']) ? intval($_POST['product_id']) : null;
    $product_name   = trim($_POST['product_name'] ?? '');
    $product_color  = trim($_POST['product_color'] ?? '');
    $product_price  = $_POST['product_price'] ?? '0';
    $product_image  = $_POST['product_image'] ?? '';

    $price_numeric  = (float) preg_replace('/[^0-9]/', '', $product_price);
    $price_formated = number_format($price_numeric, 0, ',', '.') . ' VND';

    $ma_don_hang    = 'YD' . date('ymd') . rand(1000, 9999);


    $ten_escaped            = $conn->real_escape_string($ten);
    $cmnd_escaped           = $conn->real_escape_string($cmnd);
    $sdt_escaped            = $conn->real_escape_string($sdt);
    $email_escaped          = $conn->real_escape_string($email);
    $product_name_escaped   = $conn->real_escape_string($product_name);
    $product_color_escaped  = $conn->real_escape_string($product_color);
    $price_formated_escaped = $conn->real_escape_string($price_formated);
    $payment_method_escaped = $conn->real_escape_string($payment_method);
    $showroom_escaped       = $conn->real_escape_string($showroom);
    $ma_don_hang_escaped    = $conn->real_escape_string($ma_don_hang);
    
    $product_id_sql = !empty($product_id) ? intval($product_id) : "NULL";

    $sql = "INSERT INTO don_hang (
                ho_ten, cmnd, so_dien_thoai, email, 
                ten_xe, mau_xe, gia_xe, so_luong, 
                hinh_thuc_thanh_toan, showroom_nhan_xe, 
                ma_don_hang, trang_thai, product_id
            ) VALUES (
                '$ten_escaped',
                '$cmnd_escaped',
                '$sdt_escaped',
                '$email_escaped',
                '$product_name_escaped',
                '$product_color_escaped',
                '$price_formated_escaped',
                1,
                '$payment_method_escaped',
                '$showroom_escaped',
                '$ma_don_hang_escaped',
                'pending',
                $product_id_sql
            )";

    $result = $conn->query($sql);

    if (!$result) {
        die("Lỗi lưu đơn hàng vào CSDL: " . $conn->error);
    }
}
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
    <link rel="stylesheet" href="../css/style.css">
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

        .product-preview .mau-da-chon {
            display: inline-block;
            background: #fff3ea;
            color: #FE6E16;
            font-weight: 600;
            font-size: 14px;
            padding: 6px 16px;
            border-radius: 20px;
            margin-bottom: 10px;
        }

        #qrCodeContainer {
            display: none;
            margin-top: 15px;
        }

        #qrCodeContainer .card {
            background: #f8f9fa;
            padding: 15px;
        }

        #qrCodeContainer img {
            max-width: 350px;
            border-radius: 10px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            main {
                padding: 20px;
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

    <br><br><br><br><br>
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
                            <h3 class="section-title mt-4">Phương Thức Thanh Toán</h3>
                            <div class="mb-3">
                                <select name="payment_method" class="form-select" id="payment_method" required>
                                    <option value="">-- Chọn Phương Thức --</option>
                                    <option value="Thanh toán trực tiếp tại showroom">Thanh toán trực tiếp tại showroom</option>
                                    <option value="Thanh toán qua ví điện tử">Thanh toán qua ví điện tử</option>
                                </select>
                            </div>

                            <div id="qrCodeContainer">
                                <div class="card p-3 text-center" style="background: #f8f9fa; border: 1px dashed #dee2e6;">
                                    <p class="text-muted mb-2"> Quét mã QR để thanh toán qua ví điện tử:</p>
                                    <img src="<?= $qr_url ?>" alt="QR Code" id="qrCode">
                                    <p class="small text-muted mt-2">Ngân hàng: <?= $bank_name ?></p>
                                    <p class="small text-muted">Số tài khoản: <?= $account_number ?></p>
                                </div>
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
                                <?php if ($product_name && $product_price): ?>
                                    <?php if ($product_image): ?>
                                        <img src="<?= htmlspecialchars($product_image) ?>" alt="Sản phẩm" class="img-fluid rounded">
                                    <?php endif; ?>

                                    <?php if ($product_color): ?>
                                        <div class="mau-da-chon"><?= htmlspecialchars($product_color) ?></div>
                                    <?php endif; ?>

                                    <div class="price mt-3">Tên Sản Phẩm: <?= htmlspecialchars($product_name) ?></div>
                                    <div class="price mt-3">Giá: <?= number_format(floatval(str_replace(',', '', $product_price)), 0, ',', '.') ?> VND</div>
                                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product_id) ?>">
                                    <input type="hidden" name="product_image" value="<?= htmlspecialchars($product_image) ?>">
                                    <input type="hidden" name="product_price" value="<?= htmlspecialchars($product_price) ?>">
                                    <input type="hidden" name="product_name" value="<?= htmlspecialchars($product_name) ?>">
                                    <input type="hidden" name="product_color" value="<?= htmlspecialchars($product_color) ?>">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentSelect = document.getElementById('payment_method');
            const qrContainer = document.getElementById('qrCodeContainer');

            qrContainer.style.display = 'none';

            paymentSelect.addEventListener('change', function() {
                if (this.value === 'Thanh toán qua ví điện tử') {
                    qrContainer.style.display = 'block';
                    qrContainer.style.animation = 'fadeIn 0.3s ease';
                } else {
                    qrContainer.style.display = 'none';
                }
            });
        });
    </script>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        #qrCodeContainer {
            transition: all 0.3s ease;
        }
    </style>
</body>
</html>