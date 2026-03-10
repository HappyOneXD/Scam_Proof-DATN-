<?php
session_start();
require_once '../connect_db.php';     // you may not need this yet

$error = '';

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // admin only
    if ($email === 'admin' && $password === 'admin123') {
        $_SESSION['logged_in'] = true;
        $_SESSION['username']  = $email;
        header('Location: ../index.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
    <title>Login - Scam & Threat Detection Platform</title>
    <style>
        body {
            background-color: #000;
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .rotate-text {
            animation: spin 10s linear infinite;
            transform-origin: center;
        }

        @keyframes spin {
            100% {
                transform: rotate(-360deg);
            }
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #000;
            position: relative;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .logo-img {
            width: 120px;
            height: auto;
            margin-bottom: 20px;
            filter: drop-shadow(0 0 20px rgba(255, 255, 255, 0.3));
        }

        .login-card {
            background: rgba(20, 20, 20, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 40px;
            max-width: 400px;
            width: 100%;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
        }

        .login-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
            background: linear-gradient(45deg, #fff, #ccc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .login-subtitle {
            font-size: 14px;
            color: #aaa;
            text-align: center;
            margin-bottom: 30px;
            font-family: 'Courier New', monospace;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            color: white;
        }

        .form-label {
            font-size: 14px;
            margin-bottom: 8px;
            color: #ccc;
            font-weight: 500;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: linear-gradient(45deg, #ffffff, #e0e0e0);
            color: #000;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            margin-top: 20px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 255, 255, 0.3);
            background: linear-gradient(45deg, #fff, #f0f0f0);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            color: #666;
            font-size: 14px;
        }

        .divider::before,
        .divider::after {
            content: '';
            display: inline-block;
            width: 40%;
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
            vertical-align: middle;
            margin: 0 10px;
        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
            color: #aaa;
            font-size: 14px;
        }

        .signup-link a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .signup-link a:hover {
            color: #ccc;
            text-decoration: underline;
        }

        .back-link {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .back-link a {
            color: #aaa;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .back-link a:hover {
            color: #fff;
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 30px 20px;
            }

            .login-title {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="back-link">
            <a href="../index.php">
                <span>←</span> Back
            </a>
        </div>

        <div class="w-100 d-flex flex-column align-items-center">
            <div class="login-card">
                <h1 class="login-title">Welcome</h1>
                <p class="login-subtitle">Access your security dashboard</p>

                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="email" class="form-label">Username</label>
                        <input type="text" class="form-control" id="email" name="email" 
                               placeholder="Enter your username" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Enter your password" required>
                    </div>

                    <!-- <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div> -->

                    <button type="submit" class="btn-login">Sign In</button>
                </form>

                <div class="divider"></div>

                <!-- <div class="signup-link">
                    Don't have an account? <a href="#signup">Create one here</a>
                </div> -->

                <!-- <div style="text-align: center; margin-top: 20px;">
                    <a href="#forgot-password" style="color: #aaa; text-decoration: none; font-size: 12px;">
                        Forgot your password?
                    </a>
                </div> -->
            </div>
        </div>
    </div>
</body>
</html>
