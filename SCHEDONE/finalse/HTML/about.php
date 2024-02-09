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
    <title>ScheDone - About Us</title>
    <!-- Add Favicon -->
    <link rel="icon" href="../Images/1.png" type="image/png">
    <!-- Include Line Awesome CSS library -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!-- Include Morris.js CSS library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- Include custom CSS file "about.css" -->
    <link rel="stylesheet" href="../CSS/about.css">
</head>

<body>
    <!-- Checkbox for mobile menu toggle -->
    <input type ="checkbox" id="menu-toggle">
    <!-- Sidebar navigation -->
    <div class="sidebar">
        <div class="brand">
            <!-- Logo and application name -->
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
                    <!-- Dashboard link -->
                    <a href="welcome.php">
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
                    <!-- About link (marked as active) -->
                    <a href="about.html"  class="active">
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

    <!-- Main content section -->
    <div class="main-content">
        <header>
            <!-- Label for mobile menu toggle -->
            <label for="menu-toggle" class="menu-toggler">
                <span class="las la-bars"></span>
            </label>
        </header>
    
    <!-- Header section containing the 'About Us' heading -->
    <div class="heading">
        <h1>About Us</h1>
        <!-- Introduction paragraph for the ScheDone task management system -->
        <p>Welcome to ScheDone, the cutting-edge task management system designed to streamline your workflow, enhance productivity, and simplify your life. 
            Our mission is to empower individuals and teams to achieve their goals with efficiency and precision.</p>
    </div>

    <!-- Main content container -->
    <div class="container">
        <section class="about">
            <!-- Container for images related to the about section -->
            <div class="about-image">
            <!-- Image related to the about section -->
            <img src="../images/Deadline.jpeg">
            <!-- Second image -->
            <img src="../images/Management.jpg">
            </div>

            <!-- Container for textual content related to the about section -->
            <div class="about-content">
                <!-- Heading for the 'About' section -->
                <h2>Stay on Track, Get Tasks Done!</h2>
                <!-- Overview of the SchedOne task management system -->
                <p>SchedOne: Student Task Management System is a comprehensive platform that enhances the organization of academic tasks. 
                    The About section aims to provide users with a clear understanding of the system's purpose and features, emphasizing how SchedOne empowers students to efficiently manage their academic responsibilities. 
                    It serves as a centralized hub for tracking tasks, assignment deadlines, and project timelines. The user-friendly interface, intuitive navigation, and customizable features cater to the unique needs of students. 
                    SchedOne not only ensures that students stay on top of assignments but also fosters collaboration by allowing them to share tasks and collaborate on projects seamlessly. With SchedOne, students can enjoy a more organized academic journey, focusing on studies and achieving success.</p>
                    <br>
                    <p>Developed with the individual needs of students at its core, SchedOne recognizes the complexities of managing assignments, exams, and deadlines. The platform offers a straightforward yet robust solution to help navigate these challenges and attain academic success.</p>
                    <br>
                    <p>Whether you're a high school student, college student, or engaged in further education, SchedOne is your dedicated companion. The user-friendly interface facilitates effortless creation, organization, and tracking of tasks. With SchedOne, you can navigate through your academic responsibilities seamlessly, ensuring you stay on top of your workload and never miss a deadline again.</p>
                
                    <!-- Link to read more about the team members -->
                <a href="members.php" class="read-more">Read More</a>
            </div>
            
        </section>
    </div>

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

          <!-- Label to close the mobile menu -->
        <label class="close-mobile-menu" for="menu-toggle"></label>

    <!-- Include JavaScript libraries and the main.js file -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="../JS/about.js"></script>
</body>
</html>