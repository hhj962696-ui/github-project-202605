<style>
/* 整個列表 */
.student-list{
    display:flex;
    flex-wrap:wrap;
    gap:20px;
}


/* 卡片 */
.student-card{
    width:240px;
    background:#ffffff;
    border-radius:16px;
    padding:16px;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);

    position:relative;

    transition:0.3s;
}


/* 滑鼠效果 */
.student-card:hover{
    transform:translateY(-5px);
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
}


/* 學號 */
.student-id{
    position:absolute;
    top:15px;
    right:15px;

    background:#6c63ff;
    color:white;

    padding:5px 12px;
    border-radius:30px;

    font-size:14px;
}


/* 大頭照 */
.student-photo{
    text-align:center;
    margin-bottom:15px;
}

.student-photo img{
    width:96px;
    height:96px;
    border-radius:50%;
    object-fit:cover;
    border:5px solid #f2f2f2;
}


/* 姓名 */
.student-name{
    text-align:center;
    font-size:22px;
    font-weight:bold;
    margin-bottom:16px;
}


/* 資訊區 */
.student-info{
    display:flex;
    flex-direction:column;
    gap:6px;
}


/* 每一列 */
.info-row{
    display:flex;
}


/* 標題 */
.label{
    width:76px;
    color:#666;
    font-weight:bold;
}


/* 值 */
.value{
    flex:1;
    color:#333;
}
.btn-row{
    display:flex;
    justify-content: space-evenly;
    padding:4px 16px;
}
a.edit-btn {
    padding: 4px 16px;
    border: 1px solid #eee;
    border-radius: 20px;
    background: lightgreen;
}
a.edit-btn:hover,a.del-btn:hover{
    padding:4px 24px;
}

a.del-btn {
    padding: 4px 16px;
    border: 1px solid #eee;
    border-radius: 20px;
    background: lightcoral;
}
.add-btn{
    padding:10px;
    background:lightgreen;
    margin:12px;
    border:3px solid green;
    border-radius:20px;
    font-size:18px;

}
.add-btn:hover{
    box-shadow:3px 6px 15px;
}
</style>
<h2><?= $_GET['code']; ?>班級學生列表</h2>
<a href="?inc=add_student" class='add-btn' >新增學生</a>

<?php 
//從class_student 中找到班級學生的學號
include "db_conn.php";
//$sql="select * from `class_student` where `class_code`='{$_GET['code']}'";
$sql=
    "SELECT `students`.`school_num`,
             `students`.`name`,
             `dept`.`name` AS 'dept_name',
             `addr`,
             `dept`,
             `uni_id`,
             --`graduate_at`,
             `graduate_school`.`name` AS `graduate_school`,
             `birthday` 
    FROM    `class_student`,
             `students` ,
             `dept`,
             `graduate_school`
    WHERE `class_student`.`class_code`='{$_GET['code']}' 
    AND  `class_student`.`school_num` = `students`.`school_num` 
    AND  `dept`.`id` = `students`.`dept`
    AND  `graduate_school`.`id` = `students`.`graduate_at`";
//$nums=$pdo->query($sql)->fetchAll();
$students=$pdo->query($sql)->fetchAll();

echo "<div class='student-list'>";
foreach($students as $student):?>
    <!-- 單一卡片 -->
    <div class="student-card">
        <!-- 學號 -->
        <div class="student-id">
            <?= $student['school_num']; ?>
        </div>
        <!-- 大頭照 -->
        <div class="student-photo">
            <?php if(isset($student['header'])):;?>
            <img src="img/<?= $student['header']; ?>">
            <?php else :;?>
            <img src="img/<?= (mb_substr($student['uni_id'],1,1)==1)?'header_default_boy.jpg':'header_default_girl.jpg'; ?>">
            <?php endif;?>
        </div>
        <!-- 姓名 -->
        <div class="student-name">
            <?= $student['name'] ?>
        </div>

        <!-- 資料區 -->
        <div class="student-info">
            <div class="info-row">
                <span class="label">生日</span>
                <span class="value"><?= $student['birthday']; ?></span>
            </div>
            <div class="info-row">
                <span class="label">地址</span>
                <span class="value"><?= mb_substr($student['addr'],0,3); ?></span>
            </div>
            <div class="info-row">
                <span class="label">科別</span>
                <span class="value"><?php $student['dept_name']; ?></span>
            </div>
            <div class="info-row">
                <span class="label">畢業國中</span>
                <span class="value"><?= $student['graduate_school']; ?></span>
            </div>
            <div class="btn-row">
                <a class="edit-btn" href="">編輯</a>
                <a class="del-btn" href="">刪除</a>
            </div>
        </div>
    </div>

    <?php endforeach;?>
</div>



