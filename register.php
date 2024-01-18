<?php
header('content-type:text/html;charset=utf-8');
require 'login_db_connect.php';

// Check if the username and password are set in the POST request
if(isset($_POST['username']) && isset($_POST['pwd'])){
    // Retrieve the username and password from the POST request
    $user = $_POST["username"];
    $pwd = $_POST["pwd"];

    // Hash the password using the PASSWORD_DEFAULT algorithm
    $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);

    // Check if the username or password is empty
    if($user == '' || $pwd == ''){
        echo "<script>alert('Account number or password cannot be empty.');location='./register.php'</script>";
    } else {
        // Build SQL statement to insert a new user into the database
        $sql="insert into user(username,password) values ('$user','$hashed_pwd');";
        // Build SQL statement to check if the username already exists
        $select = "select username from user where username='$user'";
        $result = mysqli_query($con, $select);
        $row = mysqli_num_rows($result);

        // Check if the username already exists
        if(!$row){
            if(mysqli_query($con,$sql)){
                echo "<script>alert('Register successfully, please log in.'); location='./login.php'</script>";
            } else {
                echo "<script>alert('Registration failed, please re-register.'); location='./register.php'</script>";
            }
        } else {
            echo "<script>alert('This user already exists, please log in directly.'); location='./login.php'</script>";
        }
    }
}

require './view/register.html';
?>