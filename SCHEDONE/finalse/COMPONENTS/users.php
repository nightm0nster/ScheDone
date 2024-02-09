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
    <title>ScheDone - User Information</title>
    <!-- Add Favicon -->
    <link rel="icon" href="../Images/1.png" type="image/png">
    <!-- Include Line Awesome icons stylesheet -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!-- Include Morris.js stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- Include custom CSS stylesheet -->
    <link rel="stylesheet" href="../CSS/users.css">
</head>

<body>
    <!-- Input checkbox for mobile menu toggle -->
    <input type ="checkbox" id="menu-toggle">
    <!-- Sidebar container -->
    <div class="sidebar">
        <!-- Brand and logo -->
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
                    <p><span id=userName></span></p>
                </div>
            </div>

            <!-- Navigation links in the sidebar -->
            <ul>
                <li>
                    <!-- Dashboard link -->
                    <a href="../HTML/welcome.php">
                        <span class="las la-home"></span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <!-- Tasks link -->
                    <a href="tasks.php">
                        <span class="las la-check-circle"></span>
                        <span>Tasks</span>
                    </a>
                <li>
                    <!-- About link -->
                    <a href="../HTML/about.php">
                        <span class="las la-envelope"></span>
                        <span>About</span>
                    </a>
                </li>

                <li>
                    <!-- Users link (marked as active) -->
                    <a href="users.php" class="active">
                        <span class="las la-user"></span>
                        <span>User Information</span>
                    </a>
                </li>

                <li>
                    <!-- Help link -->
                    <a href="../HTML/help.php">
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

    <!-- Main content container -->
    <div class="main-content">
        <header>
             <!-- Mobile menu toggle button -->
            <label for="menu-toggle" class="menu-toggler">
                <span class="las la-bars"></span>
            </label>
        </header>

        <!-- User profile section -->
        <div class="profile-section">
            <div class="profile-header">
            <div id="preview-image" class="profile-image-placeholder" style="background-image: url('<?php echo isset($_SESSION['profile_pic']) ? "../profile_pics/" . $_SESSION['profile_pic'] : "../Images/default1.jpg"; ?>')"></div>
            </div>
            <div class="profile-info">
                <small class="user-type">Student</small>
                <p id="user-name-placeholder">Username</p>
            </div>
            <hr class="separator">
        </div>

    <!-- User information section -->
<div class="user-information-section">
    <h2>User Information</h2>
    <form id="profile-form">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="John Doe" readonly>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="john_doe123" readonly>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="john.doe@example.com" readonly>

        <label for="contact-number">Contact Number</label>
        <input type="tel" id="contact-number" name="contact-number" placeholder="+1 123-456-7890" readonly>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="********">

        <button type="button" class="edit-information-btn" onclick="openEditInfoPopup()">Edit Information</button>
    </form>
</div>

    <!-- Edit Information Popup Container -->
    <div class="popup-container" id="editInfoPopup">
        <div class="popup-content">
            <h2>Edit User Information</h2>
            
            <!-- User profile section -->
            <div class="profile-section">
                <div class="profile-header">
                    <div id="preview-image" class="profile-image-placeholder" style="background-image: url('<?php echo isset($_SESSION['profile_pic']) ? "../profile_pics/" . $_SESSION['profile_pic'] : "../Images/default1.jpg"; ?>')"></div>
                </div>
                <div class="profile-info">
                <small class="user-type">Student</small>
                <p id="user-name-profile">Username</p>
            </div>

                <hr class="separator">
            </div>

            <!-- Form to display user information in the popup -->
            <h2>User Information</h2>
            <form id="editInfoForm" enctype="multipart/form-data">

                <!-- Add the input field for uploading a profile picture -->
                <label for="profile-pic-upload">Upload Profile Picture</label>
                <input type="file" id="profile-pic-upload" accept="image/*">

                <label for="editName">Name</label>
                <input type="text" id="editName" name="editName" placeholder="John Doe">

                <label for="editUsername">Username</label>
                <input type="text" id="editUsername" name="editUsername" placeholder="john_doe123">

                <label for="editEmail">Email</label>
                <input type="email" id="editEmail" name="editEmail" placeholder="john.doe@example.com">

                <label for="editContactNumber">Contact Number</label>
                <input type="tel" id="editContactNumber" name="editContactNumber" placeholder="+1 123-456-7890">

                <label for="editPassword">Password</label>
                <input type="password" id="editPassword" name="editPassword" placeholder="********">

                <!-- Save and Close buttons -->
                <button type="button" class="btn save-btn" onclick="saveAndClose()">Save</button>
                <button type="button" class="btn close-btn" onclick="closeEditInfoPopup()">Close</button>
            </form>
        </div>
    </div>

    <!-- Label to close the mobile menu -->
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

<!-- Script to handle profile picture upload -->
<script>

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('profile-pic-upload').addEventListener('change', uploadProfilePicture);
});

// Function to handle profile picture upload
function uploadProfilePicture() {
    var fileInput = document.getElementById('profile-pic-upload');
    var file = fileInput.files[0];
    
    var formData = new FormData();
    formData.append('profile-pic', file);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'upload_profile_pic.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                // If upload is successful, update the preview image
                var previewImage = document.querySelector('.profile-image-placeholder');
                previewImage.style.backgroundImage = 'url(' + response.newImagePath + ')';

                // Update all occurrences of default1.jpg to the new image path
                var defaultImages = document.querySelectorAll('[style*="default1.jpg"]');
                defaultImages.forEach(function (element) {
                element.style.backgroundImage = 'url(' + response.newImagePath + ')';
                });        
            } else {
                // If upload failed, display an error message
                alert('Error: ' + response.message);
            }
        }
    };
    xhr.send(formData);
}

</script>

<!-- Mobile menu close button -->
<label class="close-mobile-menu" for="menu-toggle"></label>

    <script>
    // Function to open the Edit Information popup
    function openEditInfoPopup() {
        // Populate the form fields with the current user information
        document.getElementById('editName').value = "<?php echo $_SESSION['name']; ?>";
        document.getElementById('editUsername').value = "<?php echo $_SESSION['username']; ?>";
        document.getElementById('editEmail').value = "<?php echo $_SESSION['email']; ?>";
        document.getElementById('editContactNumber').value = "<?php echo $_SESSION['contact']; ?>";

        // Display the username in the designated placeholder for the edit popup
        document.getElementById('user-name-profile').innerText = "<?php echo $_SESSION['username']; ?>";
        
        // Display the Edit Information popup
        document.getElementById('editInfoPopup').style.display = 'block';
    }

    // Function to close the Edit Information popup
    function closeEditInfoPopup() {
        // Hide the Edit Information popup
        document.getElementById('editInfoPopup').style.display = 'none';
    }

        // Function to save changes and close the Edit Information popup
    function saveAndClose() {
    // Retrieve the edited information from the form
    var newName = document.getElementById('editName').value;
    var newUsername = document.getElementById('editUsername').value;
    var newEmail = document.getElementById('editEmail').value;
    var newContactNumber = document.getElementById('editContactNumber').value;
    var newPassword = document.getElementById('editPassword').value; // Assuming you also want to update the password
    var profilePicFile = document.getElementById('profile-pic-upload').files[0]; // Get the profile picture file

    // Create a FormData object to send the form data including the profile picture
    var formData = new FormData();
    formData.append('name', newName);
    formData.append('username', newUsername);
    formData.append('email', newEmail);
    formData.append('contact', newContactNumber);
    formData.append('password', newPassword);
    formData.append('profile-pic', profilePicFile);

    // Make an AJAX request to update the database
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_user.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Parse the response from the server
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                // If the update was successful, update the displayed information
                document.getElementById('name').value = newName;
                document.getElementById('username').value = newUsername;
                document.getElementById('email').value = newEmail;
                document.getElementById('contact-number').value = newContactNumber;

                // Update the profile picture preview
                var previewImage = document.querySelector('.profile-image-placeholder');
                previewImage.style.backgroundImage = 'url(' + response.newImagePath + ')';

                // Close the Edit Information popup
                closeEditInfoPopup();

                // Show the success alert
                alert("Changes have been successfully updated.");

                // Reload the page after a short delay
                setTimeout(function () {
                    window.location.reload();
                }, 1000); // Adjust the delay time as needed
            } else {
                // If the update failed, display an error message
                alert("Failed to update user information: " + response.message);
            }
        }
    };

    // Send the request with the form data
    xhr.send(formData);
    }

            // Function to populate the form fields with user information
    function populateUserInfo() {
        // Retrieve user information from session variables
        var name = "<?php echo $_SESSION['name']; ?>";
        var username = "<?php echo $_SESSION['username']; ?>";
        var email = "<?php echo $_SESSION['email']; ?>";
        var contact = "<?php echo $_SESSION['contact']; ?>";
        var profilePic = "<?php echo isset($_SESSION['profile_pic']) ? $_SESSION['profile_pic'] : 'default1.jpg'; ?>";

        // Populate the input fields with user information
        document.getElementById('name').value = name;
        document.getElementById('username').value = username;
        document.getElementById('email').value = email;
        document.getElementById('contact-number').value = contact;
        
         // Update the profile picture preview
        var previewImage = document.getElementById('preview-image');
            if (profilePic) {
                previewImage.style.backgroundImage = 'url("../profile_pics/' + profilePic + '")';
            } else {
        // If the profile picture is default, set the background to default1.jpg
        previewImage.style.backgroundImage = 'url("../Images/default1.jpg")';
        }

        // Display the username in the designated placeholder
        document.getElementById('user-name-placeholder').innerText = username;
    }

    // Call the function to populate user information when the page loads
    window.onload = function() {
        populateUserInfo();
    };

    </script>

    <!-- Include jQuery and Morris.js JavaScript libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="../JS/users.js"></script>
</body>
</html>