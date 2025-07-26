<?php
session_start();


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";

    // Chống spam: Chỉ cho gửi mỗi 30 giây
    if (isset($_SESSION['last_sent']) && time() - $_SESSION['last_sent'] < 30) {
        echo 'Vui lòng chờ 30 giây trước khi gửi lại.';
        exit;
    }

    $_SESSION['last_sent'] = time();

    $ten = htmlspecialchars($_POST['name'] ?? '');
    $sdt = htmlspecialchars($_POST['phone'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $noidung = htmlspecialchars($_POST['noidung'] ?? '');
    // Gửi mail
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8'; // Đảm bảo hiển thị tiếng Việt

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'leducthanh261@gmail.com';
        $mail->Password = 'pykh abka pkza iqip';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('leducthanh261@gmail.com', 'Sender Name');
        $mail->addAddress('leducthanh261@gmail.com', 'Your Name');

        $mail->isHTML(true);
        $mail->Subject = 'Thông tin từ khách hàng';

        $mail->Body = '
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Thông tin tư vấn từ khách hàng</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.5; background: #f9f9f9; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); padding: 20px;">
        <h2 style="color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px;">Thông tin tư vấn từ khách hàng</h2>

        <p><strong style="color: #2980b9;">Tên khách hàng:</strong> ' . $ten . '</p>
        <p><strong style="color: #2980b9;">Số điện thoại:</strong> ' . $sdt . '</p>
        <p><strong style="color: #2980b9;">Email khách hàng:</strong> ' . $email . '</p>
        <p><strong style="color: #2980b9;">Nội Dung Khách Hàng Gửi Tới:</strong> ' . $noidung . '</p>

        <hr style="border: none; border-top: 1px solid #eee; margin: 20px 0;">
        <p style="font-size: 12px; color: #999; margin-top: 40px;">Email được gửi tự động từ hệ thống của bạn. Vui lòng không trả lời email này.</p>
    </div>
</body>
</html>';

        $mail->send();
        echo "<script>alert('Thông tin đã được gửi thành công!');</script>";
        header("location:/Yadea");
    } catch (Exception $e) {
        echo "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";
    }
} else {
    echo "Không có dữ liệu POST được gửi đến.";
}
?>