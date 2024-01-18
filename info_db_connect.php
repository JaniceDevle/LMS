<?php
$dsn = 'mysql:host=localhost; dbname=web; charset=utf8';
try{
    // Create a new PDO instance for database connection
    $pdo=new PDO($dsn,'root','');
}catch (PDOException $e){
    // Output an error message if connection fails
    echo 'error--'.$e->getMessage();
}