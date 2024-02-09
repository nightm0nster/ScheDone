<?php

// Establish a connection to the MySQL database
$connection = mysqli_connect("localhost", "root", "", "tasker");

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get the username from the POST data and escape it to prevent SQL injection
    $username = mysqli_real_escape_string($connection, $_POST['username']);

    // Construct the SQL query to check if the username exists in the 'register' table
    $sql = "SELECT * FROM `register` WHERE `username`='$username'";

    // Execute the query
    $result = mysqli_query($connection, $sql);

    // Check if the query was successful and if there are rows (username exists)
    if ($result && mysqli_num_rows($result) > 0) {
        // If username exists, return 'exists'
        echo "exists";
    } else {
        // If username does not exist, return 'not_exists'
        echo "not_exists";
    }
}

// Close the database connection
mysqli_close($connection);

