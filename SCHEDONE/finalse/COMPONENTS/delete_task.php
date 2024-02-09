<?php
// Check if the request method is GET and if the 'id' parameter is set
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'tasker');

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the task ID to delete
    $id_to_delete = $_GET['id'];

    // Delete the task from the database using prepared statements
    $sql = "DELETE FROM tasks WHERE ID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_to_delete);

    // Check if the deletion was successful
    if (mysqli_stmt_execute($stmt)) {
        // Successful deletion
        mysqli_close($conn);
        echo '<script>alert("Task deleted successfully!");</script>';
        echo '<script>window.location.href = "tasks.php";</script>';
        exit();
    } else {
        // Error in deletion
        echo "Error deleting task: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Redirect if accessed without proper form submission
    header("Location: tasks.php");
    exit();
}
