<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Set character set and viewport for responsiveness -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1, initial-scale=1">
    <title>ScheDone - Dashboard</title>
     <!-- Add Favicon -->
     <link rel="icon" href="../Images/1.png" type="image/png">
    <!-- Link to Line Awesome icons library -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!-- Link to Morris.js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- Link to custom stylesheet -->
    <link rel="stylesheet" href="../CSS/welcome.css">
</head>

<body>
    <!-- Checkbox for toggling the sidebar menu -->
    <input type ="checkbox" id="menu-toggle">
    <!-- Sidebar menu -->
    <div class="sidebar">

        <!-- Brand logo and title -->
        <div class="brand">
            <span class="las la-clipboard-check"></span>
            <h2>ScheDone</h2>
        </div>
        <!-- User information in the sidebar -->
        <div class="sidemenu">
            <div class="side-user">
                <!-- User image -->
                <div id="preview-image" class="profile-image-placeholder" style="background-image: url('<?php echo isset($_SESSION['profile_pic']) ? "../profile_pics/" . $_SESSION['profile_pic'] : "../Images/default1.jpg"; ?>')"></div>
                <div class="user">
                    <!-- User role and name -->
                    <small>Student</small>
                    <p><span id="userName"></span></p>
                </div>
            </div>

            <!-- Navigation links in the sidebar -->
            <ul>
                <li>
                    <!-- Dashboard link (marked as active) -->
                    <a href="welcome.php" class="active">
                        <span class="las la-home"></span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <!-- Tasks link -->
                    <a href="../COMPONENTS/tasks.php">
                        <span class="las la-check-circle"></span>
                        <span>Tasks</span>
                    </a>
                </li>

                <li>
                    <!-- About link -->
                    <a href="about.php">
                        <span class="las la-envelope"></span>
                        <span>About</span>
                    </a>
                </li>

                <li>
                    <!-- Users link -->
                    <a href="../COMPONENTS/users.php">
                        <span class="las la-user"></span>
                        <span>User Information</span>
                    </a>
                </li>

                <li>
                    <!-- Help link -->
                    <a href="help.php">
                        <span class="las la-hands-helping"></span>
                        <span>Help</span>
                    </a>
                </li>

                <li>
                    <!-- Logout link with onClick event -->
                    <a href="#" onclick="openLogoutPopup()">
                        <span class="las la-lock"></span>
                        <span>Log Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main content area -->
    <div class="main-content">
        <header>
            <!-- Label for toggling the mobile menu -->
            <label for="menu-toggle" class="menu-toggler">
                <span class="las la-bars"></span>
            </label>

            <!-- Icons in the header -->
            <div class ="head-icons">
                <span class="las la-bell" id="notificationBell"></span>
                    <span id="notificationCount">0</span>
            </div>
        </header>
    
        <!-- Overlay for modal background -->
        <div id="overlay"></div>
            <div id="modal">
                <div id="modal-content">
            <!-- Notification Image -->
            <img src="../Images/notification.png" alt="Task Image">
            <!-- Content of modal popup -->
                <h2>Notifications</h2>
                <ul id="modal-notificationList"></ul>
                    <!-- Notification list -->
                    <ul id="notificationList"></ul>
                    <!-- Task deadlines will be dynamically added here -->
                    <ul id="taskDeadlineList"></ul>
                    <button id="close-modal">Close</button>
                </div>
            </div>
        <main>

            <!-- Cards section -->
            <div class="cards">
                <!-- Card 1: Earn Points -->
                <div class="card">
                    <div class="card-icon follow">
                        <span class="las la-coins"></span>
                    </div>
                    
                    <div class="card-info">
                        <h2><span id="pointCount">0</span></h2>
                        <small>Productivity Points</small>
                        <h3>Earn points by completing tasks. Reaching points will reward you a unique title.</h3>
                    </div>
                </div>          

                <!-- Card 2: Title -->
                <div class="card">
                    <div class="card-icon likes">
                        <span class="las la-medal"></span>
                    </div>

                    <div class="card-info2">
                        <h2 id="rewardStatus">Reward Locked</h2>
                        <small>Title</small>
                    </div>

                    <div class="card-images" id="rewardImages">
                        <!-- Images of earned rewards will be dynamically added -->
                    </div>
                </div>

                <!-- Card 3: Spin Wheel -->
                <div class="card">
                    <div class="card-icon comment">
                        <span class="las la-arrow-right"></span>
                    </div>
                    <div class="card-info">
                        <h2>Level Progress</h2>
                        <small>Level: <span id="userLevel" style="color: rgb(255, 255, 255);"></span></small>
                        <div class="progress-bar">
                            <div id="progress" class="progress" style="width: 0%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart section -->
            <div class="chart-grid">
                <!-- Chart 1: Timeline of Finished Tasks -->
                <div class="chart-follow">
                    <div class="chart-head">
                        <h3>Timeline of Monthly Finished Tasks</h3>
                        <span class="las la-cog"></span>
                    </div>

                    <!-- Chart rendered here with the id "myfirstchart" -->
                    <div id="myfirstchart" style="height: 350px;"></div>
                </div>
                <div class="chart-sales">
                    <div class="chart-head">
                        <h3>Task Status</h3>
                        <span class="las la-ellipsis-h"></span>
                    </div>

                    <!-- Donut chart rendered here with the id "donut-example" -->
                    <div id="donut-example" style="height: 350px;"></div>
                </div>
            </div>
        </main>
    </div>

    <!-- Label for closing the mobile menu -->
    <label class="close-mobile-menu" for="menu-toggle"></label>

        <!-- Logout Confirmation Popup Container -->
        <div class="popup-container" id="logoutPopup">
            <div class="popup-content">
                <img src="../Images/lock.png" alt="Logo" class="logo-image">
                <h2>Logout Confirmation</h2>
                <p>Are you sure you want to logout?</p>
                <!-- Buttons for confirming or canceling logout -->
                <div class="button-container">
                    <button class="btn" onclick="confirmLogout()">YES</button>
                    <button class="btn closeBtn" onclick="closeLogoutPopup()">NO</button>
                </div>
            </div>
        </div>

    <!-- JavaScript libraries and custom script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="../JS/main.js"></script>
</body>
</html>