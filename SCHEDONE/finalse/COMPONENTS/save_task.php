<?php
// Start the session
session_start();
$userid = $_SESSION['user_id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'tasker');

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get values from the form
    $category = $_POST['category'];
    $subject = $_POST['subject'];
    $task = $_POST['task'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];
    $priority = $_POST['priority'];
    $comments = $_POST['comments'];

    // Insert the task into the database using prepared statements
    $sql = "INSERT INTO tasks (user_id, Category, Subject, Task, Deadline, Status, Priority, Comments) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssss", $userid, $category, $subject, $task, $deadline, $status, $priority, $comments);

    // Check if the insertion was successful
    if (mysqli_stmt_execute($stmt)) {
        // Successful addition
        mysqli_close($conn);
        echo '<script>alert("Task added successfully!");</script>';
        echo '<script>window.location.href = "tasks.php";</script>';
        exit();
    } else {
        // Error in addition
        echo "Error adding task: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Redirect if accessed without proper form submission
    header("Location: tasks.php");
    exit();
}
