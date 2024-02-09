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

// Add click event listener to all elements with class 'members-box'
document.querySelectorAll('.members-box').forEach(function (box) {
    // Function to execute when a 'members-box' is clicked
    box.addEventListener('click', function () {
        // Get data attributes from the clicked box
        var info = box.getAttribute('data-info');
        var description = box.getAttribute('data-description');
        var imageSrc = box.querySelector('img').src;

        // Call function to open popup with extracted data
        openPopup(info, description, imageSrc);
    });
});

// Function to open the popup with given info, description, and image source
function openPopup(info, description, imageSrc) {
    // Update elements in the popup with provided data
    document.getElementById('popupTitle').innerHTML = info;
    document.getElementById('popupDescription').innerHTML = description;
    document.getElementById('popupImage').src = imageSrc;
    // Display the popup container
    document.getElementById('popupContainer').style.display = 'block';
}

// Function to close the popup
function closePopup() {
    document.getElementById('popupContainer').style.display = 'none';
}

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