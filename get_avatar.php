<?php
require './login_db_connect.php';

session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Query to retrieve the avatar data for the logged-in user
    $query = "SELECT avatar FROM `user` WHERE `username` = '$username'";
    $result = mysqli_query($con, $query);

    // Check if the query was successful
    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Set the content type header for image
        header('Content-Type: image/*');

        //Output avatar data to the browser
        echo $row['avatar'];
    } else {
        // Output an error message if there's an issue retrieving avatar data
        echo "Error retrieving avatar data: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
} else {
    // Output a message if the user is not logged in
    echo "User not logged in.";
}

?>
