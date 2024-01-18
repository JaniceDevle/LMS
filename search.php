<?php
require './init_login.php';
require 'info_db_connect.php';

$currentPage = basename($_SERVER['PHP_SELF']);
// Determine the active class for the "Book Management" link
$bookActiveClass = ($currentPage === 'search.php') ? 'active' : '';
$activeStyle = ".{$bookActiveClass} a, .{$bookActiveClass} span {background-color: #808A87; padding: 10px;}";
echo "<style>{$activeStyle}</style>";

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the search term and search type from the POST request
    $searchTerm = $_POST['searchTerm'];
    $searchType = $_POST['searchType'];

    // Build SQL query based on the search type
    if ($searchType === 'title') {
        $sql = "SELECT id, title, author, country, addtime FROM info WHERE title LIKE '%$searchTerm%' ORDER BY id ASC";
    } elseif ($searchType === 'id') {
        $sql = "SELECT id, title, author, country, addtime FROM info WHERE id = $searchTerm ORDER BY id ASC";
    } else {
        $sql = "SELECT id, title, author, country, addtime FROM info ORDER BY id ASC";
    }

    // Execute the SQL query and fetch data
    $stmt = $pdo->query($sql);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // If the request method is not POST, retrieve all information
    $sql = 'SELECT id, title, author, country, addtime FROM info ORDER BY id ASC';
    $stmt = $pdo->query($sql);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

require './view/search.html';
?>
