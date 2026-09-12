<?php
require_once 'auth.php';
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['thu_tu_moi'])) {
    $ds = json_decode($_POST['thu_tu_moi'], true);
    foreach ($ds as $i => $id) {
        $id = intval($id);
        $conn->query("UPDATE trangchu_khoi SET thu_tu = " . ($i + 1) . " WHERE id = $id");
    }
    echo json_encode(['ok' => true]);
    exit();
}

if (isset($_GET['toggle'])) {
    $id = intval($_GET['toggle']);
    $conn->query("UPDATE trangchu_khoi SET hien_thi = 1 - hien_thi WHERE id = $id");
    header('Location: giaodien.php');
    exit();
}

$ds_khoi = $conn->query("SELECT * FROM trangchu_khoi ORDER BY thu_tu ASC");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Sắp xếp giao diện trang chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="admin.css">
<style>
.khoi-list { max-width: 500px; }
.khoi-item {
  display: flex; align-items: center; justify-content: space-between;
  background: #fff; border: 1px solid #eee; border-radius: 8px;
  padding: 14px 16px; margin-bottom: 10px; cursor: grab;
}
.khoi-item.dragging { opacity: 0.4; }
.khoi-item .handle { margin-right: 10px; color: #999; }
.toggle-switch { position: relative; width: 44px; height: 24px; }
.toggle-switch input { display:none; }
.toggle-switch .slider {
  position: absolute; inset: 0; background: #ccc; border-radius: 24px; transition: .3s; cursor: pointer;
}
.toggle-switch .slider::before {
  content: ''; position: absolute; width: 18px; height: 18px; left: 3px; top: 3px;
  background: #fff; border-radius: 50%; transition: .3s;
}
.toggle-switch input:checked + .slider { background: #ff5f00; }
.toggle-switch input:checked + .slider::before { transform: translateX(20px); }
</style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="main-content">
    <div class="page-header"><h1>Sắp xếp <span>giao diện trang chủ</span></h1></div>
    <p style="color:#888;margin-bottom:15px;">Kéo để đổi thứ tự khối, bật/tắt để ẩn hiện.</p>

    <div class="khoi-list" id="khoi-list">
        <?php while ($k = $ds_khoi->fetch_assoc()): ?>
        <div class="khoi-item" draggable="true" data-id="<?php echo $k['id']; ?>">
            <div style="display:flex;align-items:center;">
                <span class="handle">☰</span>
                <span><?php echo htmlspecialchars($k['ten_hien_thi']); ?></span>
            </div>
            <label class="toggle-switch">
                <input type="checkbox" onchange="window.location='giaodien.php?toggle=<?php echo $k['id']; ?>'" <?php echo $k['hien_thi'] ? 'checked' : ''; ?>>
                <span class="slider"></span>
            </label>
        </div>
        <?php endwhile; ?>
    </div>
</main>

<script>
const list = document.getElementById('khoi-list');
let dragEl = null;

list.addEventListener('dragstart', e => {
    dragEl = e.target.closest('.khoi-item');
    dragEl.classList.add('dragging');
});
list.addEventListener('dragend', () => {
    dragEl.classList.remove('dragging');
    luuThuTu();
});
list.addEventListener('dragover', e => {
    e.preventDefault();
    const after = [...list.querySelectorAll('.khoi-item:not(.dragging)')].find(el => {
        const box = el.getBoundingClientRect();
        return e.clientY < box.top + box.height / 2;
    });
    if (after) list.insertBefore(dragEl, after);
    else list.appendChild(dragEl);
});

function luuThuTu() {
    const ids = [...list.querySelectorAll('.khoi-item')].map(el => el.dataset.id);
    fetch('giaodien.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'thu_tu_moi=' + encodeURIComponent(JSON.stringify(ids))
    });
}
</script>
</body>
</html>