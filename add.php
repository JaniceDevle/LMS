<?php
require './init_login.php';

// Check if the form data is submitted via POST
if(!empty($_POST)){
    // Initialize an array to store form data after sanitization
    $data = array();
    $data['title']=trim(htmlspecialchars($_POST['title']));
    $data['author']=trim(htmlspecialchars($_POST['author']));
    $data['country']=trim(htmlspecialchars($_POST['country']));
    $data['content']=trim(htmlspecialchars($_POST['content']));

    require 'info_db_connect.php';

// SQL query to insert data into the 'info' table
$sql = 'insert into info(title, author, country, content) values(:title, :author, :country, :content)';
// Prepare the SQL statement
$stmt = $pdo->prepare($sql);
// Execute the prepared statement with the sanitized data
$stmt->execute($data);
// Redirect to the index.php page after successful insertion
header('Location:./index.php');
}

require './view/add.html';