<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $pdo_link = "mysql:host=localhost;charset=utf8;dbname=school";
        $pdo = new PDO($pdo_link,'root','');

        echo 'PDO OK';

                
    
    ?>

    
</body>


</html>