<?php
$dsn = "mysql:host=localhost;charset=utf8;dbname=school";
$pdo = new PDO($dsn, 'root', '');
// echo 'PDO OK';
session_start();
date_default_timezone_set("Asia/Taipei");

function all($table){
    //連線資料庫
    global $pdo;
    $rows=$pdo->query("SELECT * FROM $table")->fetchAll(PDO::FETCH_ASSOC);

    return $rows; //整個$table 的資料
}

function find($table,$id){
    //連線資料庫
    global $pdo;

    if(!is_numeric($id)){
        echo "ID 必須為數字";
        return false;
    }else if($id<1){
        echo "ID 必須大於等於 1";
        return false;
    }else if(!$pdo->query("SELECT count(*) FROM $table WHERE `id`='$id'")->fetchColumn()){
        echo "找不到指定的資料";
        return false;
    }

    $row=$pdo->query("SELECT * FROM $table WHERE `id`='$id'")->fetch(PDO::FETCH_ASSOC);

 return $row;
}

function sql_update($table, $arg, $cols){
    // 宣告引入外部的全域變數 $pdo，這樣函式內部才能使用這個資料庫連線物件
    global $pdo;

    // 初始化 SQL 語法字串，先寫好 UPDATE 和資料表名稱
    $sql = "UPDATE $table SET ";
    
    // 準備一個空陣列，用來暫存準備要更新的欄位與值（例如：`name`='John'）
    $tmp = []; 
    
    // 使用迴圈拆解要更新的資料（$cols 陣列）
    foreach($cols as $key => $val){
        // 將每個欄位與值組合成 "欄位名稱='資料值'" 的格式，並塞入 $tmp 陣列中
        // 使用反單引號 `` 包住欄位名稱是為了防止與 SQL 保留字衝突
        $tmp[] = "`$key`='$val'";
    }
     
    // 用逗號把 $tmp 陣列裡的每個欄位字串串接起來，並連加到 $sql 字串後面
    // 此時 $sql 會變成 "UPDATE 資料表 SET `欄位1`='值1',`欄位2`='值2'"
    $sql .= join(",", $tmp);


    // 判斷第二個參數 $arg 是不是數字（如果是數字，代表使用者想直接用主鍵 id 來指定資料）
    if(is_numeric($arg)){
        // 如果是數字，就在 SQL 後面直接加上 WHERE `id` = '數字'
        $sql .= " WHERE `id`='$arg'";
    } else {
        // 如果不是數字（通常是傳入陣列），就代表使用者想用特定欄位當作篩選條件
        // 重新清空 $tmp 陣列，用來暫存 WHERE 的篩選條件
        $tmp = [];
        
        // 使用迴圈拆解篩選條件（$arg 陣列）
        foreach($arg as $key => $val){
            // 將每個條件組合成 "欄位名稱='篩選值'" 格式塞入 $tmp
            $tmp[] = "`$key`='$val'";
        }
        
        // 用 " AND " 把所有條件串接起來，並連加到 $sql 字串後面
        // 此時 $sql 會補上 " WHERE `欄位A`='值A' AND `欄位B`='值B'"
        $sql .= " WHERE " . join(" AND ", $tmp);
    }

    // 在畫面上印出最後組合完成的完整 SQL 語法（通常用於除錯、檢查語法是否正確）
    echo $sql;
    
    // 執行這條 SQL 語法，並回傳受影響的資料筆數（成功更新幾筆）
    return $pdo->exec($sql);
}


function sql_insert($table,$arg){
    global $pdo;

    $keys=array_keys($arg);

    $sql_cmd="INSERT INTO $table (`" . join("`,`",$keys) . "`) VALUES ('" . join("','",$arg) . "')";
    //echo $sql_cmd;
    return $pdo->exec($sql_cmd);
}

function sql_delete($table, $arg){
    // 宣告引入外部的全域變數 $pdo，這樣函式內部才能使用這個資料庫連線物件
    global $pdo;
    
    // 初始化 SQL 語法字串，先寫好基本的 DELETE FROM 和資料表名稱
    // 使用反單引號 `` 包住資料表名稱，防止與 SQL 保留字衝突
    $sql_cmd = "DELETE FROM `$table`";

    // 判斷第二個參數 $arg 是不是數字（如果是數字，代表使用者想直接指定某個主鍵 id 來刪除）
    if (is_numeric($arg)){
        // 【注意！Bug 修正】：原本的 "WHERE..." 前面少了一個空格，會導致 SQL 變成 "DELETE FROM `users`WHERE..."
        // 這裡加上空格改為 " WHERE..."，程式才能正常執行。
        // 組合成 SQL 語法：WHERE `id` = '數字'
        $sql_cmd .= " WHERE `id` = '$arg'";
    } else {
        // 如果 $arg 不是數字（通常是傳入陣列），代表使用者想用特定欄位組合當作刪除條件
        // 準備一個空陣列，用來暫存各個篩選條件
        $tmp = [];
        
        // 使用迴圈拆解條件陣列 $arg
        foreach($arg as $key => $val ){
            // 將每個鍵值對組合成 "欄位名稱='資料值'" 的格式，並塞入 $tmp 陣列中
            $tmp[] = "`$key`='$val'";
        }
        
        // 用 " AND " 把所有條件串接起來，並連加到 $sql_cmd 字串後面
        // 此時 $sql_cmd 會補上 " WHERE `欄位A`='值A' AND `欄位B`='值B'"
        $sql_cmd .= " WHERE " . join(" AND ", $tmp);
    }

    // 執行這條組合好的 DELETE SQL 語法，並回傳受影響的資料筆數（成功刪除了幾筆資料）
    return $pdo->exec($sql_cmd);
}


?>