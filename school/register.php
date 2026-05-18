<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員註冊 - 校園管理系統</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
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
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: var(--dark-text);
            font-size: 14px;
            font-weight: 600;
            padding-left: 5px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="tel"],
        input[type="date"] {
            width: 100%;
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
        }

        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus,
        input[type="date"]:focus {
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
        }
    </style>
</head>
<body>
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
        </div>
    </div>
</body>
</html>