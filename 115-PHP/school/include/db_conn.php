<?php
$dsn = "mysql:host=localhost;charset=utf8;dbname=school";
$pdo = new PDO($dsn, 'root', '');
// echo 'PDO OK';
session_start();
date_default_timezone_set("Asia/Taipei");
