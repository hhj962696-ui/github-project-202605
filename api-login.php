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

        $sqlcmd_cdkey_count =
            "SELECT count(*) FROM `member`
             WHERE `cdkey` = '{$_POST['cdkey']}'
             AND `password` = '{$_POST['password']}'";

        $result = $pdo->query($sqlcmd_cdkey_count)->fetchColumn();

        if (!$result){
            echo "登入失敗";
            exit;
        }else{
            
            echo "登入成功，尊貴的會員 {$_POST['cdkey']} 歡迎你";

        }

        
    }


    ?>

</body>

</html>