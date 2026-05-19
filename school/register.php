<!DOCTYPE html>
<<<<<<< HEAD
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員註冊</title>
        <style>
=======
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員註冊 - 校園管理系統</title>
    <style>
>>>>>>> 7614b9681d036a2f7afa3759b1294be5541adf09
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

<<<<<<< HEAD
        body {
            background-color: #c8e6c9;
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
/*             display: flex;
            justify-content: center;
            align-items: center; */
            /* padding: 20px; */
        }

        .container {
            background-color: #f1f8f5;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            margin: 40px auto;
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

        .btn-login, .btn-register {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
=======
        :root {
            --primary-green: #10B981;
            --light-green: #D1FAE5;
            --dark-green: #047857;
            --accent-blue: #3B82F6;
            --light-text: #6B7280;
            --dark-text: #1F2937;
            --border-radius: 12px;
        }

        body {
            font-family: 'PingFang TC', 'Microsoft JhengHei', 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--dark-green) 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* ========== 頂部導航欄 ========== */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--dark-green) 100%);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 40px;
        }

        .navbar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: white;
        }

        .navbar-logo-icon {
            font-size: 32px;
        }

        .navbar-logo-text {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .navbar-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .btn-nav {
            padding: 8px 24px;
            border-radius: 25px;
            border: none;
            font-size: 14px;
            font-weight: 600;
>>>>>>> 7614b9681d036a2f7afa3759b1294be5541adf09
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
<<<<<<< HEAD
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
=======
            white-space: nowrap;
        }

        .btn-home {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid white;
        }

        .btn-home:hover {
            background-color: white;
            color: var(--primary-green);
            transform: translateY(-2px);
        }

        .btn-login {
            background-color: #3B82F6;
            color: white;
        }

        .btn-login:hover {
            background-color: #2563EB;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }

        /* ========== 登入表單容器 ========== */
        .page-container {
            padding-top: 70px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .register-container {
            background-color: white;
            padding: 45px 35px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 420px;
            animation: slideInUp 0.6s ease-out;
        }

        .register-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .register-header .icon {
            font-size: 48px;
            margin-bottom: 15px;
            display: block;
        }

        .register-header h2 {
            color: var(--primary-green);
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }

        .register-header p {
            color: var(--light-text);
            font-size: 14px;
        }

        /* ========== 表單群組 ========== */
        .form-group {
            margin-bottom: 18px;
>>>>>>> 7614b9681d036a2f7afa3759b1294be5541adf09
        }

        label {
            display: block;
            margin-bottom: 8px;
<<<<<<< HEAD
            color: #ff9800;
            font-weight: bold;
            font-size: 14px;
=======
            color: var(--dark-text);
            font-size: 14px;
            font-weight: 600;
            padding-left: 5px;
>>>>>>> 7614b9681d036a2f7afa3759b1294be5541adf09
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="tel"],
        input[type="date"] {
            width: 100%;
<<<<<<< HEAD
            padding: 12px 15px;
            border: 2px solid #a5d6a7;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            background-color: #ffffff;
            color: #333;
=======
            padding: 12px 16px;
            border: 2px solid #E5E7EB;
            border-radius: 10px;
            font-size: 14px;
            color: var(--dark-text);
            background-color: #F9FAFB;
            box-sizing: border-box;
            outline: none;
            transition: all 0.3s ease;
            font-family: inherit;
>>>>>>> 7614b9681d036a2f7afa3759b1294be5541adf09
        }

        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus,
        input[type="date"]:focus {
<<<<<<< HEAD
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

        .info-text {
            text-align: center;
            color: #ffc107;
            font-size: 12px;
            margin-top: 20px;
=======
            border-color: var(--primary-green);
            background-color: white;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        /* ========== 送出按鈕 ========== */
        .btn-submit {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--dark-green) 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 15px;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* ========== 表單底部 ========== */
        .form-footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #E5E7EB;
        }

        .footer-text {
            color: var(--light-text);
            font-size: 13px;
            margin-bottom: 10px;
        }

        .login-link {
            color: var(--primary-green);
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .login-link:hover {
            color: var(--dark-green);
            text-decoration: underline;
        }

        /* ========== 動畫 ========== */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ========== 響應式設計 ========== */
        @media (max-width: 768px) {
            .navbar {
                padding: 0 20px;
            }

            .navbar-logo-text {
                font-size: 16px;
            }

            .btn-nav {
                padding: 6px 16px;
                font-size: 12px;
            }

            .register-container {
                padding: 35px 25px;
                max-width: 100%;
            }

            .register-header h2 {
                font-size: 24px;
            }
        }

        @media (max-width: 480px) {
            .navbar-logo-text {
                display: none;
            }

            .register-container {
                padding: 30px 20px;
                margin-top: 20px;
            }

            .register-header h2 {
                font-size: 22px;
            }

            input[type="text"],
            input[type="password"],
            input[type="email"],
            input[type="tel"],
            input[type="date"] {
                padding: 10px 14px;
                font-size: 16px;
            }

            .btn-submit {
                padding: 11px;
            }

            .form-group {
                margin-bottom: 15px;
            }
>>>>>>> 7614b9681d036a2f7afa3759b1294be5541adf09
        }
    </style>
</head>
<body>
<<<<<<< HEAD
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
            <h1>會員註冊</h1>
            <p>✨ 歡迎加入我們的社區 ✨</p>
        </div>

        <div class="success-message" id="successMessage">
            表單已成功提交！
        </div>

        <form id="registerForm" action="api_register.php" method='post'>
            <div class="form-group">
                <label for="account">帳號 *</label>
                <input type="text" id="account" name="account" placeholder="請輸入帳號" required >
            </div>

            <div class="form-group">
                <label for="password">密碼 *</label>
                <input type="password" id="password" name="password" placeholder="請輸入密碼" required >
            </div>

            <div class="form-group">
                <label for="email">電郵 *</label>
                <input type="email" id="email" name="email" placeholder="請輸入電郵" required >
            </div>

            <div class="form-group">
                <label for="tel">電話 *</label>
                <input type="tel" id="tel" name="tel" placeholder="請輸入電話號碼" required >
            </div>

            <div class="form-group">
                <label for="birthday">生日 *</label>
                <input type="date" id="birthday" name="birthday" required >
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">註冊</button>
                <button type="reset" class="btn-reset">清空</button>
            </div>
        </form>

        <div class="info-text">
            * 表示必填項目
=======
    <!-- 導航欄 -->
    <nav class="navbar">
        <a href="index.html" class="navbar-logo">
            <span class="navbar-logo-icon">🎓</span>
            <span class="navbar-logo-text">校園管理系統</span>
        </a>
        <div class="navbar-actions">
            <a href="index.html" class="btn-nav btn-home">首頁</a>
            <a href="login.php" class="btn-nav btn-login">登入</a>
        </div>
    </nav>

    <!-- 註冊表單 -->
    <div class="page-container">
        <div class="register-container">
            <div class="register-header">
                <span class="icon">📝</span>
                <h2>會員註冊</h2>
                <p>建立新帳號開始使用校園管理系統</p>
            </div>

            <form action="register-api.php" method="POST">
                <div class="form-group">
                    <label for="cdkey">帳號</label>
                    <input 
                        type="text" 
                        id="cdkey" 
                        name="cdkey" 
                        placeholder="請輸入帳號" 
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label for="password">密碼</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="請輸入密碼" 
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="email">電子郵件</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="example@mail.com" 
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="tel">聯絡電話</label>
                    <input 
                        type="tel" 
                        id="tel" 
                        name="tel" 
                        placeholder="例如：0912345678" 
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="birth">出生日期</label>
                    <input 
                        type="date" 
                        id="birth" 
                        name="birth" 
                        required
                    >
                </div>

                <button type="submit" class="btn-submit">申請帳號</button>
            </form>

            <div class="form-footer">
                <p class="footer-text">已有帳號？</p>
                <a href="login.php" class="login-link">點此登入</a>
            </div>
>>>>>>> 7614b9681d036a2f7afa3759b1294be5541adf09
        </div>
    </div>
</body>
</html>