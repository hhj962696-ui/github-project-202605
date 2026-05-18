<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO連線</title>
</head>

<body>

    <h1>PDO連線</h1>

    <?php
    $calss_dsn = "mysql:host=localhost;charset=utf8;dbname=myschool";
    $pdo = new PDO($calss_dsn, 'root', '');
    echo 'PDO連線成功 .. ';

    $sql_cmd1 = "SELECT * FROM `dept` ";

    $str = $pdo->query($sql_cmd1)->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($str);
    echo "</pre>";

    #額外應用 (嘗試寫入資料)

    $sql_cmd2 = "INSERT INTO `dept` (`code`, `name`) VALUES ( '601' ,'中餐科' )";
    $pdo->exec($sql_cmd2);

    echo "<h2>新增資料</h2>";
    echo $sql_cmd2;
    echo "<hr>";
    $str = $pdo->query($sql_cmd1)->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r($str);
    echo "</pre>";

    #額外應用 (嘗試修改資料)

    echo "<h2>更新資料</h2>";
    $sql_cmd3 = "UPDATE `dept` SET `code`='602' , `name` = '西餐科' WHERE `id` = '8' ";
    $pdo->exec($sql_cmd3);
    echo "<hr>";
    $str = $pdo->query($sql_cmd1)->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r($str);
    echo "</pre>";

     #額外應用 (嘗試刪除資料)

    echo "<h2>刪除資料</h2>";
    $sql_cmd4 = "DELETE FROM `dept` WHERE `id` = '9' ";
    $pdo->exec($sql_cmd4);
    echo "<hr>";
    $str = $pdo->query($sql_cmd1)->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r($str);
    echo "</pre>";







    ?>

</body>

</html>