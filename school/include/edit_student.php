<?php include "db_conn.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編輯學生資料</title>
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
        <h1>編輯學生資料</h1>
        <?php
        $student=$pdo->query("select * from `students` where `school_num`='{$_GET['num']}'")->fetch();
        $class_code=$pdo->query("select * from `class_student` where `school_num`='{$_GET['num']}'")->fetch();

        ?>
        <form method="POST" action="./include/api_edit_student.php">
            <div class="form-group">
                <label for="school_num">學號</label>
                <div><?= $student['school_num']; ?></div>
                <input type="hidden" id="school_num" name="school_num" value="<?= $student['school_num']; ?>">
            </div>
            <div class="form-group">
                <label for="class">所屬班級</label>
                <select id="class" name="class_code" >
                    <option value="">請選擇分配的班級</option>

                    <?php 
                        $classes=$pdo->query("SELECT * FROM `classes`")->fetchAll();
                        foreach($classes as $class):
                    ?>
                    <option value="<?= $class['code']; ?>" <?= ($class['code']==$class_code['class_code'])?'selected':''; ?> ><?= $class['name']; ?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">
                <label for="seat_num">座號</label>
                <input type="number" id="seat_num" name="seat_num" value="<?= $class_code['seat_num']; ?>">
            </div>
            <script>
                // 監聽班級選擇變更
                document.getElementById('class').addEventListener('change', function() {
                    const classCode = this.value;
                    
                    // 如果沒有選擇班級，清空座號
                    if (!classCode) {
                        document.getElementById('seat_num').value = '';
                        return;
                    }
                    
                    // 發送 GET 請求到後端取得最大座號
                    fetch(`./include/get_max_seat_num.php?code=${encodeURIComponent(classCode)}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.text();
                        })
                        .then(data => {
                            // 將取得的座號填入輸入框
                            document.getElementById('seat_num').value = data.trim();
                        })
                        .catch(error => {
                            console.error('錯誤:', error);
                            alert('取得座號失敗，請稍後重試');
                        });
                });
            </script>
            <div class="form-group">
                <label for="name">姓名</label>
                <input type="text" id="name" name="name" value="<?= $student['name'] ?>">
            </div>

            <div class="form-group">
                <label for="birthday">生日</label>
                <input type="date" id="birthday" name="birthday" value="<?= $student['birthday'] ?>" >
            </div>

            <div class="form-group">
                <label for="uni_id">身份證字號</label>
                <input type="text" id="uni_id" name="uni_id" value="<?= $student['uni_id'] ?>" placeholder="例如：A123456789" >
            </div>

            <div class="form-group">
                <label for="addr">地址</label>
                <input type="text" id="addr" name="addr" value="<?= $student['addr'] ?>" >
            </div>

            <div class="form-group">
                <label for="parents">父母</label>
                <input type="text" id="parents" name="parents" value="<?= $student['parents'] ?>" >
            </div>

            <div class="form-group">
                <label for="tel">電話</label>
                <input type="text" id="tel" name="tel" value="<?= $student['tel'] ?>" placeholder="例如：0912345678" >
            </div>

            <div class="form-group">
                <label for="dept">科別</label>
                <select id="dept" name="dept" >
                    <option value="">請選擇科別</option>
                    <?php 
                        $depts=$pdo->query("SELECT * FROM `dept`")->fetchAll();
                        foreach($depts as $dept):
                    ?>
                    <option value="<?= $dept['id']; ?>" <?= ($dept['id']==$student['dept'])?'selected':''; ?> ><?= $dept['name']; ?></option>
                    <?php endforeach;?>
                </select>
            </div>

            <div class="form-group">
                <label for="graduate_at">畢業國中</label>
                <select id="graduate_at" name="graduate_at" >
                    <option value="">請選擇畢業國中</option>
                    <?php 
                        $schools=$pdo->query("SELECT * FROM `graduate_school`")->fetchAll();
                        foreach($schools as $school):
                    ?>
                    <option value="<?= $school['id']; ?>" <?= ($school['id']==$student['graduate_at'])?'selected':''; ?> ><?= $school['county'].$school['name']; ?></option>
                    <?php endforeach;?>
                </select>
            </div>

            <div class="form-group">
                <label for="status_code">畢業狀態</label>
                <select id="status_code" name="status_code" >
                    <option value="">請選擇畢業狀態</option>
                    <?php 
                        $status=$pdo->query("SELECT * FROM `status`")->fetchAll();
                        foreach($status as $s):
                    ?>
                    <option value="<?= $s['id']; ?>" <?= ($s['id']==$student['status_code'])?'selected':''; ?> ><?= $s['status']."(".$s['note'].")"; ?></option>
                    <?php endforeach;?>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">確認修改</button>
                <button type="reset" class="btn-reset">清除</button>
            </div>
        </form>
    </div>
</body>
</html>