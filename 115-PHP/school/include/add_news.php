
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增學生</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        label {
            display: block;
            color: #333;
            font-weight: bold;
            min-width: 100px;
            flex-shrink: 0;
            text-align-last:justify;
        }
        input[type="text"],
        input[type="number"],
        input[type="date"],
        select,
        textarea {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }
        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
        }
        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }
        button {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        .btn-submit {
            background-color: #4CAF50;
            color: white;
        }
        .btn-submit:hover {
            background-color: #45a049;
        }
        .btn-reset {
            background-color: #f44336;
            color: white;
        }
        .btn-reset:hover {
            background-color: #da190b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>新增消息</h1>
        <form method="POST" action="./include/api_add_news.php">
            <div class="form-group">
                <label for="subject">主題</label>
                <input type="text" id="subject" name="subject" value="">
            </div>
            <div class="form-group">
                <label for="content">內容</label>
                <textarea id="content" name="content"  style="width:500px;height:250px;"></textarea>
            </div>
            <div class="form-group">
                <label for="author">作者</label>
                <input type="text" id="author" name="author" value="">
            </div>
            
            <div class="form-group">
                <label for="department">單位</label>
                <input type="text" id="department" name="department" >
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-submit">新增消息</button>
                <button type="reset" class="btn-reset">清除</button>
            </div>
        </form>
    </div>
</body>
</html>