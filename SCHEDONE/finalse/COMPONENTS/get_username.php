<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // If the user is logged in, return the username
    echo json_encode(["username" => $_SESSION['username']]);
} else {
    // If the user is not logged in, return an error message
    echo json_encode(["error" => "User not logged in"]);
}