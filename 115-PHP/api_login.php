<?php 
$dsn="mysql:host=localhost;charset=utf8;dbname=mypage";
$pdo=new PDO($dsn,'root','');

$sql="select count(*) from `members` where `account`='{$_POST['account']}' AND `password`='{$_POST['password']}'";

//$result=$pdo->query($sql)->fetch();
$result=$pdo->query($sql)->fetchColumn();


?>
<pre>
    <?= print_r($result); 
        /* if($result[0]==1){
            echo "登入成功";
        }else{
            echo "登入失敗";

        } */
        if($result==1){
            echo "登入成功";
        }else{
            echo "登入失敗";

        }
    ?>
</pre>