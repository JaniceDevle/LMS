<?php
require './init_login.php';
require 'info_db_connect.php';

// Get the current page's file name
$currentPage = basename($_SERVER['PHP_SELF']);
// Set the corresponding navigation active class based on the current page
$borrowActiveClass = ($currentPage === 'borrow.php') ? 'active' : '';
$activeStyle = ".{$borrowActiveClass} a, .{$borrowActiveClass} span {background-color: #808A87; padding: 10px;}";
echo "<style>{$activeStyle}</style>";

// Query the database to fetch book information
$sql='select id, title, author, state from info order by id asc';
$stmt = $pdo->query($sql);
$data = $stmt -> fetchAll(PDO::FETCH_ASSOC);

$currentPage = basename($_SERVER['PHP_SELF']);
$homeActiveClass = ($currentPage === 'index.php') ? 'active' : '';
$bookActiveClass = ($currentPage === 'search.php') ? 'active' : '';
$borrowActiveClass = ($currentPage === 'borrow.php') ? 'active' : '';

require './view/borrow.html';
?>
