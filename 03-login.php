<!DOCTYPE html>
<html lang="zh-TW">
<<<<<<< HEAD
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
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background-color: #f1f8f5;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員登入 - 簡易登入系統</title>
    <style>
        /* 整體底色採淺藍色布局，與註冊頁保持一致 */
        body {
            background-color: #e0f2fe;
            font-family: 'PingFang TC', 'Microsoft JhengHei', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        /* 清新簡約風格的表單外殼 */
        .login-container {
            background-color: #ffffff;
            padding: 35px 30px;
            border-radius: 24px;
            /* 整體大圓角，感覺更活潑 */
            box-shadow: 0 10px 25px rgba(186, 216, 234, 0.5);
            width: 100%;
            max-width: 400px;
        }

        /* 文字以橘紅色搭配 */
        h2 {
            color: #ff5722;
            text-align: center;
            margin-top: 0;
            margin-bottom: 25px;
            font-size: 24px;
            letter-spacing: 2px;
        }

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
    <div class="container">
        <div class="form-header">
            <h1>會員登入</h1>
            <p>✨ 歡迎回來 ✨</p>
        </div>

        <div class="success-message" id="successMessage">
            登入成功！
        </div>

        <form id="loginForm" action="api_login.php" method="post">
            <div class="form-group">
                <label for="account">帳號 *</label>
                <input 
                    type="text" 
                    id="account" 
                    name="account" 
                    placeholder="請輸入帳號" 
                    required
=======
            color: #475569;
            font-size: 14px;
            font-weight: 500;
            padding-left: 8px;
        }

        /* 表單輸入欄位要有圓角、外型活潑 */
        input {
            width: 100%;
            padding: 12px 20px;
            border: 2px solid #cbd5e1;
            border-radius: 30px;
            /* 膠囊型圓角，外型更圓潤活潑 */
            font-size: 14px;
            color: #334155;
            background-color: #f8fafc;
            box-sizing: border-box;
            outline: none;
            transition: all 0.3s ease;
        }

        /* 輸入框聚焦時的動態效果 */
        input:focus {
            border-color: #ff5722;
            /* 聚焦時轉為橘紅邊框 */
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(255, 87, 34, 0.15);
        }

        /* 送出按鈕設計 */
        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #ff5722;
            /* 橘紅色主要按鈕 */
            color: #ffffff;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(255, 87, 34, 0.3);
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background-color: #f4511e;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 87, 34, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* 記住我和忘記密碼的行 */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 15px 0;
            font-size: 12px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .remember-me input[type="checkbox"] {
            width: auto;
            padding: 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .remember-me label {
            margin: 0;
            padding: 0;
            color: #64748b;
            font-size: 12px;
            cursor: pointer;
        }

        .forgot-password {
            color: #ff5722;
            text-decoration: none;
            font-size: 12px;
            transition: all 0.3s ease;
        }

        .forgot-password:hover {
            text-decoration: underline;
            color: #f4511e;
        }

        /* 底部註冊連結 */
        .form-footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .footer-text {
            color: #64748b;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .register-link {
            color: #ff5722;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .register-link:hover {
            color: #f4511e;
            text-decoration: underline;
        }

        /* 分隔線 */
        .divider {
            text-align: center;
            color: #cbd5e1;
            margin: 20px 0;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h2>會員登入系統</h2>

        <!-- 表單傳遞 method 建議用 post，action 之後可接你的後端程式（如 api-login.php） -->
        <form action="api-login.php" method="POST">

            <div class="form-group">
                <label for="cdkey">會員帳號</label>
                <input 
                    type="text" 
                    id="cdkey" 
                    name="cdkey" 
                    placeholder="請輸入帳號或電子郵件" 
                    required
                    autofocus
>>>>>>> 7614b9681d036a2f7afa3759b1294be5541adf09
                >
            </div>

            <div class="form-group">
<<<<<<< HEAD
                <label for="password">密碼 *</label>
=======
                <label for="password">會員密碼</label>
>>>>>>> 7614b9681d036a2f7afa3759b1294be5541adf09
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="請輸入密碼" 
                    required
                >
            </div>

<<<<<<< HEAD
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
=======
            <div class="form-options">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember" value="yes">
                    <label for="remember">記住我</label>
                </div>
                <a href="#" class="forgot-password">忘記密碼？</a>
            </div>

            <button type="submit" class="btn-submit">立即登入</button>
        </form>

        <div class="form-footer">
            <p class="footer-text">還沒有帳號嗎？</p>
            <a href="02-register.php" class="register-link">點此前往註冊</a>
        </div>
    </div>

</body>

>>>>>>> 7614b9681d036a2f7afa3759b1294be5541adf09
</html>
