<?php
session_start();
require_once '../connect_db.php';

$error   = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $error = 'Username and password are required.';
    } else {
        // check if username already exists in `user` table
        $stmt = $connect->prepare('SELECT id FROM user WHERE username = ?');
        if ($stmt) {
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $error = 'Username is already taken. Please choose another one.';
            } else {
                // store password as PLAIN TEXT (matches current login logic)
                $insert = $connect->prepare('INSERT INTO user (username, password) VALUES (?, ?)');
                if ($insert) {
                    $insert->bind_param('ss', $username, $password);
                    if ($insert->execute()) {
                        $success = 'Account created successfully. You can now sign in.';
                    } else {
                        $error = 'Error creating account. Please try again.';
                    }
                    $insert->close();
                } else {
                    $error = 'Database error (insert).';
                }
            }
            $stmt->close();
        } else {
            $error = 'Database error (select).';
        }
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
    <title>Sign Up - Scam & Threat Detection Platform</title>
    <style>
        body {
            background-color: #000;
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .rotate-text { animation: spin 10s linear infinite; transform-origin: center; }
        @keyframes spin { 100% { transform: rotate(-360deg); } }

        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #000;
            position: relative;
        }
        .auth-card {
            background: rgba(20, 20, 20, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 40px;
            max-width: 400px;
            width: 100%;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
        }
        .auth-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
            background: linear-gradient(45deg, #fff, #ccc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .auth-subtitle {
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
        .form-control::placeholder { color: rgba(255, 255, 255, 0.5); }
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
        .btn-auth {
            width: 100%;
            padding: 12px;
            background: linear-gradient(45deg, #ffffff, #e0e0e0);
            color: #000;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            margin-top: 10px;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 255, 255, 0.3);
            background: linear-gradient(45deg, #fff, #f0f0f0);
        }
        .btn-auth:active { transform: translateY(0); }
        .switch-link {
            text-align: center;
            margin-top: 20px;
            color: #aaa;
            font-size: 14px;
        }
        .switch-link a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }
        .switch-link a:hover {
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
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .back-link a:hover { color: #fff; }

        @media (max-width: 576px) {
            .auth-card { padding: 30px 20px; }
            .auth-title { font-size: 24px; }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="back-link">
            <a href="../index.php">
                <span>←</span> Back
            </a>
        </div>

        <div class="w-100 d-flex flex-column align-items-center">
            <div class="auth-card">
                <h1 class="auth-title">Create Account</h1>
                <p class="auth-subtitle">Set up your username and password</p>

                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <?php if ($success): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text"
                               class="form-control"
                               id="username"
                               name="username"
                               placeholder="Choose a username"
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password"
                               class="form-control"
                               id="password"
                               name="password"
                               placeholder="Create a password"
                               required>
                    </div>

                    <button type="submit" class="btn-auth">Sign Up</button>
                </form>

                <div class="switch-link">
                    Already have an account? <a href="./login.php">Sign in</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>