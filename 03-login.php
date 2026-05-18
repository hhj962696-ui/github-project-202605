<!DOCTYPE html>
<html lang="zh-TW">

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
        }

        label {
            display: block;
            margin-bottom: 8px;
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
                <label for="account">會員帳號</label>
                <input 
                    type="text" 
                    id="account" 
                    name="account" 
                    placeholder="請輸入帳號或電子郵件" 
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">會員密碼</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="請輸入密碼" 
                    required
                >
            </div>

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

</html>
