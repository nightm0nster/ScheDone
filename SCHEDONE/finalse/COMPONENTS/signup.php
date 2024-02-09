<?php

// Establish a connection to the MySQL database
$connection = mysqli_connect("localhost", "root", "", "tasker");

// Check if the connection was successful; otherwise, display an error message and terminate the script
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get and sanitize user registration data from the POST data
$name = mysqli_real_escape_string($connection, $_POST['name']);
$email = mysqli_real_escape_string($connection, $_POST['email']);
$contact = mysqli_real_escape_string($connection, $_POST['contact']);
$username = mysqli_real_escape_string($connection, $_POST['username']);
$password = mysqli_real_escape_string($connection, $_POST['password']);

// Hash the user's password using the PASSWORD_DEFAULT algorithm
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Construct an SQL query to insert user registration data into the 'register' table
$sql = "INSERT INTO `register` (`name`, `email`, `contact_number`, `username`, `password`) 
        VALUES ('$name', '$email', '$contact', '$username', '$hashedPassword')";

// Execute the query and check if it was successful
if (mysqli_query($connection, $sql)) {
    // If successful, return 'success' to indicate successful registration
    echo "success"; 
} else {
    // If there's an error, return an error message
    echo "Error: " . mysqli_error($connection);
}

// Close the database connection
mysqli_close($connection);

