<?php
// Check if the task 'id' is provided in the query parameters
if (isset($_GET['id'])) {

    // Establish a database connection
    $conn = mysqli_connect('localhost', 'root', '', 'tasker');

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the task 'id' from the query parameters
    $id = $_GET['id'];

    // Prepare and execute a SQL query to fetch a task with the specified 'id'
    $sql = "SELECT * FROM tasks WHERE ID = $id";
    $result = mysqli_query($conn, $sql);

    // Check if a task with the specified 'id' was found
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Return task details as JSON
        header('Content-Type: application/json');
        echo json_encode($row);
    } else {
        // Task not found
        echo json_encode(['error' => 'Task not found']);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Invalid request
    echo json_encode(['error' => 'Invalid request']);
}
