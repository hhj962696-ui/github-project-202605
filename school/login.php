<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員登入</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #c8e6c9;
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
            /*             display: flex;
            justify-content: center;
            align-items: center; */
            /* padding: 20px; */
        }

        /* 頂部導航欄 */
        .navbar {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            padding: 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            height: 70px;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }

        .nav-logo span {
            font-size: 28px;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
            list-style: none;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 15px;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: #ffc107;
        }

        .nav-buttons {
            display: flex;
            gap: 12px;
        }

        .btn-login,
        .btn-register {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-login {
            background-color: #ffc107;
            color: #2e7d32;
        }

        .btn-login:hover {
            background-color: #ffb300;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(255, 193, 7, 0.3);
        }

        .btn-register {
            background-color: #ff9800;
            color: white;
        }

        .btn-register:hover {
            background-color: #f57c00;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(255, 152, 0, 0.3);
        }

        .container {
            background-color: #f1f8f5;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            margin: 150px auto;
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h1 {
            color: #ff9800;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #ffc107;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #ff9800;
            font-weight: bold;
            font-size: 14px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="tel"],
        input[type="date"] {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #a5d6a7;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            background-color: #ffffff;
            color: #333;
        }

        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus,
        input[type="date"]:focus {
            outline: none;
            border-color: #ff9800;
            box-shadow: 0 0 8px rgba(255, 152, 0, 0.2);
            background-color: #fffde7;
        }

        input[type="text"]::placeholder,
        input[type="password"]::placeholder,
        input[type="email"]::placeholder,
        input[type="tel"]::placeholder {
            color: #a5d6a7;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        button {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit {
            background-color: #ff9800;
            color: white;
        }

        .btn-submit:hover {
            background-color: #f57c00;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(255, 152, 0, 0.3);
        }

        .btn-reset {
            background-color: #c8e6c9;
            color: #333;
            border: 2px solid #a5d6a7;
        }

        .btn-reset:hover {
            background-color: #a5d6a7;
            color: white;
            transform: translateY(-2px);
        }

        .success-message {
            display: none;
            background-color: #a5d6a7;
            color: #2e7d32;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .fail-message {
            background-color: #ff759f;
            color: #a10a11;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .info-text {
            text-align: center;
            color: #ffc107;
            font-size: 12px;
            margin-top: 20px;
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
            color: #ff9800;
            font-size: 13px;
        }

        .form-footer a {
            color: #ffc107;
            text-decoration: none;
            font-weight: bold;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- 頂部導航欄 -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.html" class="nav-logo">
                <span>🏫</span>
                翠園高中
            </a>
            <ul class="nav-links">
                <li><a href="#about">關於我們</a></li>
                <li><a href="#news">最新消息</a></li>
                <li><a href="#contact">聯絡方式</a></li>
            </ul>
            <div class="nav-buttons">
                <a href="login.php" class="btn-login">登入</a>
                <a href="register.php" class="btn-register">註冊</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="form-header">
            <h1>會員登入</h1>
            <p>✨ 歡迎回來 ✨</p>
        </div>

        <div class="success-message" id="successMessage">
            登入成功！
        </div>
        <?php if (isset($_GET['err'])):; ?>
            <div class="fail-message" id="failMessage">
                帳號或密碼錯誤！
            </div>
        <?php endif; ?>

        <form id="loginForm" action="api_login.php" method="post">
            <div class="form-group">
                <label for="account">帳號 *</label>
                <input
                    type="text"
                    id="account"
                    name="account"
                    placeholder="請輸入帳號"
                    required>
            </div>

            <div class="form-group">
                <label for="password">密碼 *</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="請輸入密碼"
                    required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">登入</button>
                <button type="reset" class="btn-reset">重置</button>
            </div>
        </form>

        <div class="form-footer">
            還沒有帳號？ <a href="02-register.php">立即註冊</a>
        </div>

        <div class="info-text">
            * 表示必填項目
        </div>
    </div>
</body>

</html>
