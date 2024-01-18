<?php
require './init_login.php';
require 'info_db_connect.php';

$currentPage = basename($_SERVER['PHP_SELF']);
$homeActiveClass = ($currentPage === 'index.php') ? 'active' : '';
$activeStyle = ".{$homeActiveClass} a, .{$homeActiveClass} span {background-color: #808A87; padding: 10px;}";
echo "<style>{$activeStyle}</style>";

// Build SQL statement to retrieve book information
$sql='select id, title, author, country, addtime from info order by id asc';
$stmt = $pdo->query($sql);
// Fetch all book data as an associative array
$data = $stmt -> fetchAll(PDO::FETCH_ASSOC);
require './view/index.html';
?>