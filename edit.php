<?php
require './init_login.php';
require 'info_db_connect.php';

// Get the book ID to be edited from the GET parameters, default to 0 if not set
$id=isset($_GET['id'])?(int)$_GET['id']:0;
$data=array('id'=>$id);

// Build the SQL select statement to fetch book details
$sql = 'select title, author, country, content, addtime from info where id=:id';
$stmt=$pdo->prepare($sql);
if(!$stmt->execute($data)){
    exit('Inquiry Failed'.implode(' ',$dtmt->errorInfo()));}
    // Fetch the book details as an associative array
    $data=$stmt->fetch(PDO::FETCH_ASSOC);
    if(empty($data)){
        echo('News id does not exist');
    }
    // If the form is submitted (POST request), update the book information
    if(!empty($_POST)){
        // Get the book ID from the GET parameters again
        $id=isset($_GET['id'])?(int)$_GET['id']:0;
        $data=array('id'=>$id);
        $data['title']=trim(htmlspecialchars($_POST['title']));
        $data['author']=trim(htmlspecialchars($_POST['author']));
        $data['country']=trim(htmlspecialchars($_POST['country']));
        $data['state']=trim(htmlspecialchars($_POST['state']));
        $data['content']=trim(htmlspecialchars($_POST['content']));

        $sql = 'update `info` set title=:title, author=:author, country=:country, content=:content where id=:id';
        $stmt=$pdo->prepare($sql);
        $stmt->execute($data);
    }

require './view/edit.html';