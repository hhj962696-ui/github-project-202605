<h2 style='text-align:center'>班級列表</h2>
<?php include_once "db_conn.php"; 

$classrooms=$pdo->query("SELECT * FROM `classes`")->fetchAll();

echo "<div class='cards-container'>";
foreach($classrooms as $class):
?>

<a href="?inc=class_students&code=<?= $class['code']; ?>">
    <div class="card">
        <div class="card-icon"></div>
        <h3><?= $class['name'];?>(<?= $class['code']; ?>)</h3>
        <p><?= $class['tutor'] ?></p>
    </div>
</a>

<?php endforeach;?>
</div>