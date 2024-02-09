<?php
// num_tasks.php

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

// Query to get the count of tasks based on their status
$statusSql = "SELECT Status, COUNT(*) AS count FROM tasks GROUP BY Status";

$statusResult = $conn->query($statusSql);

// Initialize an array to store the task count data
$donutData = [];

if ($statusResult->num_rows > 0) {
    // Loop through each row of the result set
    while($row = $statusResult->fetch_assoc()) {
        // Add the task count data to the array
        $donutData[] = array("label" => $row["Status"], "value" => $row["count"]);
    }
} else {
    // If no tasks are found, set default values
    $donutData = [
        ["label" => "Tasks Finished", "value" => 0],
        ["label" => "Tasks In-Progress", "value" => 0],
        ["label" => "Tasks Pending", "value" => 0],
        ["label" => "Tasks Not Started", "value" => 0],
        ["label" => "Tasks Delayed", "value" => 0]
    ];
}

/*// Query to get the count of tasks based on their month
$monthSql = "SELECT MONTH(Deadline) AS month, COUNT(*) AS count FROM tasks GROUP BY MONTH(Deadline)";

$monthResult = $conn->query($monthSql);

// Initialize an array to store the task count data for the line graph
$lineData = [];

if ($monthResult->num_rows > 0) {
    // Loop through each row of the month result set
    while($row = $monthResult->fetch_assoc()) {
        // Add the task count data to the array for the line graph
        $lineData[] = array("month" => $row["month"], "value" => $row["count"]);
    }
} else {
    // If no tasks are found, set default values for the line graph
    $lineData = [
        ["month" => "1", "value" => 0],
        ["month" => "2", "value" => 0],
        ["month" => "3", "value" => 0],
        ["month" => "4", "value" => 0],
        ["month" => "5", "value" => 0],
        ["month" => "6", "value" => 0],
        ["month" => "7", "value" => 0],
        ["month" => "8", "value" => 0],
        ["month" => "9r", "value" => 0],
        ["month" => "10", "value" => 0],
        ["month" => "11", "value" => 0],
        ["month" => "12", "value" => 0]
    ];
}

// Close the database connection
$conn->close();

// Encode the task count data array as JSON and output it
echo json_encode(["donutData" => $donutData, "lineData" => $lineData]);*/

// Query to get the count of completed tasks based on their month

$monthSql = "SELECT MONTH(Deadline) AS month, COUNT(*) AS count FROM tasks WHERE Status = 'Completed' GROUP BY MONTH(Deadline)";

$monthResult = $conn->query($monthSql);

// Initialize an array to store the task count data for the line graph
$lineData = [];

// Initialize an array to keep track of which months have completed tasks
$completedMonths = array_fill(1, 12, 0);

if ($monthResult->num_rows > 0) {
    // Loop through each row of the month result set
    while($row = $monthResult->fetch_assoc()) {
        // Add the task count data to the array for the line graph
        $month = $row["month"];
        $completedMonths[$month] = $row["count"];
    }
}

// Populate line data with completed tasks count for each month
for ($i = 1; $i <= 12; $i++) {
    $lineData[] = array("month" => $i, "value" => $completedMonths[$i]);
}

// Close the database connection
$conn->close();

// Encode the task count data array as JSON and output it
echo json_encode(["donutData" => $donutData, "lineData" => $lineData]);
