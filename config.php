<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "yadea"; 

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Kết nối database thất bại: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");


function tao_slug($chuoi)
{
    $chuoi = mb_strtolower(trim($chuoi), 'UTF-8');

    $ban_khong_dau = [
        'à','á','ạ','ả','ã','â','ầ','ấ','ậ','ẩ','ẫ','ă','ằ','ắ','ặ','ẳ','ẵ',
        'è','é','ẹ','ẻ','ẽ','ê','ề','ế','ệ','ể','ễ',
        'ì','í','ị','ỉ','ĩ',
        'ò','ó','ọ','ỏ','õ','ô','ồ','ố','ộ','ổ','ỗ','ơ','ờ','ớ','ợ','ở','ỡ',
        'ù','ú','ụ','ủ','ũ','ư','ừ','ứ','ự','ử','ữ',
        'ỳ','ý','ỵ','ỷ','ỹ','đ'
    ];
    $co_dau = [
        'a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a',
        'e','e','e','e','e','e','e','e','e','e','e',
        'i','i','i','i','i',
        'o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o',
        'u','u','u','u','u','u','u','u','u','u','u',
        'y','y','y','y','y','d'
    ];
    $chuoi = str_replace($ban_khong_dau, $co_dau, $chuoi);

    $chuoi = preg_replace('/[^a-z0-9\s-]/', '', $chuoi);
    $chuoi = preg_replace('/[\s-]+/', '-', $chuoi);
    return trim($chuoi, '-');
}


function tao_slug_duy_nhat($conn, $ten, $id_bo_qua = 0)
{
    $slug_goc = tao_slug($ten);
    $slug = $slug_goc;
    $dem = 1;
    while (true) {
        $stmt = $conn->prepare("SELECT id FROM sanpham WHERE slug = ? AND id != ?");
        $stmt->bind_param("si", $slug, $id_bo_qua);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows === 0) {
            return $slug;
        }
        $dem++;
        $slug = $slug_goc . '-' . $dem;
    }
}
?>