<?php

function sql_get_table($table){
    //連線資料庫
    $dsn = "mysql:host=localhost; dbname=school; charset=utf8;";
    $pdo = new PDO($dsn, 'root', '');
    $rows = $pdo->query("SELECT * FROM $table")->fetchAll(PDO::FETCH_ASSOC);

    return $rows;
}

echo "<pre>";
$array = sql_get_table('dept');
echo "<pre>";
print_r($array);



?>

