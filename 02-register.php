<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員註冊 - 簡易註冊系統</title>
    <style>
        /* 整體底色採淺藍色布局 */
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
        .register-container {
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

        /* 適合生日欄位的特別調整 (RWD 圓角修正) */
        input[type="date"] {
            font-family: inherit;
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

        /* 底部裝飾微文字 */
        .form-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #94a3b8;
        }
    </style>
</head>

<body>

    <div class="register-container">
        <h2>會員註冊系統</h2>

        <!-- 表單傳遞 method 建議用 post，action 之後可接你的後端程式（如 register.php） -->
        <form action="api-register.php" method="POST" method="post">

            <div class="form-group">
                <label for="cdkey">會員帳號</label>
                <input 
                    type="text" 
                    id="cdkey" 
                    name="cdkey" 
                    placeholder="請輸入您的帳號或序號" 
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">會員密碼</label>
                <input type="password" id="password" name="password" placeholder="請輸入密碼" required>
            </div>

            <div class="form-group">
                <label for="tel">聯絡電話</label>
                <input type="tel" id="tel" name="tel" placeholder="例如：0912345678" required>
            </div>

            <div class="form-group">
                <label for="birth">出生日期</label>
                <input type="date" id="birth" name="birth" required>
            </div>

            <div class="form-group">
                <label for="email">電子郵件</label>
                <input type="email" id="email" name="email" placeholder="example@mail.com" required>
            </div>

            <button type="submit" class="btn-submit">註冊會員</button>
        </form>

        <div class="form-footer">
            © 簡易註冊系統 版權所有
        </div>
    </div>

</body>

</html>