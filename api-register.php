<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    $page_dsn = "mysql:host=localhost;charset=utf8;dbname=mypage";
    $pdo = new PDO($page_dsn, 'root', '');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";

        $sql_reg_cmd = "INSERT INTO `member` (`cdkey`, `password`, `tel`, `birth`, `email`) 
                        VALUES ('{$_POST['cdkey']}',
                                '{$_POST['password']}',
                                '{$_POST['tel']}',
                                '{$_POST['birth']}',
                                '{$_POST['email']}')";
        echo $sql_reg_cmd;

        $result = $pdo->exec($sql_reg_cmd);

        if ($result == FALSE) {
            echo "註冊失敗";
        } else {
            echo "成功新增了 {$result} 筆資料！";
            // 取得剛剛註冊成功的會員流水號 (Primary Key)
            echo "新會員的 ID 是: " . $pdo->lastInsertId();

            // 成功後再跳轉
            header("location:02-register.php");
            exit; // 習慣上 header 後面要補 exit，防止後續程式碼繼續跑
        }
    }


    ?>

</body>

</html>