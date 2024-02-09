<?php
// Connect to your database
$conn = mysqli_connect("localhost", "root", "", "tasker");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the current date
$currentDate = date('Y-m-d');

// Query to select tasks with deadlines within the next 3 days
$sql = "SELECT * FROM tasks WHERE Deadline BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 3 DAY)";

$result = mysqli_query($conn, $sql);

$tasks = array();

if (mysqli_num_rows($result) > 0) {
    // Fetch tasks and deadlines from the database
    while ($row = mysqli_fetch_assoc($result)) {
        $tasks[] = array(
            'id' => $row['ID'],
            'category' => $row['Category'],
            'subject' => $row['Subject'],
            'task' => $row['Task'],
            'deadline' => $row['Deadline'],
            'status' => $row['Status'],
            'priority' => $row['Priority'],
            'comments' => $row['Comments']
        );
    }
} else {
    echo "No tasks with deadlines within the next 3 days.";
}

// Close database connection
mysqli_close($conn);

// Return the list of tasks and their deadlines as JSON
echo json_encode($tasks);