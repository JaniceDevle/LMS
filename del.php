<?php
require './init_login.php';
require 'info_db_connect.php';

// Get the book ID to be deleted from the GET parameters, default to 0 if not set
$id=isset($_GET['id'])?(int)$_GET['id']:0;
// Build an associative array containing the book ID
$data=array('id'=>$id);
$sql = 'delete from info where id=:id';
$stmt=$pdo->prepare($sql);

// Execute the SQL statement, output error information if execution fails
if(!$stmt->execute($data)){
    exit('Delete Failed'.implode('-',$stmt->errorInfo()));
}
header('Location: index.php');