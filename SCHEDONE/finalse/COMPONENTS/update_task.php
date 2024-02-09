<?php

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'tasker');

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get values from the form
    $id = $_POST['id'];
    $category = $_POST['category'];
    $subject = $_POST['subject'];
    $task = $_POST['task'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];
    $priority = $_POST['priority'];
    $comments = $_POST['comments'];

    // Update the task in the database using prepared statements
    $sql = "UPDATE tasks SET 
            Category = ?,
            Subject = ?,
            Task = ?,
            Deadline = ?,
            Status = ?,
            Priority = ?,
            Comments = ?
            WHERE ID = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssi", $category, $subject, $task, $deadline, $status, $priority, $comments, $id);

    // Check if the update was successful
    if (mysqli_stmt_execute($stmt)) {
        // Successful update
        mysqli_close($conn);
        echo '<script>alert("Task updated successfully!");</script>';
        echo '<script>window.location.href = "tasks.php";</script>';
        exit();
    } else {
        // Error in update
        echo "Error updating task: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Redirect if accessed without proper form submission
    header("Location: tasks.php");
    exit();
}
