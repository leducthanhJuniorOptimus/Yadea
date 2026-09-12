<?php
require_once 'auth.php';
require_once '../config.php';

$thong_bao = "";
$loai_thong_bao = "";

$cac_truong_chi_tiet = [
    'cong_suat_danh_dinh'      => 'Công suất danh định',
    'cong_suat_toi_da'         => 'Công suất tối đa',
    'toc_do_toi_da'            => 'Tốc độ tối đa',
    'quang_duong'              => 'Quãng đường di chuyển',
    'dung_luong_pin'           => 'Dung lượng pin',
    'loai_acquy'               => 'Loại ắc quy',
    'thoi_gian_sac'            => 'Thời gian sạc',
    'leo_doc'                  => 'Khả năng leo dốc',
    'gia_toc'                  => 'Gia tốc',
    'he_thong_phanh'           => 'Hệ thống phanh',
    'loai_lop'                 => 'Loại lốp',
    'kich_thuoc'               => 'Kích thước',
    'khoi_luong'                => 'Khối lượng',
    'tai_trong_toi_da'         => 'Tải trọng tối đa',
    'dung_tich_cop'            => 'Dung tích cốp',
    'man_hinh'                 => 'Màn hình',
    'do_sang_den_pha'          => 'Độ sáng đèn pha',
    'khoang_cach_chieu_sang'   => 'Khoảng cách chiếu sáng',
    'tieu_chuan_khang_nuoc'    => 'Tiêu chuẩn kháng nước',
];

$thu_muc_upload = '../image/sanpham/';
if (!is_dir($thu_muc_upload)) {
    mkdir($thu_muc_upload, 0777, true);
}

// ===== XOÁ 1 ẢNH TRONG ALBUM PHỤ =====
if (isset($_GET['xoa_anh'])) {
    $id_anh = intval($_GET['xoa_anh']);
    $id_sp_ve = intval($_GET['ve_sanpham'] ?? 0);
    $res = $conn->query("SELECT duong_dan FROM sanpham_anh WHERE id = $id_anh");
    if ($row = $res->fetch_assoc()) {
        if (file_exists('../' . $row['duong_dan'])) { @unlink('../' . $row['duong_dan']); }
    }
    $conn->query("DELETE FROM sanpham_anh WHERE id = $id_anh");
    header('Location: index.php?edit=' . $id_sp_ve);
    exit();
}

// ===== XOÁ 1 ẢNH MÀU XE =====
if (isset($_GET['xoa_mau'])) {
    $id_mau = intval($_GET['xoa_mau']);
    $id_sp_ve = intval($_GET['ve_sanpham'] ?? 0);
    $res = $conn->query("SELECT hinh_anh FROM sanpham_mauxe WHERE id = $id_mau");
    if ($row = $res->fetch_assoc()) {
        if (file_exists('../' . $row['hinh_anh'])) { @unlink('../' . $row['hinh_anh']); }
    }
    $conn->query("DELETE FROM sanpham_mauxe WHERE id = $id_mau");
    header('Location: index.php?edit=' . $id_sp_ve);
    exit();
}

// ===== XOÁ SẢN PHẨM =====
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    $res = $conn->query("SELECT hinh_anh, nen_banner FROM sanpham WHERE id = $id");
    if ($row = $res->fetch_assoc()) {
        if (!empty($row['hinh_anh']) && file_exists('../' . $row['hinh_anh'])) { @unlink('../' . $row['hinh_anh']); }
        if (!empty($row['nen_banner']) && file_exists('../' . $row['nen_banner'])) { @unlink('../' . $row['nen_banner']); }
    }
    $res_anh = $conn->query("SELECT duong_dan FROM sanpham_anh WHERE sanpham_id = $id");
    while ($row = $res_anh->fetch_assoc()) {
        if (file_exists('../' . $row['duong_dan'])) { @unlink('../' . $row['duong_dan']); }
    }
    $res_tn = $conn->query("SELECT hinh_anh FROM sanpham_tinhnang WHERE sanpham_id = $id");
    while ($row = $res_tn->fetch_assoc()) {
        if (!empty($row['hinh_anh']) && file_exists('../' . $row['hinh_anh'])) { @unlink('../' . $row['hinh_anh']); }
    }
    $res_mau = $conn->query("SELECT hinh_anh FROM sanpham_mauxe WHERE sanpham_id = $id");
    while ($row = $res_mau->fetch_assoc()) {
        if (!empty($row['hinh_anh']) && file_exists('../' . $row['hinh_anh'])) { @unlink('../' . $row['hinh_anh']); }
    }

    if ($conn->query("DELETE FROM sanpham WHERE id = $id")) {
        header('Location: index.php?msg=deleted');
        exit();
    } else {
        $thong_bao = "Xoá sản phẩm thất bại: " . $conn->error;
        $loai_thong_bao = "error";
    }
}

// ===== THÊM / SỬA SẢN PHẨM =====
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['luu_san_pham'])) {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    $ten_san_pham = trim($_POST['ten_san_pham']);
    $gia = trim($_POST['gia']);
    $loai_xe = trim($_POST['loai_xe']);
    $mo_ta = trim($_POST['mo_ta']);
    $mau_chu_dao = trim($_POST['mau_chu_dao'] ?? '#FF5F00');

    $slug_nhap = trim($_POST['slug'] ?? '');
    $goc_de_tao_slug = $slug_nhap !== '' ? $slug_nhap : $ten_san_pham;
    $slug = tao_slug_duy_nhat($conn, $goc_de_tao_slug, $id);

    $chi_tiet_data = [];
    foreach ($cac_truong_chi_tiet as $key => $label) {
        $chi_tiet_data[$key] = trim($_POST[$key] ?? '');
    }

    // Ảnh đại diện
    $ten_file_anh = $_POST['anh_hien_tai'] ?? '';
    if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['error'] === 0) {
        $duoi = pathinfo($_FILES['hinh_anh']['name'], PATHINFO_EXTENSION);
        $ten_moi = uniqid('sp_') . '.' . $duoi;
        if (move_uploaded_file($_FILES['hinh_anh']['tmp_name'], '../image/sanpham/' . $ten_moi)) {
            if ($id > 0 && !empty($ten_file_anh) && file_exists('../' . $ten_file_anh)) { @unlink('../' . $ten_file_anh); }
            $ten_file_anh = 'image/sanpham/' . $ten_moi;
        }
    }

    // Ảnh nền banner (hero-banner)
    $ten_file_nen = $_POST['nen_banner_hien_tai'] ?? '';
    if (isset($_FILES['nen_banner']) && $_FILES['nen_banner']['error'] === 0) {
        $duoi = pathinfo($_FILES['nen_banner']['name'], PATHINFO_EXTENSION);
        $ten_moi = uniqid('nen_') . '.' . $duoi;
        if (move_uploaded_file($_FILES['nen_banner']['tmp_name'], '../image/sanpham/' . $ten_moi)) {
            if ($id > 0 && !empty($ten_file_nen) && file_exists('../' . $ten_file_nen)) { @unlink('../' . $ten_file_nen); }
            $ten_file_nen = 'image/sanpham/' . $ten_moi;
        }
    }

    if ($ten_san_pham === '' || $loai_xe === '') {
        $thong_bao = "Vui lòng nhập tên sản phẩm và chọn loại xe.";
        $loai_thong_bao = "error";
    } else {
        if ($id > 0) {
            $stmt = $conn->prepare("UPDATE sanpham SET
                ten_san_pham=?, slug=?, gia=?, loai_xe=?,
                cong_suat_danh_dinh=?, cong_suat_toi_da=?, toc_do_toi_da=?, quang_duong=?,
                dung_luong_pin=?, loai_acquy=?, thoi_gian_sac=?, leo_doc=?, gia_toc=?,
                he_thong_phanh=?, loai_lop=?, kich_thuoc=?, khoi_luong=?, tai_trong_toi_da=?,
                dung_tich_cop=?, man_hinh=?, do_sang_den_pha=?, khoang_cach_chieu_sang=?,
                tieu_chuan_khang_nuoc=?, mo_ta=?, hinh_anh=?, mau_chu_dao=?, nen_banner=?
                WHERE id=?");
            $stmt->bind_param(
                "ssssssssssssssssssssssssssi",
                $ten_san_pham, $slug, $gia, $loai_xe,
                $chi_tiet_data['cong_suat_danh_dinh'], $chi_tiet_data['cong_suat_toi_da'],
                $chi_tiet_data['toc_do_toi_da'], $chi_tiet_data['quang_duong'],
                $chi_tiet_data['dung_luong_pin'], $chi_tiet_data['loai_acquy'],
                $chi_tiet_data['thoi_gian_sac'], $chi_tiet_data['leo_doc'], $chi_tiet_data['gia_toc'],
                $chi_tiet_data['he_thong_phanh'], $chi_tiet_data['loai_lop'], $chi_tiet_data['kich_thuoc'],
                $chi_tiet_data['khoi_luong'], $chi_tiet_data['tai_trong_toi_da'], $chi_tiet_data['dung_tich_cop'],
                $chi_tiet_data['man_hinh'], $chi_tiet_data['do_sang_den_pha'],
                $chi_tiet_data['khoang_cach_chieu_sang'], $chi_tiet_data['tieu_chuan_khang_nuoc'],
                $mo_ta, $ten_file_anh, $mau_chu_dao, $ten_file_nen, $id
            );
            $stmt->execute();
            $id_sp = $id;
        } else {
            $stmt = $conn->prepare("INSERT INTO sanpham
                (ten_san_pham, slug, gia, loai_xe, cong_suat_danh_dinh, cong_suat_toi_da, toc_do_toi_da,
                quang_duong, dung_luong_pin, loai_acquy, thoi_gian_sac, leo_doc, gia_toc,
                he_thong_phanh, loai_lop, kich_thuoc, khoi_luong, tai_trong_toi_da, dung_tich_cop,
                man_hinh, do_sang_den_pha, khoang_cach_chieu_sang, tieu_chuan_khang_nuoc, mo_ta, hinh_anh, mau_chu_dao, nen_banner)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param(
                "sssssssssssssssssssssssssss",
                $ten_san_pham, $slug, $gia, $loai_xe,
                $chi_tiet_data['cong_suat_danh_dinh'], $chi_tiet_data['cong_suat_toi_da'],
                $chi_tiet_data['toc_do_toi_da'], $chi_tiet_data['quang_duong'],
                $chi_tiet_data['dung_luong_pin'], $chi_tiet_data['loai_acquy'],
                $chi_tiet_data['thoi_gian_sac'], $chi_tiet_data['leo_doc'], $chi_tiet_data['gia_toc'],
                $chi_tiet_data['he_thong_phanh'], $chi_tiet_data['loai_lop'], $chi_tiet_data['kich_thuoc'],
                $chi_tiet_data['khoi_luong'], $chi_tiet_data['tai_trong_toi_da'], $chi_tiet_data['dung_tich_cop'],
                $chi_tiet_data['man_hinh'], $chi_tiet_data['do_sang_den_pha'],
                $chi_tiet_data['khoang_cach_chieu_sang'], $chi_tiet_data['tieu_chuan_khang_nuoc'],
                $mo_ta, $ten_file_anh, $mau_chu_dao, $ten_file_nen
            );
            $stmt->execute();
            $id_sp = $conn->insert_id;
        }

        // ---- ẢNH PHỤ (ALBUM) ----
        if (!empty($_FILES['anh_phu']) && isset($_FILES['anh_phu']['tmp_name'])) {
            foreach ($_FILES['anh_phu']['tmp_name'] as $i => $tmp_name) {
                if ($_FILES['anh_phu']['error'][$i] === 0) {
                    $duoi = pathinfo($_FILES['anh_phu']['name'][$i], PATHINFO_EXTENSION);
                    $ten_moi = uniqid('spanh_') . '.' . $duoi;
                    $duong_dan = 'image/sanpham/' . $ten_moi;
                    if (move_uploaded_file($tmp_name, '../' . $duong_dan)) {
                        $stmt3 = $conn->prepare("INSERT INTO sanpham_anh (sanpham_id, duong_dan, thu_tu) VALUES (?, ?, ?)");
                        $stmt3->bind_param("isi", $id_sp, $duong_dan, $i);
                        $stmt3->execute();
                    }
                }
            }
        }

        // ---- CÁC MÀU CỦA XE (ảnh theo từng màu, dùng ở trang sanpham/<slug>) ----
        if (!empty($_FILES['mau_xe']) && isset($_FILES['mau_xe']['tmp_name'])) {
            $res_dem = $conn->query("SELECT COUNT(*) AS dem FROM sanpham_mauxe WHERE sanpham_id = $id_sp");
            $thu_tu_bat_dau = $res_dem->fetch_assoc()['dem'];
            foreach ($_FILES['mau_xe']['tmp_name'] as $i => $tmp_name) {
                if ($_FILES['mau_xe']['error'][$i] === 0) {
                    $duoi = pathinfo($_FILES['mau_xe']['name'][$i], PATHINFO_EXTENSION);
                    $ten_moi = uniqid('mauxe_') . '.' . $duoi;
                    $duong_dan = 'image/sanpham/' . $ten_moi;
                    if (move_uploaded_file($tmp_name, '../' . $duong_dan)) {
                        $thu_tu = $thu_tu_bat_dau + $i;
                        $stmt5 = $conn->prepare("INSERT INTO sanpham_mauxe (sanpham_id, hinh_anh, thu_tu) VALUES (?, ?, ?)");
                        $stmt5->bind_param("isi", $id_sp, $duong_dan, $thu_tu);
                        $stmt5->execute();
                    }
                }
            }
        }

        // ---- KHỐI "TÍNH NĂNG NỔI BẬT" (ảnh + chữ bên cạnh) ----
        $tn_tieude = $_POST['tn_tieude'] ?? [];
        $tn_mota   = $_POST['tn_mota'] ?? [];
        $tn_anh_cu = $_POST['tn_anh_cu'] ?? [];

        $conn->query("DELETE FROM sanpham_tinhnang WHERE sanpham_id = $id_sp");

        foreach ($tn_tieude as $i => $tieu_de) {
            $tieu_de = trim($tieu_de);
            if ($tieu_de === '') continue;

            $mo_ta_tn = trim($tn_mota[$i] ?? '');
            $anh_tn = trim($tn_anh_cu[$i] ?? '');

            if (isset($_FILES['tn_anh']['tmp_name'][$i]) && $_FILES['tn_anh']['error'][$i] === 0) {
                $duoi = pathinfo($_FILES['tn_anh']['name'][$i], PATHINFO_EXTENSION);
                $ten_moi = uniqid('tn_') . '.' . $duoi;
                if (move_uploaded_file($_FILES['tn_anh']['tmp_name'][$i], '../image/sanpham/' . $ten_moi)) {
                    $anh_tn = 'image/sanpham/' . $ten_moi;
                }
            }

            $stmt4 = $conn->prepare("INSERT INTO sanpham_tinhnang (sanpham_id, tieu_de, mo_ta, hinh_anh, thu_tu) VALUES (?,?,?,?,?)");
            $stmt4->bind_param("isssi", $id_sp, $tieu_de, $mo_ta_tn, $anh_tn, $i);
            $stmt4->execute();
        }

        header('Location: index.php?' . ($id > 0 ? 'msg=updated&edit=' . $id_sp : 'msg=added&edit=' . $id_sp));
        exit();
    }
}

if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'added':   $thong_bao = "Thêm sản phẩm thành công!"; $loai_thong_bao = "success"; break;
        case 'updated': $thong_bao = "Cập nhật sản phẩm thành công!"; $loai_thong_bao = "success"; break;
        case 'deleted': $thong_bao = "Đã xoá sản phẩm!"; $loai_thong_bao = "success"; break;
    }
}

$san_pham_sua = null;
$album_anh = [];
$danh_sach_tinhnang = [];
$danh_sach_mauxe = [];
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $res = $conn->query("SELECT * FROM sanpham WHERE id = $id");
    if ($res && $res->num_rows > 0) {
        $san_pham_sua = $res->fetch_assoc();

        $res_album = $conn->query("SELECT * FROM sanpham_anh WHERE sanpham_id = $id ORDER BY thu_tu ASC");
        while ($row = $res_album->fetch_assoc()) { $album_anh[] = $row; }

        $res_tn = $conn->query("SELECT * FROM sanpham_tinhnang WHERE sanpham_id = $id ORDER BY thu_tu ASC");
        while ($row = $res_tn->fetch_assoc()) { $danh_sach_tinhnang[] = $row; }

        $res_mau = $conn->query("SELECT * FROM sanpham_mauxe WHERE sanpham_id = $id ORDER BY thu_tu ASC");
        while ($row = $res_mau->fetch_assoc()) { $danh_sach_mauxe[] = $row; }
    }
}

$loai_loc = $_GET['loai'] ?? 'tatca';
if ($loai_loc === 'xeganmay') {
    $where = "WHERE loai_xe = 'Xe gắn máy'";
} elseif ($loai_loc === 'xemaydien') {
    $where = "WHERE loai_xe = 'Xe máy điện'";
} else {
    $where = "";
}
$ds_san_pham = $conn->query("SELECT * FROM sanpham $where ORDER BY id DESC");

function v($sp, $key) {
    return htmlspecialchars($sp[$key] ?? '');
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm - Yadea</title>
    <link rel="icon" href="../image/logo-yadea.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
    <style>
        .color-row { display: flex; align-items: center; gap: 12px; }
        .color-row input[type="color"] { width: 50px; height: 42px; border: none; border-radius: 8px; cursor: pointer; }
        .slug-preview { font-size: 12px; color: #888; margin-top: 4px; }
        .album-grid { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 10px; }
        .album-item { position: relative; width: 100px; }
        .album-item img { width: 100px; height: 100px; object-fit: cover; border-radius: 8px; }
        .album-item a.xoa-anh {
            position: absolute; top: -6px; right: -6px; background: #d33; color: #fff;
            width: 22px; height: 22px; border-radius: 50%; display: flex; align-items: center;
            justify-content: center; text-decoration: none; font-size: 12px;
        }
        .nen-preview { margin-top: 10px; width: 100%; max-width: 320px; height: 110px; object-fit: cover; border-radius: 10px; }

        .tinhnang-list { display: flex; flex-direction: column; gap: 14px; margin-top: 10px; }
        .tinhnang-block {
            border: 2px dashed #e8e8e8; border-radius: 12px; padding: 16px;
            display: grid; grid-template-columns: 1fr 1fr auto; gap: 14px; align-items: start;
            background: #fafafa;
        }
        .tinhnang-block .form-group { margin: 0; }
        .tinhnang-block textarea { min-height: 70px; }
        .tinhnang-block img.tn-preview { width: 100px; height: 70px; object-fit: cover; border-radius: 8px; margin-top: 6px; }
        .btn-xoa-tn {
            background: #fde8e8; color: #d33; border: none; border-radius: 8px;
            padding: 8px 12px; cursor: pointer; height: fit-content;
        }
        .btn-xoa-tn:hover { background: #d33; color: #fff; }
        .btn-them-tn { margin-top: 10px; }
        @media (max-width: 900px) { .tinhnang-block { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

<?php include 'sidebar.php'; ?>

<main class="main-content">
    <div class="page-header">
        <h1>Quản lý <span>sản phẩm</span></h1>
    </div>

    <?php if ($thong_bao): ?>
        <div class="alert alert-<?php echo $loai_thong_bao; ?>"><?php echo htmlspecialchars($thong_bao); ?></div>
    <?php endif; ?>

    <!-- ===== FORM THÊM / SỬA SẢN PHẨM ===== -->
    <div class="form-card">
        <h3><?php echo $san_pham_sua ? 'Sửa sản phẩm #' . $san_pham_sua['id'] : 'Thêm sản phẩm mới'; ?></h3>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $san_pham_sua ? $san_pham_sua['id'] : ''; ?>">
            <input type="hidden" name="anh_hien_tai" value="<?php echo $san_pham_sua ? v($san_pham_sua, 'hinh_anh') : ''; ?>">
            <input type="hidden" name="nen_banner_hien_tai" value="<?php echo $san_pham_sua ? v($san_pham_sua, 'nen_banner') : ''; ?>">

            <div class="form-grid">
                <div class="form-group">
                    <label>Tên sản phẩm *</label>
                    <input type="text" id="ten_san_pham" name="ten_san_pham" required
                           value="<?php echo $san_pham_sua ? v($san_pham_sua, 'ten_san_pham') : ''; ?>">
                </div>
                <div class="form-group">
                    <label>Đường dẫn URL (slug)</label>
                    <input type="text" id="slug" name="slug" placeholder="Để trống sẽ tự sinh từ tên sản phẩm"
                           value="<?php echo $san_pham_sua ? v($san_pham_sua, 'slug') : ''; ?>">
                    <div class="slug-preview">URL: /thongtinsanpham/<span id="slug_preview"><?php echo $san_pham_sua ? v($san_pham_sua, 'slug') : '...'; ?></span></div>
                </div>
                <div class="form-group">
                    <label>Giá</label>
                    <input type="text" name="gia" placeholder="VD: 25.990.000 VND" value="<?php echo $san_pham_sua ? v($san_pham_sua, 'gia') : ''; ?>">
                </div>
                <div class="form-group">
                    <label>Loại xe *</label>
                    <select name="loai_xe" required>
                        <option value="">-- Chọn loại xe --</option>
                        <option value="Xe gắn máy" <?php echo ($san_pham_sua && $san_pham_sua['loai_xe'] === 'Xe gắn máy') ? 'selected' : ''; ?>>Xe gắn máy</option>
                        <option value="Xe máy điện" <?php echo ($san_pham_sua && $san_pham_sua['loai_xe'] === 'Xe máy điện') ? 'selected' : ''; ?>>Xe máy điện</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Màu chủ đạo trang chi tiết</label>
                    <div class="color-row">
                        <input type="color" name="mau_chu_dao" value="<?php echo $san_pham_sua ? v($san_pham_sua, 'mau_chu_dao') : '#FF5F00'; ?>">
                        <span style="font-size:13px;color:#888;">Dùng cho giá, nút mua, tiêu đề thông số</span>
                    </div>
                </div>

                <?php foreach ($cac_truong_chi_tiet as $key => $label): ?>
                <div class="form-group">
                    <label><?php echo $label; ?></label>
                    <input type="text" name="<?php echo $key; ?>" value="<?php echo $san_pham_sua ? v($san_pham_sua, $key) : ''; ?>">
                </div>
                <?php endforeach; ?>

                <div class="form-group full">
                    <label>Mô tả</label>
                    <textarea name="mo_ta"><?php echo $san_pham_sua ? htmlspecialchars($san_pham_sua['mo_ta']) : ''; ?></textarea>
                </div>

                <div class="form-group">
                    <label>Ảnh đại diện <?php echo $san_pham_sua ? '(để trống nếu giữ ảnh cũ)' : ''; ?></label>
                    <input type="file" name="hinh_anh" accept="image/*">
                    <?php if ($san_pham_sua && !empty($san_pham_sua['hinh_anh'])): ?>
                        <img src="../<?php echo v($san_pham_sua, 'hinh_anh'); ?>" class="product-img" style="margin-top:10px;">
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Ảnh nền banner đầu trang <?php echo $san_pham_sua ? '(để trống nếu giữ ảnh cũ)' : '(không chọn sẽ dùng nền tối mặc định)'; ?></label>
                    <input type="file" name="nen_banner" accept="image/*">
                    <?php if ($san_pham_sua && !empty($san_pham_sua['nen_banner'])): ?>
                        <img src="../<?php echo v($san_pham_sua, 'nen_banner'); ?>" class="nen-preview">
                    <?php endif; ?>
                </div>

                <div class="form-group full">
                    <label>Thêm ảnh phụ (album, chọn được nhiều ảnh cùng lúc)</label>
                    <input type="file" name="anh_phu[]" accept="image/*" multiple>

                    <?php if (!empty($album_anh)): ?>
                    <div class="album-grid">
                        <?php foreach ($album_anh as $anh): ?>
                        <div class="album-item">
                            <img src="../<?php echo htmlspecialchars($anh['duong_dan']); ?>">
                            <a href="index.php?xoa_anh=<?php echo $anh['id']; ?>&ve_sanpham=<?php echo $san_pham_sua['id']; ?>"
                               class="xoa-anh" onclick="return confirm('Xoá ảnh này?');">✕</a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="form-group full">
                    <label>Các màu của xe</label>
                    <input type="file" name="mau_xe[]" accept="image/*" multiple>

                    <?php if (!empty($danh_sach_mauxe)): ?>
                    <div class="album-grid">
                        <?php foreach ($danh_sach_mauxe as $mau): ?>
                        <div class="album-item">
                            <img src="../<?php echo htmlspecialchars($mau['hinh_anh']); ?>">
                            <a href="index.php?xoa_mau=<?php echo $mau['id']; ?>&ve_sanpham=<?php echo $san_pham_sua['id']; ?>"
                               class="xoa-anh" onclick="return confirm('Xoá màu này?');">✕</a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="form-group full">
                    <label>Tính năng nổi bật (mỗi khối = 1 tiêu đề + mô tả + 1 ảnh, hiển thị xen kẽ trái/phải ở trang chi tiết)</label>
                    <div id="tinhnang-list" class="tinhnang-list">
                        <?php
                        $so_khoi = max(count($danh_sach_tinhnang), 0);
                        for ($i = 0; $i < $so_khoi; $i++):
                            $tn = $danh_sach_tinhnang[$i];
                        ?>
                        <div class="tinhnang-block">
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input type="text" name="tn_tieude[]" value="<?php echo htmlspecialchars($tn['tieu_de']); ?>" placeholder="VD: HỆ THỐNG ĐÈN FULL LED">
                                <label style="margin-top:10px;">Mô tả (mỗi dòng = 1 gạch đầu dòng)</label>
                                <textarea name="tn_mota[]" placeholder="Mỗi dòng 1 ý, tự động thêm dấu ⚡️"><?php echo htmlspecialchars($tn['mo_ta']); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Ảnh minh hoạ <?php echo !empty($tn['hinh_anh']) ? '(để trống nếu giữ ảnh cũ)' : ''; ?></label>
                                <input type="file" name="tn_anh[]" accept="image/*">
                                <input type="hidden" name="tn_anh_cu[]" value="<?php echo htmlspecialchars($tn['hinh_anh']); ?>">
                                <?php if (!empty($tn['hinh_anh'])): ?>
                                    <img src="../<?php echo htmlspecialchars($tn['hinh_anh']); ?>" class="tn-preview">
                                <?php endif; ?>
                            </div>
                            <button type="button" class="btn-xoa-tn" onclick="this.closest('.tinhnang-block').remove()"><i class="fas fa-trash"></i></button>
                        </div>
                        <?php endfor; ?>
                    </div>
                    <button type="button" class="btn btn-secondary btn-them-tn" onclick="themKhoiTinhNang()">
                        <i class="fas fa-plus"></i> Thêm tính năng
                    </button>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" name="luu_san_pham" class="btn btn-primary">
                    <i class="fas fa-save"></i> <?php echo $san_pham_sua ? 'Cập nhật' : 'Lưu sản phẩm'; ?>
                </button>
                <?php if ($san_pham_sua): ?>
                    <a href="index.php" class="btn btn-secondary"><i class="fas fa-times"></i> Huỷ</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <div class="tabs">
        <a href="index.php?loai=tatca" class="<?php echo $loai_loc === 'tatca' ? 'active' : ''; ?>">Tất cả</a>
        <a href="index.php?loai=xeganmay" class="<?php echo $loai_loc === 'xeganmay' ? 'active' : ''; ?>">Xe gắn máy</a>
        <a href="index.php?loai=xemaydien" class="<?php echo $loai_loc === 'xemaydien' ? 'active' : ''; ?>">Xe máy điện</a>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>URL</th>
                    <th>Giá</th>
                    <th>Loại xe</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($ds_san_pham && $ds_san_pham->num_rows > 0): ?>
                    <?php while ($sp2 = $ds_san_pham->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php if (!empty($sp2['hinh_anh'])): ?>
                                <img src="../<?php echo htmlspecialchars($sp2['hinh_anh']); ?>" class="product-img">
                            <?php else: ?>
                                <div class="product-img"></div>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($sp2['ten_san_pham']); ?></td>
                        <td><code>/<?php echo htmlspecialchars($sp2['slug'] ?? ''); ?></code></td>
                        <td><?php echo htmlspecialchars($sp2['gia']); ?></td>
                        <td>
                            <span class="badge <?php echo $sp2['loai_xe'] === 'Xe máy điện' ? 'badge-xemaydien' : 'badge-xangaymay'; ?>">
                                <?php echo htmlspecialchars($sp2['loai_xe']); ?>
                            </span>
                        </td>
                        <td class="actions-cell">
                            <?php if (!empty($sp2['slug'])): ?>
                                <a href="../thongtinsanpham/<?php echo htmlspecialchars($sp2['slug']); ?>" target="_blank" class="btn btn-secondary"><i class="fas fa-eye"></i></a>
                            <?php endif; ?>
                            <a href="index.php?edit=<?php echo $sp2['id']; ?>" class="btn btn-edit"><i class="fas fa-edit"></i></a>
                            <a href="index.php?delete=<?php echo $sp2['id']; ?>" class="btn btn-danger" onclick="return confirm('Xoá sản phẩm này?');"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="empty-state">Chưa có sản phẩm nào.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<!-- Mẫu (template) 1 khối tính năng, dùng để nhân bản bằng JS -->
<template id="mau-tinhnang">
    <div class="tinhnang-block">
        <div class="form-group">
            <label>Tiêu đề</label>
            <input type="text" name="tn_tieude[]" placeholder="VD: HỆ THỐNG ĐÈN FULL LED">
            <label style="margin-top:10px;">Mô tả (mỗi dòng = 1 gạch đầu dòng)</label>
            <textarea name="tn_mota[]" placeholder="Mỗi dòng 1 ý, tự động thêm dấu ⚡️"></textarea>
        </div>
        <div class="form-group">
            <label>Ảnh minh hoạ</label>
            <input type="file" name="tn_anh[]" accept="image/*">
            <input type="hidden" name="tn_anh_cu[]" value="">
        </div>
        <button type="button" class="btn-xoa-tn" onclick="this.closest('.tinhnang-block').remove()"><i class="fas fa-trash"></i></button>
    </div>
</template>

<script>
    function themKhoiTinhNang() {
        const mau = document.getElementById('mau-tinhnang').content.cloneNode(true);
        document.getElementById('tinhnang-list').appendChild(mau);
    }

    function slugify(str) {
        str = str.toLowerCase();
        str = str.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
        str = str.replace(/đ/g, 'd').replace(/Đ/g, 'D');
        str = str.replace(/[^a-z0-9\s-]/g, '');
        str = str.trim().replace(/[\s-]+/g, '-');
        return str;
    }
    const oTen = document.getElementById('ten_san_pham');
    const oSlug = document.getElementById('slug');
    const oPreview = document.getElementById('slug_preview');
    oTen.addEventListener('input', () => {
        if (oSlug.value.trim() === '' || oSlug.dataset.tudong === '1') {
            oSlug.dataset.tudong = '1';
            const s = slugify(oTen.value);
            oSlug.value = s;
            oPreview.textContent = s || '...';
        }
    });
    oSlug.addEventListener('input', () => {
        oSlug.dataset.tudong = '0';
        oPreview.textContent = oSlug.value || '...';
    });
</script>
</body>
</html>