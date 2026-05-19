<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員註冊</title>
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

        .info-text {
            text-align: center;
            color: #ffc107;
            font-size: 12px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div>
    <h2>簡易註冊系統</h2>
    <ul>
        <li>建立一個資料表來存放使用者的帳號、密碼及個人資料</li>
        <li>建立一個網頁表單可以讓使用者輸入自己的帳號、密碼及個人資料</li>
        <li>送出表單後可以將使用者的資料存入資料表</li>
    </ul>
    <h3>資料表設計-members</h3>
    <ul>
        <li>id</li>
        <li>account</li>
        <li>password</li>
        <li>tel</li>
        <li>birthday</li>
        <li>email</li>
    </ul>
    <h3>註冊表單設計</h3>
    <ul>
        <li>清新簡約風</li>
        <li>整體底色是淺綠色</li>
        <li>文字以黃色或橘色做搭配</li>
        <li>表單輸入欄位都要有圓角</li>
    </ul>
</div>
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
        </div>
    </div>
</body>
</html>