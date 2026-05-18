<h2><?= $_GET['code']; ?>班級學生列表</h2>
<style>
    .student-list{
        border-collapse: collapse;
        margin:20px auto;
    }
    .student-list td{
        border:1px solid #ccc;
        padding:5px 10px;
    }
</style>
<?php 
//從class_student 中找到班級學生的學號
include "db_conn.php";
//$sql="select * from `class_student` where `class_code`='{$_GET['code']}'";
$sql="select `students`.`school_num`,
             `name`,
             `birthday` 
        from `class_student`,
             `students` 
       where `class_student`.`class_code`='{$_GET['code']}' AND 
             `class_student`.`school_num`=`students`.`school_num`";
//$nums=$pdo->query($sql)->fetchAll();
$students=$pdo->query($sql)->fetchAll();

echo "<table class='student-list'>";
echo "<tr>";
echo "<td>學號</td>";
echo "<td>姓名</td>";
echo "<td>生日</td>";
echo "</tr>";
foreach($students as $student){
    //$sql="select * from `students` where `school_num`='{$num['school_num']}'";
    //$student=$pdo->query($sql)->fetch();
echo "<tr>";
echo "<td>{$student['school_num']}</td>";
echo "<td>{$student['name']}</td>";
echo "<td>{$student['birthday']}</td>";
echo "</tr>";
}


echo "</table>";

?>