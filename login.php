<?php
include 'config.php';

if(isset($_SESSION['login'])){
    header("Location: halaman.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Inventaris Sarpras MTsN 3 Banjarmasin</title>

    <!-- Bootstrap 5 CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="assets/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f4f9f4;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 900px;
            max-width: 95%;
            height: 500px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            display: flex;
        }

        /* SISI KIRI (Gambar/Hiasan) */
        .login-left {
            width: 50%;
            background: linear-gradient(135deg, #198754, #146c43);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            padding: 40px;
            text-align: center;
        }

        .login-left img {
            width: 120px;
            margin-bottom: 20px;
            background: white;
            border-radius: 50%;
            padding: 10px;
        }

        .login-left h2 {
            font-weight: 700;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .login-left p {
            font-size: 14px;
            opacity: 0.8;
        }

        /* SISI KANAN (Form) */
        .login-right {
            width: 50%;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-right h3 {
            font-weight: 700;
            color: #198754;
            margin-bottom: 10px;
            text-align: center;
        }

        .login-right .subtitle {
            font-size: 14px;
            color: #6c757d;
            text-align: center;
            margin-bottom: 30px;
        }

        /* CUSTOM INPUT GROUP */
        .custom-input-group {
            display: flex;
            align-items: center;
            border: 1px solid #ced4da;
            border-radius: 10px;
            background-color: #fff;
            margin-bottom: 20px;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .custom-input-group:focus-within {
            border-color: #198754;
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
        }

        .custom-input-group .icon-box {
            padding: 0 15px;
            color: #6c757d;
            display: flex;
            align-items: center;
            background: transparent;
        }

        .custom-input-group .form-control {
            border: none;
            box-shadow: none;
            padding: 12px 15px 12px 0;
            background: transparent;
            font-size: 15px;
        }

        /* BUTTON LOGIN */
        .btn-login {
            background: linear-gradient(135deg, #198754, #146c43);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            font-size: 16px;
            color: white;
            transition: 0.3s;
            width: 100%;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #146c43, #0f5132);
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                height: auto;
            }
            .login-left {
                width: 100%;
                padding: 30px;
            }
            .login-right {
                width: 100%;
                padding: 30px;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        
        <!-- KIRI -->
        <div class="login-left">
            <img src="assets/logokemenagnew.png" alt="Logo Kemenag">
            <h2>SIM Sarpras</h2>
            <p>Inventaris Sarana & Prasarana<br>MTsN 3 Kota Banjarmasin</p>
        </div>

        <!-- KANAN -->
        <div class="login-right">
            <h3>Selamat Datang</h3>
            <p class="subtitle">Silakan login menggunakan akun Anda.</p>

            <form method="POST" action="proses_login.php">
                
                <div class="custom-input-group">
                    <div class="icon-box"><i class="bi bi-person-fill"></i></div>
                    <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
                </div>

                <div class="custom-input-group">
                    <div class="icon-box"><i class="bi bi-lock-fill"></i></div>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </button>

            </form>
        </div>

    </div>

</body>
</html>