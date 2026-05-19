<?php include "db_conn.php";?>
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
        select {
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
        select:focus {
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
        <h1>新增學生</h1>
        <form method="POST" action="api_add_student.php">
            <div class="form-group">
                <label for="school_num">學號 <span style="color: red;"></span></label>
                <?php 
                $defaut_num=$pdo->query("select max(`school_num`) from `students`")->fetchColumn()+1;
                ?>
                <input type="number" id="school_num" name="school_num" value="<?= $defaut_num; ?>">
            </div>

            <div class="form-group">
                <label for="name">姓名 <span style="color: red;"></span></label>
                <input type="text" id="name" name="name" >
            </div>

            <div class="form-group">
                <label for="birthday">生日 <span style="color: red;"></span></label>
                <input type="date" id="birthday" name="birthday" >
            </div>

            <div class="form-group">
                <label for="uni_id">身份證字號 <span style="color: red;"></span></label>
                <input type="text" id="uni_id" name="uni_id" placeholder="例如：A123456789" >
            </div>

            <div class="form-group">
                <label for="addr">地址 <span style="color: red;"></span></label>
                <input type="text" id="addr" name="addr" >
            </div>

            <div class="form-group">
                <label for="parent">父母 <span style="color: red;"></span></label>
                <input type="text" id="parent" name="parent" >
            </div>

            <div class="form-group">
                <label for="tel">電話 <span style="color: red;"></span></label>
                <input type="text" id="tel" name="tel" placeholder="例如：0912345678" >
            </div>

            <div class="form-group">
                <label for="dept">科別 <span style="color: red;"></span></label>
                <select id="dept" name="dept" >
                    <option value="">請選擇科別</option>
                    <?php 
                        $depts=$pdo->query("SELECT * FROM `dept`")->fetchAll();
                        foreach($depts as $dept):
                    ?>
                    <option value="<?= $dept['id']; ?>"><?= $dept['name']; ?></option>
                    <?php endforeach;?>
                </select>
            </div>

            <div class="form-group">
                <label for="graduate_at">畢業國中 <span style="color: red;"></span></label>
                <select id="graduate_at" name="graduate_at" >
                    <option value="">請選擇畢業國中</option>
                    <?php 
                        $schools=$pdo->query("SELECT * FROM `graduate_school`")->fetchAll();
                        foreach($schools as $school):
                    ?>
                    <option value="<?= $school['id']; ?>"><?= $school['county'].$school['name']; ?></option>
                    <?php endforeach;?>
                </select>
            </div>

            <div class="form-group">
                <label for="status_code">畢業狀態 <span style="color: red;"></span></label>
                <select id="status_code" name="status_code" >
                    <option value="">請選擇畢業狀態</option>
                    <?php 
                        $status=$pdo->query("SELECT * FROM `status`")->fetchAll();
                        foreach($status as $s):
                    ?>
                    <option value="<?= $s['id']; ?>"><?= $s['status']."(".$s['note'].")"; ?></option>
                    <?php endforeach;?>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">新增學生</button>
                <button type="reset" class="btn-reset">清除</button>
            </div>
        </form>
    </div>
</body>
</html>