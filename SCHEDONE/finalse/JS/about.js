$(document).ready(function() {
    // Make an AJAX request to fetch the username
    $.ajax({
        url: '../COMPONENTS/get_username.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Check if the response contains an error
            if (response.error) {
                console.error('Error:', response.error);
            } else {
                // Update the username in the dashboard menu
                $('#userName').text(response.username);
            }
        },
        error: function(error) {
            console.error('Error fetching username:', error);
        }
    });
});

// Function to open the logout confirmation popup
  function openLogoutPopup() {
    document.getElementById('logoutPopup').style.display = 'block';
}

// Function to close the logout confirmation popup
function closeLogoutPopup() {
    document.getElementById('logoutPopup').style.display = 'none';
}

// Function to confirm logout and redirect to home.html
function confirmLogout() {
    window.location.href = '../index.html';
}