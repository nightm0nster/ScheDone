// JavaScript code for earning points, resetting points, and unlocking rewards

let points = 0;
let notificationCount = 0; 
const pointCount = document.getElementById('pointCount');
const rewardStatus = document.getElementById('rewardStatus');

// Get references to the overlay and modal elements
const overlay = document.getElementById('overlay');
const modal = document.getElementById('modal');

// Get a reference to the notification bell
const notificationBell = document.getElementById('notificationBell');
const notificationCountElement = document.getElementById('notificationCount'); 
const notificationList = document.getElementById('notificationList'); 

// Add click event listener to the notification bell
notificationBell.addEventListener('click', function() {
    // Show the overlay and modal
    overlay.style.display = 'block';
    modal.style.display = 'block';

    // Reset notification count when bell icon is clicked
    notificationCount = 0;
    updateNotificationCount();
});

// Add click event listener to the close button inside the modal
document.getElementById('close-modal').addEventListener('click', function() {
    // Hide the overlay and modal
    overlay.style.display = 'none';
    modal.style.display = 'none';
});

// Define reward thresholds and status
const rewardThresholds = [50, 100, 150, 200, 250]; 
const rewardStatuses = ["Task Smasher", "Task Obliterator", "Task Master", "Task Challenger", "Task Radiant"]; 
let rewardUnlocked = new Array(rewardThresholds.length).fill(false);

function earnPoints(amount) {
    points += amount;
    pointCount.textContent = points;

    // Check if rewards should be unlocked
    for (let i = 0; i < rewardThresholds.length; i++) {
        if (points >= rewardThresholds[i] && !rewardUnlocked[i]) {
            unlockReward(i);
        }
    }
}

// Function to reset points to zero
function resetPoints() {
    points = 0;
    pointCount.textContent = points;
    resetReward();
}

// Array of paths to reward images
const rewardImagesPaths = [
  '../Images/medal2.gif',
  '../Images/medal2.gif',
  '../Images/medal2.gif',
  '../Images/medal2.gif',
  '../Images/medal2.gif'
];

function unlockReward(index) {
    rewardUnlocked[index] = true;
    rewardStatus.textContent = rewardStatuses[index];

    // Increment notification count when a reward is unlocked
    notificationCount++;
    updateNotificationCount();

    // Add image to Card 2
    const rewardImages = document.getElementById('rewardImages');
    const rewardImage = document.createElement('div');
    rewardImage.classList.add('reward-image');
    rewardImage.style.backgroundImage = `url(${rewardImagesPaths[index]})`; // Use the image path corresponding to the unlocked reward
    rewardImages.appendChild(rewardImage);

     // Add notification to the notification list
     const notificationItem = document.createElement('li');
     notificationItem.classList.add('notification-item');
     notificationItem.innerHTML = `<h4>Reward Unlocked <span class="las la-medal"></span></h4><p>${rewardStatuses[index]} has been unlocked!</p>`;
     notificationList.appendChild(notificationItem);
}

function resetReward(){
  rewardUnlocked = new Array(rewardThresholds.length).fill(false);
  rewardStatus.textContent = "Reward Locked";

  // Remove all reward images from Card 2
  const rewardImages = document.getElementById('rewardImages');
  rewardImages.innerHTML = '';

 // Clear the notification list
 notificationList.innerHTML = '';
}

// Function to update the notification count display
function updateNotificationCount() {
    notificationCountElement.textContent = notificationCount;
    notificationCountElement.style.color = 'red';
}

// Function to list notifications
function listNotifications(item) {
  /*const listItem = document.createElement('li');
  listItem.textContent = notification;*/
  notificationList.appendChild(item);
}

// Function to list task deadlines
function listTaskDeadlines(taskName, daysLeft) {
    const notificationItem = document.createElement('li');
    notificationItem.classList.add('notification-item');
    notificationItem.innerHTML = `<h4>Task Deadline <span class="las la-clock"></span></h4><p>${taskName} - ${daysLeft} days left</p>`;
    listNotifications(notificationItem);
}

//Fetch number of tasks
var numTasks;

$.ajax({
    type: "GET",
    url: '../COMPONENTS/num_tasks.php',
    success: function(response) {
      // Parse the response data
      const responseData = JSON.parse(response);

      // Extract data for the line graph and the donut chart
      const lineData = responseData.lineData;
      const donutData = responseData.donutData;

        // Create a new Morris Line Chart
        new Morris.Line({
            // ID of the HTML element in which to draw the chart.
            element: 'myfirstchart',

            // Line color for the chart.
            lineColors: ['orange'],

            // Chart data records, each entry corresponds to a point on the chart.
            data: lineData,
            
            // The name of the data record attribute that contains x-values.
            xkey: 'month',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['value'],
            // Labels for the ykeys -- will be displayed when you hover over the chart.
            labels: ['Value']
        });

        // Create a new Morris Donut Chart
        Morris.Donut({
            element: 'donut-example',
            data: donutData,
            // Colors for different sections of the donut chart.
            colors: ['green', '#f42a26', 'orange', '#0072f2'],
            // Label color for the donut chart.
            labelColor: '#ffffff'
        });
    },

    error: function() {
        console.error("Error fetching number of tasks");
    }
});

// Fetch number of completed tasks
$.ajax({
  type: "GET",
  url: '../COMPONENTS/completed_tasks.php', // Change the URL to the endpoint that fetches completed tasks
  success: function(response) {
        const completedTasks = parseInt(response);
        earnPoints(completedTasks * 10); // Earn 10 points for each completed task
  },
  error: function() {
        console.error("Error fetching number of completed tasks");
  }
});

// Function to check task deadlines and notify the user
function checkTaskDeadlines() {
    // Perform an AJAX request to fetch the list of tasks and their deadlines
    $.ajax({
        type: "GET",
        url: '../COMPONENTS/task_deadlines.php', // Replace "task_deadlines.php" with the URL of your endpoint
        success: function(response) {
            const tasks = JSON.parse(response);

            // Get the current date and time
            const currentDate = new Date();

            // Iterate over the tasks to check their deadlines
            tasks.forEach(task => {
                const deadline = new Date(task.deadline);

                // Calculate the difference between the current date and the deadline
                const timeDifference = deadline.getTime() - currentDate.getTime();
                const daysDifference = Math.ceil(timeDifference / (1000 * 3600 * 24));

                // If the deadline is within 3 days, notify the user
                if (daysDifference <= 3 && daysDifference > 0) {
            
                    // List the deadline in the notification list
                    listTaskDeadlines(task.task, daysDifference);

                    // Increment notification count
                    notificationCount++;
                    updateNotificationCount();
                }
            });
        },
        error: function() {
            console.error("Error fetching task deadlines");
        }
    });
}

// Call the checkTaskDeadlines function every hour (3600000 milliseconds)
setInterval(checkTaskDeadlines, 3600000); // Adjust the interval as needed

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

// Fetch number of completed tasks for progress bar
$.ajax({
    type: "GET",
    url: '../COMPONENTS/completed_tasks.php', // Change the URL to the endpoint that fetches completed tasks
    success: function(response) {
        const completedTasks = parseInt(response);
        updateProgressBar(completedTasks);
    },
    error: function() {
        console.error("Error fetching number of completed tasks");
    }
});

function updateProgressBar(completedTasks) {
    // Define the total tasks required to reach the next level
    const tasksPerLevel = 5; // Adjust this value according to your preference

    // Calculate the user's level based on the number of completed tasks
    const userLevel = Math.floor(completedTasks / tasksPerLevel) + 1;

    // Display the user's level
    const userLevelElement = document.getElementById('userLevel');
    userLevelElement.textContent = userLevel;
    
    // Calculate the total tasks required for the current level
    const totalTasksForCurrentLevel = tasksPerLevel * userLevel;

    // Calculate the total tasks required to reach the previous level
    const totalTasksForPreviousLevels = tasksPerLevel * (userLevel - 1);

    // Calculate the number of tasks completed in the current level
    const tasksCompletedInCurrentLevel = completedTasks - totalTasksForPreviousLevels;

    // Calculate the percentage progress for the current level
    let percentComplete = (tasksCompletedInCurrentLevel / tasksPerLevel) * 100;

    // Assuming totalTasks is the total number of tasks required to fill the progress bar completely for each level
    const progressBar = document.querySelector('.progress');

    progressBar.style.width = percentComplete + '%';
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