<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle local file upload
    if (isset($_FILES["avatarInput"])) {
        handleLocalFileUpload();
    } else {
        echo "Invalid request!";
    }
} else {
    echo "Invalid access!";
}

function handleLocalFileUpload() {
    // Check for file upload errors
    if ($_FILES["avatarInput"]["error"] > 0) {
        echo "Error: " . $_FILES["avatarInput"]["error"];
    } else {
        require './login_db_connect.php';

        // Get the temporary file path
        $tmpFilePath = $_FILES["avatarInput"]["tmp_name"];

        // Read the file content
        $fileData = file_get_contents($tmpFilePath);

        // Assume user information is stored in a table named `user`
        $sql = "UPDATE user SET avatar = ? WHERE username = ?";
        $stmt = $con->prepare($sql);

        // Replace the data types and variable names below to match your database table structure
        $username = $_SESSION['username'];
        $stmt->bind_param("ss", $fileData, $username);

        if ($stmt->execute()) {
            echo "Avatar uploaded successfully.";
        } else {
            echo "Error uploading avatar: " . $stmt->error;
        }

        $stmt->close();
        $con->close();

        // Delete the temporary file
        unlink($tmpFilePath);

        // Redirect back to the user's avatar page
        header("Location: index.php");
        exit();
    }
}
?>
