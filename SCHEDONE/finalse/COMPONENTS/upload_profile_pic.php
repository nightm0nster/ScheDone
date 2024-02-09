<?php

session_start(); // Start the session

// Establish a connection to the MySQL database
$connection = mysqli_connect("localhost", "root", "", "tasker");

// Check if the connection was successful; otherwise, display an error message and terminate the script
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if a file was uploaded and handle potential errors
if (isset($_FILES['profile-pic'])) {
    $file_error = $_FILES['profile-pic']['error'];
    if ($file_error === UPLOAD_ERR_OK) {
        // Proceed with file processing

        // Define the directory where the uploaded profile pictures will be stored
        $uploadDir = "../profile_pics/";

        // Validate file size (optional)
        if ($_FILES['profile-pic']['size'] > 2 * 1024 * 1024) { // 2 MB limit
            $error_message = "File size exceeds the limit of 2 MB.";
            goto upload_error;
        }

        // Validate file type (optional)
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");
        $file_ext = strtolower(pathinfo($_FILES['profile-pic']['name'], PATHINFO_EXTENSION));
        if (!in_array($file_ext, $allowed_extensions)) {
            $error_message = "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
            goto upload_error;
        }

        // Continue with file upload and database insertion
        $filename = basename($_FILES['profile-pic']['name']);
        $uniqueFilename = uniqid('profile_pic_') . '.' . $file_ext;
        $uploadPath = $uploadDir . $uniqueFilename;

        if (move_uploaded_file($_FILES['profile-pic']['tmp_name'], $uploadPath)) {
            // Insert the new profile picture information into the database
            $file_path = $uploadPath;
            $sql = "INSERT INTO profile_pictures (image_url) VALUES ('$file_path')";
            if (mysqli_query($connection, $sql)) {
                $last_id = mysqli_insert_id($connection);
                $success_message = "Profile picture uploaded successfully!";
                $new_image_path = $uploadPath;

                // Update user's profile picture filename in the session (optional)
                $_SESSION['profile_pic'] = $uniqueFilename;
            } else {
                $error_message = "Failed to insert profile picture into database.";
                goto upload_error;
            }
        } else {
            $error_message = "Failed to upload profile picture.";
            goto upload_error;
        }
    } else {
        // Handle specific upload errors based on $file_error (optional)
        switch ($file_error) {
            case UPLOAD_ERR_INI_SIZE:
                $error_message = "The uploaded file exceeds the upload_max_filesize directive in php.ini.";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $error_message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
                break;
            case UPLOAD_ERR_PARTIAL:
                $error_message = "The uploaded file was only partially uploaded.";
                break;
            case UPLOAD_ERR_NO_FILE:
                $error_message = "No file was uploaded.";
                break;
            default:
                $error_message = "An unknown error occurred during file upload.";
        }
        goto upload_error;
    }
} else {
    $error_message = "No file uploaded.";
}

// Close the database connection
mysqli_close($connection);

// Respond with JSON-encoded message (adjust response based on success/error)
if (isset($error_message)) {
    echo json_encode(array('success' => false, 'message' => $error_message));
} else {
    echo json_encode(array('success' => true, 'message' => $success_message, 'newImagePath' => $new_image_path));
}

// Label for error handling
upload_error:


