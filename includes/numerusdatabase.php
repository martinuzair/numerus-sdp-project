<?php

//Create database credentials
$dsn = 'mysql:host=localhost;dbname=numerus';
$db_user = 'root';
$db_password = '';

//Create PDO object and Error Handler
try {
    $pdo = new PDO($dsn, $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

