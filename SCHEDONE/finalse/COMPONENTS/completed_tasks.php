<?php
// completed_tasks.php

// Connect to your database (replace these parameters with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tasker";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get the count of completed tasks
$sql = "SELECT COUNT(*) AS count FROM tasks WHERE Status = 'Completed'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the count of completed tasks
    $row = $result->fetch_assoc();
    $completedTasksCount = $row["count"];
} else {
    // If no completed tasks are found, set the count to 0
    $completedTasksCount = 0;
}

// Close the database connection
$conn->close();

// Output the count of completed tasks
echo $completedTasksCount;
