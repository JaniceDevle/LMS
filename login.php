<?php
header('content-type:text/html;charset=utf-8');
require 'login_db_connect.php';

// Check if the username and password are set in the POST request
if(isset($_POST['username']) && isset($_POST['password'])){
    // Retrieve and trim the captcha value from the POST request
    $captcha = isset($_POST['captcha']) ? trim($_POST['captcha']) : '';
    session_start();

    // Check if the 'captcha' key is empty or not set in the session
    if(empty($_SESSION['captcha'])){
        exit('The verification code has expired, please return and refresh the page.');
    }

    // Retrieve the true captcha value from the session and unset it
    $true_captcha = $_SESSION['captcha'];
    unset($_SESSION['captcha']);

    // Compare the entered captcha with the true captcha in a case-insensitive manner
    if(strtolower($captcha) !== strtolower($true_captcha)){
        exit('The verification code you entered is incorrect! Please go back and refresh the page to try again.');
    }

    // Retrieve the username and password from the POST request
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare and execute a SQL statement to retrieve user information based on the username
    $stmt = $con->prepare("SELECT id, username, password FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $username, $hashed_password);
    $stmt->fetch();
    $stmt->close();

    // Verify the entered password with the hashed password stored in the database
    if(password_verify($password, $hashed_password)){
        session_start();
        $_SESSION['username'] = $username;
        echo "<script>alert('Welcome!'); location='./index.php'</script>";
    } else {
        echo "<script>alert('Account does not exist or password is wrong, click to go to register'); location='./register.php'</script>";
    }
}

require './view/login.html';
?>
