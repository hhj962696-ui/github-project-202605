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
$dsn="mysql:host=localhost;charset=utf8;dbname=school";
$pdo=new PDO($dsn,'root','');

$sql="SELECT * FROM `dept` ";

$depts=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($depts);
echo "</pre>";

?>
</body>
</html>