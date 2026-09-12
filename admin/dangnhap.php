<?php
session_start();

// Xử lý đăng xuất
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: dangnhap.php');
    exit();
}

if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' && $password === '12301230') {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit();
    } else {
        $error_message = "Tên đăng nhập hoặc mật khẩu không đúng.";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - Yadea</title>
    <link rel="icon" href="image/logo-yadea.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -100px;
            right: -100px;
            animation: float 6s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            bottom: -80px;
            left: -80px;
            animation: float 8s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, -30px) scale(1.1); }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 50px 40px;
            width: 420px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .logo { text-align: center; margin-bottom: 30px; }
        .logo h2 { color: #333; font-size: 24px; font-weight: 700; }
        .logo span { color: #FE6E16; }
        .logo p { color: #888; font-size: 14px; margin-top: 5px; }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #666;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 20px;
            transition: all 0.3s;
            padding: 8px 15px;
            border-radius: 8px;
            background: #f5f5f5;
        }

        .back-btn:hover {
            background: #FE6E16;
            color: white;
            transform: translateX(-5px);
        }

        .form-group { margin-bottom: 20px; position: relative; }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
        }
        .form-group label i { margin-right: 8px; color: #FE6E16; }

        .input-wrapper { position: relative; }
        .input-wrapper i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            transition: color 0.3s;
        }

        .input-wrapper input {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 2px solid #e8e8e8;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s;
            background: #fafafa;
            outline: none;
        }

        .input-wrapper input:focus {
            border-color: #FE6E16;
            background: white;
            box-shadow: 0 0 0 4px rgba(254, 110, 22, 0.1);
        }

        .input-wrapper input:focus + i { color: #FE6E16; }
        .input-wrapper input::placeholder { color: #bbb; }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #aaa;
            transition: color 0.3s;
            background: none;
            border: none;
            font-size: 16px;
        }
        .toggle-password:hover { color: #FE6E16; }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0 25px;
            font-size: 14px;
        }
        .options label { display: flex; align-items: center; gap: 8px; color: #666; cursor: pointer; }
        .options label input[type="checkbox"] { accent-color: #FE6E16; width: 16px; height: 16px; cursor: pointer; }
        .options a { color: #FE6E16; text-decoration: none; font-weight: 500; transition: color 0.3s; }
        .options a:hover { color: #d55a0e; text-decoration: underline; }

        .btn-submit {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #FE6E16, #f5570e);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(254, 110, 22, 0.4); }
        .btn-submit:active { transform: translateY(0); }
        .btn-submit i { font-size: 18px; }

        .register-link { text-align: center; margin-top: 25px; color: #888; font-size: 14px; }
        .register-link a { color: #FE6E16; text-decoration: none; font-weight: 600; transition: color 0.3s; }
        .register-link a:hover { color: #d55a0e; text-decoration: underline; }

        .error-message {
            background: #fde8e8;
            color: #d33;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }

        @media (max-width: 480px) {
            .login-container { padding: 30px 25px; width: 95%; margin: 20px; }
            .options { flex-direction: column; gap: 10px; align-items: flex-start; }
            .logo img { width: 60px; height: 60px; }
            .logo h2 { font-size: 20px; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <a href="../index.html" class="back-btn">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>

        <div class="logo">
            <h2>Yadea<span>.</span></h2>
            <p>Đăng nhập để trải nghiệm</p>
        </div>

        <?php if ($error_message): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <form action="dangnhap.php" method="post">
            <div class="form-group">
                <label for="username"><i class="fas fa-user"></i> Tên đăng nhập</label>
                <div class="input-wrapper">
                    <i class="fas fa-user"></i>
                    <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Mật khẩu</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
                    <button type="button" class="toggle-password" onclick="togglePassword()">
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <div class="options">
                <label><input type="checkbox" name="remember"> Ghi nhớ đăng nhập</label>
                <a href="#">Quên mật khẩu?</a>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-sign-in-alt"></i> Đăng Nhập
            </button>
        </form>

        <div class="register-link">
            Chưa có tài khoản? <a href="register.html">Đăng ký ngay</a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                eyeIcon.className = 'fas fa-eye';
            }
        }
    </script>
</body>
</html>