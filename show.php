<?php
require './init_login.php';
require 'info_db_connect.php';

// Retrieve the 'id' parameter from the GET request or set it to 0
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
// Create an associative array with 'id' as the key for data retrieval
$data = array('id' => $id);

$sql = 'SELECT id, title, content, author, country, addtime FROM info WHERE id=:id';
$stmt = $pdo->prepare($sql);
if (!$stmt->execute($data)) {
    exit('Inquiry Failed' . implode(' ', $stmt->errorInfo()));
}

$data = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if data is empty, and display a message if it doesn't exist
if (empty($data)) {
    echo 'id does not exist';
}

require './view/show.html';
?>

