<?php
session_start();
$userid = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // echo $userid;
    function connection(){
        // Establish a database connection
        $conn = mysqli_connect('localhost', 'root', '', 'tasker');

        // Check if the connection was successful
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $conn;
    }

    // $fs;
    // $fst;
    // $ff;
    // $sort;
    // $cc;

    function getPreferences($userid){
        // Establish a database connection
        $conn = connection();
        $query = "SELECT * FROM preferences WHERE user_id = '$userid'";
        $result = mysqli_query($conn, $query);
        $rows = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    if (isset($_POST['action']) && $_POST['action'] == 'apply') {
        $result = getPreferences($userid);
            if ($_POST['fontSize'] == ""){
                $fs = $result[0]['font_size']; 
            } else {
                $fs = $_POST['fontSize'];
            }
            if ($_POST['fontStyle'] == ""){
                $fst = $result[0]['font_style'];
            } else {
                $fst = $_POST['fontStyle'];
            }
            if ($_POST['fontFamily'] == ""){
                $ff = $result[0]['font_family'];
            } else {
                $ff = $_POST['fontFamily'];
            }
            if ($_POST['colorCoding'] == ""){
                $cc = $result[0]['colors'];
            } else {
                $cc = $_POST['colorCoding'];
            }
            if ($_POST['sort'] == ""){
                $sort = $result[0]['sort'];
            } else {
                $sort = $_POST['sort'];
            }
    } elseif (isset($_POST['action']) && $_POST['action'] == 'reset') {
        // Reset button was clicked
        $fs = "14"; 
        $fst = "normal";
        $ff = "Arial";
        $sort = "deadline";
        $cc = "#ffffff";
    }

    //create a query where it will check existing uid
    $preferencesExist = "SELECT user_id FROM preferences WHERE user_id='$userid'"; 
    $conn = connection();

    echo $fs, $fst, $ff, $sort, $cc;
        // Check if preferences exist for the user
        $checkExistingQuery = mysqli_query($conn, $preferencesExist);
        if (!$checkExistingQuery) {
            // Error occurred during the query execution
            echo "Error checking existing preferences: " . mysqli_error($conn);
        } else {
            if (mysqli_num_rows($checkExistingQuery) > 0) {
                // User preferences already exist, update them
                $sql = "UPDATE preferences SET font_size=?, font_style=?, font_family=?, sort=?, colors=? WHERE user_id=?";
            } else {
                // User preferences don't exist, insert new preferences
                $sql = "INSERT INTO preferences (font_size, font_style, font_family, sort, colors, user_id) VALUES (?, ?, ?, ?, ?, ?)";
            }
            
            // Prepare and execute the SQL statement
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssssss", $fs, $fst, $ff, $sort, $cc ,$userid);
            
            if (mysqli_stmt_execute($stmt)) {
                if (mysqli_affected_rows($conn) > 0) {
                    // Preferences inserted or updated successfully
                    echo "Success " . (mysqli_num_rows($checkExistingQuery) > 0 ? "updating" : "adding") . " your preferences";
                } else {
                    echo "No changes made to preferences";
                }
            } else {
                // Error occurred during the statement execution
                echo "Error " . (mysqli_num_rows($checkExistingQuery) > 0 ? "updating" : "adding") . " preferences: " . mysqli_error($conn);
            }
    
            // Close the statement
            mysqli_stmt_close($stmt);
        }
        // Close the connection
        mysqli_close($conn);
    }

// echo "<script>window.history.go(-1);</script>";
// echo "<script>setTimeout(function() { window.location.href = 'tasks.php'; }, 1000);</script>";
echo "<script>window.history.go(-1);</script>";
echo "<script>window.location.href = 'tasks.php';</script>";

