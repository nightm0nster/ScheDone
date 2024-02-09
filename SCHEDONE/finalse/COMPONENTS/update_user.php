
<?php
// Start the session
session_start();

// Establish a connection to the MySQL database
$connection = mysqli_connect("localhost", "root", "", "tasker");

// Check if the connection was successful; otherwise, display an error message and terminate the script
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in; otherwise, return an error message
if (!isset($_SESSION['username'])) {
    echo "User not logged in";
    exit();
}

// Get and sanitize the updated user information from the POST data
$newName = mysqli_real_escape_string($connection, $_POST['name']);
$newEmail = mysqli_real_escape_string($connection, $_POST['email']);
$newContact = mysqli_real_escape_string($connection, $_POST['contact']);
$newUsername = mysqli_real_escape_string($connection, $_POST['username']); // assuming username is editable
$newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT); // assuming you want to hash and store the password

// Construct an SQL query to update the user information in the 'register' table
$sql = "UPDATE `register` SET `name`='$newName', `email`='$newEmail', `contact_number`='$newContact', `username`='$newUsername', `password`='$newPassword' WHERE `username`='$newUsername'";

// Execute the query and check if it was successful
if (mysqli_query($connection, $sql)) {
    // If successful, update the session variables with the new information
    $_SESSION['name'] = $newName;
    $_SESSION['email'] = $newEmail;
    $_SESSION['contact'] = $newContact;
    $_SESSION['username'] = $newUsername; // update username in session
    
    // Return a success message
    echo json_encode(array("success" => true));
} else {
    // If there's an error, return an error message
    echo json_encode(array("success" => false, "error" => mysqli_error($connection)));
}

// Close the database connection
mysqli_close($connection);
