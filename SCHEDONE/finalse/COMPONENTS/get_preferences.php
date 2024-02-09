<?php
session_start();

// Check if user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    die("User ID not set in session.");
}

$userid = $_SESSION['user_id'];

// Establish a database connection
$conn = mysqli_connect('localhost', 'root', '', 'tasker');

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to retrieve preferences for the user
$query = "SELECT * FROM preferences WHERE user_id = '$userid'";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error retrieving preferences: " . mysqli_error($conn));
}

// Fetch all preferences into an array
$rows = array();
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

// Close the connection
mysqli_close($conn);

// Return preferences as JSON
echo json_encode($rows);
