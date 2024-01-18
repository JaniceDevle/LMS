<?php
session_start();
// Check if the 'username' key is not set in the session
if(!isset($_SESSION['username'])){
    // Redirect to the login page if not logged in
    header('Location:login.php');
    exit;
}