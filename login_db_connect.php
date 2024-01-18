<?php
header('Content-type:text/html; charset=utf8');

$con=mysqli_connect("localhost","root","","web");
if(mysqli_connect_errno()){
    echo "Fail to connect MySQL: " . mysqli_connect_error();
}