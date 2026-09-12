<?php
require_once 'auth.php';
require_once '../config.php';

$thong_bao = "";
$loai_thong_bao = "";

function tao_ma_don_hang($conn) {
    $prefix = "YAD";
    $year = date('Y');
    $month = date('m');
    $day = date('d');
    
    $sql = "SELECT COUNT(*) as count FROM don_hang WHERE DATE(ngay_dat) = CURDATE()";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $count = $row['count'] + 1;
    
    return $prefix . $year . $month . $day . str_pad($count, 4, '0', STR_PAD_LEFT);
}

// ===== CẬP NHẬT TRẠNG THÁI ĐƠN HÀNG =====
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $id = intval($_POST['id']);
    $trang_thai = $_POST['trang_thai'];
    $ghi_chu = trim($_POST['ghi_chu'] ?? '');
    
    $stmt = $conn->prepare("UPDATE don_hang SET trang_thai = ?, ghi_chu = ? WHERE id = ?");
    $stmt->bind_param("ssi", $trang_thai, $ghi_chu, $id);
    
    if ($stmt->execute()) {
        $thong_bao = "Cập nhật trạng thái đơn hàng thành công!";
        $loai_thong_bao = "success";
    } else {
        $thong_bao = "Cập nhật thất bại: " . $conn->error;
        $loai_thong_bao = "error";
    }
    $stmt->close();
}

// ===== XÓA ĐƠN HÀNG =====
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM don_hang WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $thong_bao = "Đã xóa đơn hàng!";
        $loai_thong_bao = "success";
    } else {
        $thong_bao = "Xóa thất bại: " . $conn->error;
        $loai_thong_bao = "error";
    }
    $stmt->close();
}

// ===== LẤY CHI TIẾT ĐƠN HÀNG ĐỂ XEM =====
$don_hang_chi_tiet = null;
if (isset($_GET['view'])) {
    $id = intval($_GET['view']);
    $stmt = $conn->prepare("SELECT * FROM don_hang WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $don_hang_chi_tiet = $result->fetch_assoc();
    }
    $stmt->close();
}

// ===== LỌC VÀ TÌM KIẾM =====
$trang_thai_loc = $_GET['trang_thai'] ?? 'all';
$search = $_GET['search'] ?? '';

$where_clauses = [];
if ($trang_thai_loc !== 'all') {
    $where_clauses[] = "trang_thai = '" . $conn->real_escape_string($trang_thai_loc) . "'";
}
if (!empty($search)) {
    $search = $conn->real_escape_string($search);
    $where_clauses[] = "(ma_don_hang LIKE '%$search%' OR ho_ten LIKE '%$search%' OR so_dien_thoai LIKE '%$search%' OR email LIKE '%$search%' OR ten_xe LIKE '%$search%')";
}

$where_sql = !empty($where_clauses) ? "WHERE " . implode(" AND ", $where_clauses) : "";
$sql = "SELECT * FROM don_hang $where_sql ORDER BY ngay_dat DESC";
$result = $conn->query($sql);

$count_pending = $conn->query("SELECT COUNT(*) as count FROM don_hang WHERE trang_thai = 'pending'")->fetch_assoc()['count'];
$count_processing = $conn->query("SELECT COUNT(*) as count FROM don_hang WHERE trang_thai = 'processing'")->fetch_assoc()['count'];
$count_completed = $conn->query("SELECT COUNT(*) as count FROM don_hang WHERE trang_thai = 'completed'")->fetch_assoc()['count'];
$count_cancelled = $conn->query("SELECT COUNT(*) as count FROM don_hang WHERE trang_thai = 'cancelled'")->fetch_assoc()['count'];
$total = $conn->query("SELECT COUNT(*) as count FROM don_hang")->fetch_assoc()['count'];

function trang_thai_badge($status) {
    $map = [
        'pending' => ['label' => ' Chờ xử lý', 'class' => 'badge-warning'],
        'processing' => ['label' => ' Đang xử lý', 'class' => 'badge-info'],
        'completed' => ['label' => ' Hoàn thành', 'class' => 'badge-success'],
        'cancelled' => ['label' => ' Đã hủy', 'class' => 'badge-danger'],
    ];
    return $map[$status] ?? ['label' => $status, 'class' => 'badge-secondary'];
}

// ===== HÀM HIỂN THỊ PHƯƠNG THỨC THANH TOÁN =====
function thanh_toan_label($method) {
    $map = [
        'Thanh toán trực tiếp tại showroom' => ['label' => ' Trực tiếp', 'class' => 'badge-primary'],
        'Thanh toán qua ví điện tử' => ['label' => '📱 Ví điện tử', 'class' => 'badge-info'],
    ];
    return $map[$method] ?? ['label' => $method, 'class' => 'badge-secondary'];
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duyệt Đơn Hàng - YADEA Admin</title>
    <link rel="icon" href="../image/logo-yadea.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
    <style>
        /* ===== THỐNG KÊ ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            text-align: center;
            transition: all 0.3s ease;
            border-top: 4px solid #e0e0e0;
            text-decoration: none;
            color: inherit;
            display: block;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.10);
        }
        .stat-card .number {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 4px;
        }
        .stat-card .label {
            font-size: 13px;
            color: #888;
        }
        .stat-card.pending { border-top-color: #f59e0b; }
        .stat-card.processing { border-top-color: #3b82f6; }
        .stat-card.completed { border-top-color: #22c55e; }
        .stat-card.cancelled { border-top-color: #ef4444; }
        .stat-card.all { border-top-color: #8b5cf6; }

        /* ===== FILTER ===== */
        .filter-bar {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            flex-wrap: wrap;
            align-items: center;
            background: #fff;
            padding: 16px 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        .filter-bar input,
        .filter-bar select {
            padding: 10px 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s;
            background: #f8f9fa;
            font-family: inherit;
        }
        .filter-bar input:focus,
        .filter-bar select:focus {
            border-color: #FF5F00;
            background: #fff;
        }
        .filter-bar input {
            flex: 1;
            min-width: 200px;
        }
        .filter-bar .btn {
            padding: 10px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            font-family: inherit;
        }
        .filter-bar .btn-primary {
            background: #FF5F00;
            color: #fff;
        }
        .filter-bar .btn-primary:hover {
            background: #e05500;
            transform: translateY(-2px);
        }
        .filter-bar .btn-secondary {
            background: #e5e7eb;
            color: #374151;
        }
        .filter-bar .btn-secondary:hover {
            background: #d1d5db;
        }

        /* ===== BADGE ===== */
        .badge-status {
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-info { background: #dbeafe; color: #1e40af; }
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-danger { background: #fecaca; color: #991b1b; }
        .badge-secondary { background: #e5e7eb; color: #374151; }
        .badge-primary { background: #dbeafe; color: #1e40af; }

        /* ===== TABLE ===== */
        .table-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            overflow: hidden;
        }
        .table-responsive {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        thead {
            background: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
        }
        th {
            padding: 14px 16px;
            text-align: left;
            font-weight: 600;
            color: #495057;
            white-space: nowrap;
        }
        td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f3f5;
            vertical-align: middle;
        }
        tr:hover {
            background: #f8f9fa;
        }

        .ma-don-hang {
            font-weight: 600;
            color: #1a1a2e;
            font-size: 13px;
        }
        .thong-tin-khach {
            font-size: 13px;
            line-height: 1.5;
        }
        .thong-tin-khach strong {
            display: block;
            color: #1a1a2e;
        }
        .thong-tin-khach small {
            color: #6c757d;
        }

        .actions-cell {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-family: inherit;
        }
        .btn-edit { background: #dbeafe; color: #1e40af; }
        .btn-edit:hover { background: #bfdbfe; }
        .btn-success { background: #d1fae5; color: #065f46; }
        .btn-success:hover { background: #a7f3d0; }
        .btn-danger { background: #fecaca; color: #991b1b; }
        .btn-danger:hover { background: #fca5a5; }
        .btn-view { background: #e5e7eb; color: #374151; }
        .btn-view:hover { background: #d1d5db; }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #888;
        }
        .empty-state i {
            font-size: 48px;
            color: #ddd;
            margin-bottom: 16px;
            display: block;
        }

        /* ===== MODAL ===== */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .modal-overlay.active { display: flex; }
        .modal {
            background: #fff;
            border-radius: 16px;
            padding: 30px;
            max-width: 600px;
            width: 95%;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideIn 0.3s ease;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f3f5;
        }
        .modal-header h3 {
            font-size: 20px;
            margin: 0;
        }
        .modal-close {
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: #888;
            line-height: 1;
        }
        .modal-close:hover { color: #333; }

        .modal .form-group {
            margin-bottom: 16px;
        }
        .modal .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            font-size: 14px;
        }
        .modal .form-group select,
        .modal .form-group textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            outline: none;
        }
        .modal .form-group select:focus,
        .modal .form-group textarea:focus {
            border-color: #FF5F00;
        }
        .modal .form-group textarea {
            min-height: 80px;
            resize: vertical;
        }
        .modal .form-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #f1f3f5;
        }
        .modal .form-actions button {
            padding: 10px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
        }
        .modal .form-actions .btn-primary {
            background: #FF5F00;
            color: #fff;
        }
        .modal .form-actions .btn-primary:hover {
            background: #e05500;
        }
        .modal .form-actions .btn-secondary {
            background: #e5e7eb;
            color: #374151;
        }
        .modal .form-actions .btn-secondary:hover {
            background: #d1d5db;
        }

        /* ===== CHI TIẾT ĐƠN HÀNG ===== */
        .detail-row {
            display: flex;
            padding: 8px 0;
            border-bottom: 1px solid #f1f3f5;
        }
        .detail-label {
            font-weight: 600;
            width: 140px;
            flex-shrink: 0;
            color: #495057;
        }
        .detail-value {
            flex: 1;a
            color: #1a1a2e;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .filter-bar {
                flex-direction: column;
            }
            .filter-bar input {
                min-width: 100%;
            }
            .detail-label {
                width: 100px;
            }
        }
        @media (max-width: 576px) {
            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
</head>
<body>

<?php include 'sidebar.php'; ?>

<main class="main-content">
    <div class="page-header">
        <h1>Duyệt <span>Đơn Hàng</span></h1>
        <span style="font-size:14px;color:#888;">Tổng: <strong><?php echo $total; ?></strong> đơn</span>
    </div>

    <?php if ($thong_bao): ?>
        <div class="alert alert-<?php echo $loai_thong_bao; ?>">
            <?php echo htmlspecialchars($thong_bao); ?>
        </div>
    <?php endif; ?>

    <!-- ===== THỐNG KÊ ===== -->
    <div class="stats-grid">
        <a href="duyetdonhang.php?trang_thai=all" class="stat-card all">
            <div class="number"><?php echo $total; ?></div>
            <div class="label"> Tất cả</div>
        </a>
        <a href="duyetdonhang.php?trang_thai=pending" class="stat-card pending">
            <div class="number"><?php echo $count_pending; ?></div>
            <div class="label"> Chờ xử lý</div>
        </a>
        <a href="duyetdonhang.php?trang_thai=processing" class="stat-card processing">
            <div class="number"><?php echo $count_processing; ?></div>
            <div class="label"> Đang xử lý</div>
        </a>
        <a href="duyetdonhang.php?trang_thai=completed" class="stat-card completed">
            <div class="number"><?php echo $count_completed; ?></div>
            <div class="label"> Hoàn thành</div>
        </a>
        <a href="duyetdonhang.php?trang_thai=cancelled" class="stat-card cancelled">
            <div class="number"><?php echo $count_cancelled; ?></div>
            <div class="label"> Đã hủy</div>
        </a>
    </div>

    <!-- ===== FILTER ===== -->
    <div class="filter-bar">
        <form method="GET" style="display:flex;gap:12px;flex-wrap:wrap;width:100%;align-items:center;">
            <input type="text" name="search" placeholder="🔍 Tìm kiếm mã đơn, tên, SĐT, email, sản phẩm..." 
                   value="<?php echo htmlspecialchars($search); ?>">
            <select name="trang_thai">
                <option value="all" <?php echo $trang_thai_loc === 'all' ? 'selected' : ''; ?>>Tất cả trạng thái</option>
                <option value="pending" <?php echo $trang_thai_loc === 'pending' ? 'selected' : ''; ?>>Chờ xử lý</option>
                <option value="processing" <?php echo $trang_thai_loc === 'processing' ? 'selected' : ''; ?>>Đang xử lý</option>
                <option value="completed" <?php echo $trang_thai_loc === 'completed' ? 'selected' : ''; ?>>Hoàn thành</option>
                <option value="cancelled" <?php echo $trang_thai_loc === 'cancelled' ? 'selected' : ''; ?>>Đã hủy</option>
            </select>
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Lọc</button>
            <a href="duyetdonhang.php" class="btn btn-secondary"><i class="fas fa-times"></i> Đặt lại</a>
        </form>
    </div>

    <!-- ===== TABLE ===== -->
    <div class="table-card">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Mã ĐH</th>
                        <th>Khách hàng</th>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Thanh toán</th>
                        <th>Trạng thái</th>
                        <th>Ngày đặt</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): 
                            $badge = trang_thai_badge($row['trang_thai']);
                            $tt = thanh_toan_label($row['hinh_thuc_thanh_toan']);
                        ?>
                        <tr>
                            <td>
                                <span class="ma-don-hang">#<?php echo htmlspecialchars($row['ma_don_hang']); ?></span>
                            </td>
                            <td>
                                <div class="thong-tin-khach">
                                    <strong><?php echo htmlspecialchars($row['ho_ten']); ?></strong>
                                    <small><?php echo htmlspecialchars($row['so_dien_thoai']); ?></small>
                                    <small style="display:block;"><?php echo htmlspecialchars($row['email']); ?></small>
                                </div>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($row['ten_xe']); ?>
                                <?php if (!empty($row['mau_xe'])): ?>
                                    <br><small style="color:#888;">Màu: <?php echo htmlspecialchars($row['mau_xe']); ?></small>
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($row['gia_xe']); ?></td>
                            <td>
                                <span class="badge-status <?php echo $tt['class']; ?>">
                                    <?php echo $tt['label']; ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge-status <?php echo $badge['class']; ?>">
                                    <?php echo $badge['label']; ?>
                                </span>
                            </td>
                            <td style="font-size:13px;white-space:nowrap;">
                                <?php echo date('d/m/Y H:i', strtotime($row['ngay_dat'])); ?>
                            </td>
                            <td class="actions-cell">
                                <a href="duyetdonhang.php?view=<?php echo $row['id']; ?>" 
                                   class="btn btn-view" 
                                   onclick="event.preventDefault(); openViewModal(<?php echo $row['id']; ?>)">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button class="btn btn-edit" onclick="openUpdateModal(<?php echo $row['id']; ?>, '<?php echo $row['trang_thai']; ?>', '<?php echo addslashes($row['ghi_chu'] ?? ''); ?>')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="duyetdonhang.php?delete=<?php echo $row['id']; ?>" 
                                   class="btn btn-danger" 
                                   onclick="return confirm('Xác nhận xóa đơn hàng #<?php echo $row['ma_don_hang']; ?>?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <i class="fas fa-shopping-cart"></i>
                                    Không có đơn hàng nào.
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- ===== MODAL CẬP NHẬT TRẠNG THÁI ===== -->
<div class="modal-overlay" id="updateModal">
    <div class="modal">
        <div class="modal-header">
            <h3><i class="fas fa-edit"></i> Cập nhật trạng thái</h3>
            <button class="modal-close" onclick="closeModal('updateModal')">&times;</button>
        </div>
        <form method="POST" action="duyetdonhang.php">
            <input type="hidden" name="id" id="update_id">
            <div class="form-group">
                <label>Trạng thái</label>
                <select name="trang_thai" id="update_trang_thai">
                    <option value="pending"> Chờ xử lý</option>
                    <option value="processing"> Đang xử lý</option>
                    <option value="completed"> Hoàn thành</option>
                    <option value="cancelled"> Đã hủy</option>
                </select>
            </div>
            <div class="form-group">
                <label>Ghi chú</label>
                <textarea name="ghi_chu" id="update_ghi_chu" placeholder="Nhập ghi chú cho đơn hàng..."></textarea>
            </div>
            <div class="form-actions">
                <button type="button" class="btn-secondary" onclick="closeModal('updateModal')">Hủy</button>
                <button type="submit" name="update_status" class="btn-primary">Cập nhật</button>
            </div>
        </form>
    </div>
</div>

<!-- ===== MODAL XEM CHI TIẾT ===== -->
<div class="modal-overlay" id="viewModal">
    <div class="modal" style="max-width: 700px;">
        <div class="modal-header">
            <h3><i class="fas fa-file-invoice"></i> Chi tiết đơn hàng</h3>
            <button class="modal-close" onclick="closeModal('viewModal')">&times;</button>
        </div>
        <div id="viewContent">
            <div style="text-align:center;padding:30px;">
                <i class="fas fa-spinner fa-spin" style="font-size:32px;color:#FF5F00;"></i>
                <p style="margin-top:10px;color:#888;">Đang tải...</p>
            </div>
        </div>
    </div>
</div>

<script>
// ===== ĐÓNG MODAL =====
function closeModal(id) {
    document.getElementById(id).classList.remove('active');
}

// ===== MỞ MODAL CẬP NHẬT =====
function openUpdateModal(id, trang_thai, ghi_chu) {
    document.getElementById('update_id').value = id;
    document.getElementById('update_trang_thai').value = trang_thai;
    document.getElementById('update_ghi_chu').value = ghi_chu || '';
    document.getElementById('updateModal').classList.add('active');
}

// ===== MỞ MODAL XEM CHI TIẾT =====
function openViewModal(id) {
    const modal = document.getElementById('viewModal');
    const content = document.getElementById('viewContent');
    
    // Hiển thị loading
    content.innerHTML = `
        <div style="text-align:center;padding:30px;">
            <i class="fas fa-spinner fa-spin" style="font-size:32px;color:#FF5F00;"></i>
            <p style="margin-top:10px;color:#888;">Đang tải...</p>
        </div>
    `;
    modal.classList.add('active');
    
    // Gọi AJAX lấy chi tiết
    fetch('duyetdonhang_ajax.php?view=' + id)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                content.innerHTML = data.html;
            } else {
                content.innerHTML = `
                    <div style="text-align:center;padding:30px;color:#991b1b;">
                        <i class="fas fa-exclamation-circle" style="font-size:32px;"></i>
                        <p>${data.message || 'Không thể tải chi tiết đơn hàng'}</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            content.innerHTML = `
                <div style="text-align:center;padding:30px;color:#991b1b;">
                    <i class="fas fa-exclamation-circle" style="font-size:32px;"></i>
                    <p>Lỗi kết nối, vui lòng thử lại</p>
                </div>
            `;
        });
}

// ===== ĐÓNG MODAL KHI CLICK BÊN NGOÀI =====
document.querySelectorAll('.modal-overlay').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.remove('active');
        }
    });
});

// ===== ĐÓNG MODAL BẰNG PHÍM ESC =====
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal-overlay.active').forEach(modal => {
            modal.classList.remove('active');
        });
    }
});
</script>

</body>
</html>