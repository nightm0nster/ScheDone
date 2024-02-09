<?php
// Start the session
session_start();
$userid = $_SESSION['user_id'];
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
    <title>ScheDone - Task List</title>
    <!-- Add Favicon -->
    <link rel="icon" href="../Images/1.png" type="image/png">
    <!-- Include Line Awesome and Morris CSS styles -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- Include CSS file -->
    <link rel="stylesheet" href="../CSS/tasks.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- DataTables JavaScript -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>


</head>

<body>
    <!-- Checkbox for toggling the menu -->
    <input type="checkbox" id="menu-toggle">
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
                    <a href="../HTML/welcome.php">
                        <span class="las la-home"></span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <!-- Tasks link (marked as active) -->
                    <a href="tasks.php" class="active">
                        <span class="las la-check-circle"></span>
                        <span>Tasks</span>
                    </a>
                </li>

                <li>
                    <!-- About link -->
                    <a href="../HTML/about.php">
                        <span class="las la-envelope"></span>
                        <span>About</span>
                    </a>
                </li>

                <li>
                    <!-- Users link -->
                    <a href="users.php">
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

    <!-- Main content section -->
    <div class="main-content">
        <header>
            <!-- Label for the mobile menu toggle -->
            <label for="menu-toggle" class="menu-toggler">
                <span class="las la-bars"></span>
            </label>

            <!-- Search bar and icons in the header -->
            <div class="search">
                <!-- Form for searching tasks -->
                <form action="tasks.php" method="GET" id="searchForm">
                    <span class="las la-search"></span>
                    <input type="search" name="search" placeholder="Enter keyword">
                </form>
            </div>

            <!-- Icons for notifications, bookmarks, and comments -->
            <div class="head-icons">
                <span class="las la-pencil-alt" id="customizeButton"></span>
            </div>
        </header>

        <!-- Menu bar for tasks-related navigation -->
        <div class="menu-bar">
            <ul>
                <!-- Link to view the task list -->
                <li><a href="tasks.php">Task List</a></li>
                <!-- Link to add a new task -->
                <li><a href="#" id="addTaskBtn">Add Task</a></li>
            </ul>
        </div>

        <!-- Display a table for listing tasks -->
        <table>
            <tr>
                <!-- Table headers -->
                <th>Category</th>
                <th>Subject</th>
                <th>Task</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Priority Level</th>
                <th>Comments</th>
                <th>Actions</th>
            </tr>

            <?php
            // Connect to the database
            $conn = mysqli_connect('localhost', 'root', '', 'tasker');

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Retrieve tasks from the database and order by the selected sorting option
            $sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'deadline';

            $sql = "SELECT * FROM tasks WHERE user_id='$userid'";

            // Check if a search query is provided and add conditions to the SQL query
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $search = mysqli_real_escape_string($conn, $_GET['search']);
                $sql .= " WHERE 
                Category LIKE '%$search%' OR
                Subject LIKE '%$search%' OR
                Task LIKE '%$search%' OR
                Deadline LIKE '%$search%' OR
                Status LIKE '%$search%' OR
                Priority LIKE '%$search%'";
            }

            // Add sorting conditions to the SQL query based on the selected sorting option
            if ($sortOption === 'priority') {
                $sql .= " ORDER BY FIELD(Priority, 'Urgent', 'High Priority', 'Standard Priority', 'Low Priority')";
            } elseif ($sortOption === 'status') {
                $sql .= " ORDER BY FIELD(Status, 'Completed', 'In Progress', 'Not Started', 'Delayed')";
            } elseif ($sortOption === 'custom') {
                $sql .= " ORDER BY Deadline DESC";
            } else {
                $sql .= " ORDER BY Deadline ASC";
            }

            $result = mysqli_query($conn, $sql);

            // Loop through tasks and display them in the table
            while ($row = mysqli_fetch_assoc($result)) {
                // Displaying task details in each row
                echo "<tr>";
                echo "<td>" . $row['Category'] . "</td>";
                echo "<td>" . $row['Subject'] . "</td>";
                echo "<td>" . $row['Task'] . "</td>";
                echo "<td>" . $row['Deadline'] . "</td>";

                // Apply styles for the 'Status' column
                $statusColor = getStatusColor($row['Status']);
                echo "<td style='color: $statusColor;'><strong>" . $row['Status'] . "</strong></td>";

                // Apply styles for the 'Priority Level' column
                $priorityColor = getPriorityColor($row['Priority']);
                echo "<td style='color: $priorityColor;'><strong>" . $row['Priority'] . "</strong></td>";

                echo "<td>" . $row['Comments'] . "</td>";

                // Buttons for task actions (Edit and Delete)
                echo "<td><button class='action-button' onclick=\"openEditPopup(" . $row['ID'] . ")\">Edit</button> <a class='action-button' href='delete_task.php?id=" . $row['ID'] . "' onclick='return confirm(\"Are you sure you want to delete this task?\")'>Delete</a></td>";
                echo "</tr>";
            }

            // Function to get color for Status based on specified conditions
            function getStatusColor($status)
            {
                // Status color mapping
                switch ($status) {
                    case 'Not Started':
                        return 'blue';
                    case 'In Progress':
                        return 'yellow';
                    case 'Completed':
                        return 'green';
                    case 'Delayed':
                        return 'red';
                    default:
                        return ''; // Default color
                }
            }

            // Function to get color for Priority Level based on specified conditions
            function getPriorityColor($priority)
            {
                // Priority color mapping
                switch ($priority) {
                    case 'Standard Priority':
                        return 'blue';
                    case 'Low Priority':
                        return 'yellow';
                    case 'High Priority':
                        return 'green';
                    case 'Urgent':
                        return 'red';
                    default:
                        return ''; // Default color
                }
            }

            ?>
        </table>
    </div>

    <!-- Add Task Popup Container -->
    <div class="popup-container" id="addTaskPopup">
        <!-- Task Image -->
        <img src="../Images/board.png" alt="Task Image">
        <h2>Add New Task</h2>
        <!-- Form for adding a new task -->
        <form action="save_task.php" method="post">
            <label for="taskCategory">Category:</label>
            <input type="text" id="taskCategory" name="category" required><br><br>
            <label for="taskSubject">Subject:</label>
            <input type="text" id="taskSubject" name="subject" required><br><br>
            <!-- Textarea for task details -->
            <label for="taskDetails">Task:</label>
            <textarea id="taskDetails" name="task" required></textarea><br><br>
            <label for="taskDeadline">Deadline:</label>
            <input type="date" id="taskDeadline" name="deadline" required><br><br>
            <!-- Dropdown for task status -->
            <label for="taskStatus">Status:</label>
            <select id="taskStatus" name="status">
                <option value="">Select Status</option>
                <option value="Not Started">Not Started</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
                <option value="Delayed">Delayed</option>
            </select><br><br>
            <!-- Dropdown for priority level -->
            <label for="taskPriority">Priority Level:</label>
            <select id="taskPriority" name="priority">
                <option value="">Select Priority Level</option>
                <option value="Low Priority">Low Priority</option>
                <option value="Standard Priority">Standard Priority</option>
                <option value="High Priority">High Priority</option>
                <option value="Urgent">Urgent</option>
            </select><br><br>
            <!-- Textarea for comments -->
            <label for="taskComments">Comments:</label>
            <textarea id="taskComments" name="comments"></textarea><br><br>
            <!-- Submit and close buttons -->
            <input type="submit" value="Add Task" class="btn">
            <button type="button" onclick="closePopup()" class="btn closeBtn">Close</button>
        </form>
    </div>

    <!-- Edit Task Popup Container -->
    <div class="popup-container" id="editTaskPopup">
        <!-- Task Image -->
        <img src="../Images/board.png" alt="Task Image">
        <h2>Edit Task</h2>
        <!-- Form for editing an existing task -->
        <form id="editTaskForm" action="update_task.php" method="post">
            <!-- Fields for editing task details -->
            <label for="editCategory">Category:</label>
            <input type="text" id="editCategory" name="category" required><br><br>
            <label for="editSubject">Subject:</label>
            <input type="text" id="editSubject" name="subject" required><br><br>
            <label for="editTask">Task:</label>
            <textarea id="editTask" name="task" required></textarea><br><br>
            <label for="editDeadline">Deadline:</label>
            <input type="date" id="editDeadline" name="deadline" required><br><br>
            <label for="editStatus">Status:</label>
            <!-- Dropdown for editing task status -->
            <select id="editStatus" name="status">
                <option value="">Select Status</option>
                <option value="Not Started">Not Started</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
                <option value="Delayed">Delayed</option>
            </select><br><br>
            <label for="editPriority">Priority Level:</label>
            <!-- Dropdown for editing priority level -->
            <select id="editPriority" name="priority">
                <option value="">Select Priority Level</option>
                <option value="Low Priority">Low Priority</option>
                <option value="Standard Priority">Standard Priority</option>
                <option value="High Priority">High Priority</option>
                <option value="Urgent">Urgent</option>
            </select><br><br>
            <label for="editComments">Comments:</label>
            <!-- Textarea for editing comments -->
            <textarea id="editComments" name="comments"></textarea><br><br>
            <input type="hidden" id="editTaskId" name="id" value="">
            <!-- Submit and close buttons -->
            <input type="submit" value="Update Task" class="btn">
            <button type="button" onclick="closeEditPopup()" class="btn closeBtn">Close</button>
        </form>
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

    <!-- Customization Popup Container -->
    <div class="popup-container" id="customizePopup">
        <div class="popup-header" id="customizeHeader">
            <h2>Customization</h2>
        </div>

        <!-- FORM FOR EDITING PREFERENCES -->
        <form id="formCustomize" method="POST" action="preferences.php">
            <div class="popup-content">
                <!-- Font Size Selection -->
                <div class="font-size">
                    <label for="fontSize">Font Size:</label>
                    <input type="number" id="fontSize" name="fontSize" min="10" max="24" step="1">
                </div>
                <!-- Font Style Selection -->
                <div class="font-style">
                    <label for="fontStyle">Font Style:</label>
                    <select id="fontStyle" name="fontStyle">
                        <option value="" selected disabled>Select Font Styles</option>
                        <option value="normal">Normal</option>
                        <option value="italic">Italic</option>
                        <option value="bold">Bold</option>
                        <option value="italic bold">Italic Bold</option>
                        <option value="underline">Underline</option>
                        <option value="italic underline">Italic Underline</option>
                        <option value="bold underline">Bold Underline</option>
                        <option value="italic bold underline">Italic Bold Underline</option>
                    </select>
                </div>
                <!-- Font Family Selection -->
                <div class="font-family">
                    <label for="fontFamily">Font Family:</label>
                    <select id="fontFamily" name="fontFamily">
                        <option value="" selected disabled>Select Font Family</option>
                        <option value="Arial">Arial</option>
                        <option value="Helvetica">Helvetica</option>
                        <option value="Times New Roman">Times New Roman</option>
                        <option value="Courier New">Courier New</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Verdana">Verdana</option>
                        <option value="Tahoma">Tahoma</option>
                        <option value="Impact">Impact</option>
                        <option value="Arial Black">Arial Black</option>
                        <option value="Comic Sans MS">Comic Sans MS</option>
                        <!-- Add more font options as needed -->
                    </select>
                </div>
                <!-- Sorting Selection -->
                <div class="sorting-options">
                    <label for="sort">Sort By:</label>
                    <select id="sort" name="sort">
                        <option value="" selected disabled>Select Sorting Option</option>
                        <option value="deadline">Deadline</option>
                        <option value="priority">Priority Level</option>
                        <option value="status">Status</option>
                    </select>
                </div>
                <!-- Color Selection -->
                <div class="color-coding">
                    <label for="colorCoding">Color Coding:</label>
                    <input type="color" id="colorCoding" name="colorCoding" value="#ffffff">
                </div>
                <!-- Apply, Reset, and Close buttons -->
                <!-- <div>
                    <button id="applybtn" onclick="applyCustomization()">Apply</button>
                    <button type="button" onclick="resetCustomization()">Reset</button>
                    <button class="btn closeBtn" onclick="closeCustomizationPopup()">Close</button>
                </div> -->
                <div>
                    <button id="applybtn" type="submit" name="action" value="apply">Apply</button>
                    <button type="submit" name="action" value="reset">Reset</button>
                    <button type="button" id="closebtn" class="btn closeBtn">Close</button>
                </div>
        </form>

        <!-- Label for closing the mobile menu when toggled -->
        <label class="close-mobile-menu" for="menu-toggle"></label>


        <!-- Script section for handling JavaScript functionality -->
        <script>
            // Function to open the add task popup
            function openPopup() {
                document.getElementById('addTaskPopup').style.display = 'block';
            }

            // Function to close the add task popup
            function closePopup() {
                document.getElementById('addTaskPopup').style.display = 'none';
            }

            // Event listener for opening the add task popup
            document.getElementById('addTaskBtn').addEventListener('click', openPopup);

            // Function to open the edit task popup
            function openEditPopup(taskId) {
                // Set the task ID in the hidden input field
                document.getElementById('editTaskId').value = taskId;

                // Fetch task details based on taskId
                fetch('edit_task.php?id=' + taskId)
                    .then(response => response.json())
                    .then(data => {
                        // Populate the form fields with fetched data
                        document.getElementById('editCategory').value = data.Category;
                        document.getElementById('editSubject').value = data.Subject;
                        document.getElementById('editTask').value = data.Task;
                        document.getElementById('editDeadline').value = data.Deadline;
                        document.getElementById('editStatus').value = data.Status;
                        document.getElementById('editPriority').value = data.Priority;
                        document.getElementById('editComments').value = data.Comments;
                    })
                    .catch(error => console.error('Error fetching task details:', error));

                // Open the edit task popup
                document.getElementById('editTaskPopup').style.display = 'block';
            }

            // Function to close the edit task popup
            function closeEditPopup() {
                document.getElementById('editTaskPopup').style.display = 'none';
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
                window.location.href = 'home.html';
            }

            // Function to open the customization popup
            function openCustomizationPopup() {
                document.getElementById('customizePopup').style.display = 'block';
            }

            // // Function to close the customization popup
            // function closeCustomizationPopup() {
            //     document.getElementById('customizePopup').style.display = 'none';
            // }
            var customPopup = document.getElementById('customizePopup');
            var closeBtn = document.getElementById('closebtn');
            closeBtn.addEventListener('click', function() {
                customPopup.style.display = 'none';
            });



            // Event listener for opening the customization popup
            document.getElementById('customizeButton').addEventListener('click', openCustomizationPopup);


            // //Function to apply customization
            // function applyCustomization() {
            //     // updateSort();
            //     const fontSize = document.getElementById('fontSize').value + 'px';
            //     const fontStyle = document.getElementById('fontStyle').value;
            //     const fontFamily = document.getElementById('fontFamily').value;
            //     const colorCoding = document.getElementById('colorCoding').value;

            //     // Get all cells except the last column (actions column)
            //     const allCellsExceptActions = document.querySelectorAll('table td:not(:last-child):not(:nth-child(5)):not(:nth-child(6))');

            //     // Apply font size, style, and family to all cells except the last column
            //     allCellsExceptActions.forEach(cell => {
            //         cell.style.fontSize = fontSize;
            //         cell.style.fontStyle = fontStyle.includes('italic') ? 'italic' : 'normal';
            //         cell.style.fontWeight = fontStyle.includes('bold') ? 'bold' : 'normal';
            //         cell.style.textDecoration = fontStyle.includes('underline') ? 'underline' : 'none';
            //         cell.style.fontFamily = fontFamily;
            //         cell.style.color = colorCoding;
            //     });

            //     // Apply changes to the table or other elements as needed
            //     const table = document.querySelector('table');
            //     table.style.fontSize = fontSize;
            //     table.style.color = colorCoding;

            // }

            // document.addEventListener('DOMContentLoaded', function() {
            $(document).ready(function() {
                // AJAX request to fetch preferences
                $.ajax({
                    url: 'get_preferences.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Process the retrieved data
                        console.log(data);
                        //SORTING NAMAN
                        const sortOption = data[0].sort;
                        updateSort(sortOption);

                        const allCellsExceptActions = document.querySelectorAll('table td:not(:last-child):not(:nth-child(5)):not(:nth-child(6))');
                        // Apply font size, style, and family to all cells except the last column
                        allCellsExceptActions.forEach(cell => {
                            cell.style.fontSize = data[0].font_size + 'px';
                            cell.style.fontStyle = data[0].font_style;
                            // cell.style.fontWeight = data[0].font_type;
                            // cell.style.textDecoration = = data[0].font;
                            cell.style.fontFamily = data[0].font_family;
                            cell.style.color = data[0].colors;
                        });
                        // Apply changes to the table or other elements as needed
                        const table = document.querySelector('table');
                        table.style.fontSize = data[0].font_size + 'px';
                        table.style.color = data[0].colors;
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error('Error fetching preferences:', status, error);
                    }
                });
            });
            // });



            const originalStyles = [];

            document.addEventListener('DOMContentLoaded', function() {
                // Get all cells except the last column (actions column)
                const allCellsExceptActions = document.querySelectorAll('table td:not(:last-child)');

                // Store original styles
                allCellsExceptActions.forEach(cell => {
                    originalStyles.push({
                        fontSize: cell.style.fontSize,
                        fontStyle: cell.style.fontStyle,
                        fontWeight: cell.style.fontWeight,
                        textDecoration: cell.style.textDecoration,
                        fontFamily: cell.style.fontFamily,
                        color: cell.style.color
                    });
                });
            });

            // Function to reset customization values
            // function resetCustomization() {
            //     // Selecting all cells in the table except the last child, 5th child, and 6th child
            //     const allCellsExceptActions = document.querySelectorAll('table td:not(:last-child):not(:nth-child(5)):not(:nth-child(6))');

            //     // Reset styles to original values
            //     allCellsExceptActions.forEach((cell, index) => {
            //         const originalStyle = originalStyles[index];
            //         cell.style.fontSize = originalStyle.fontSize;
            //         cell.style.fontStyle = originalStyle.fontStyle;
            //         cell.style.fontWeight = originalStyle.fontWeight;
            //         cell.style.textDecoration = originalStyle.textDecoration;
            //         cell.style.fontFamily = originalStyle.fontFamily;
            //         cell.style.color = '#ffffff'; // Reset font color to white
            //     });

            //     // Reset other customization values
            //     document.getElementById('fontSize').value = '14';
            //     document.getElementById('fontStyle').value = 'normal';
            //     document.getElementById('fontFamily').value = 'Arial';
            //     document.getElementById('colorCoding').value = '#ffffff';
            // }

            // function resetCustomization(){

            // }

            // let reloadOnce = false;
            // Function to be called when the sorting option changes
            function updateSort(sortOption) {
                const newUrl = `tasks.php?sort=${sortOption}`;
                // window.location.href = `tasks.php?sort=${sortOption}`;
                window.history.pushState({}, '', newUrl);
                // if (reloadOnce = false) {
                //     window.location.reload();
                //     reloadOnce = true;
                // }
            }


            // Event listener for changes in the sorting option
            // document.getElementById('sort').addEventListener('change', updateSort);

            // Function to make popups draggable
            function makeDraggable(popup) {
                let offsetX, offsetY, isDragging = false;

                popup.addEventListener('mousedown', function(e) {
                    const isFormElement = ['INPUT', 'TEXTAREA', 'SELECT', 'BUTTON'].includes(e.target.tagName);

                    if (!isFormElement) {
                        isDragging = true;
                        offsetX = e.clientX - popup.getBoundingClientRect().left;
                        offsetY = e.clientY - popup.getBoundingClientRect().top;
                    }
                });

                document.addEventListener('mousemove', function(e) {
                    if (isDragging) {
                        const newX = e.clientX - offsetX;
                        const newY = e.clientY - offsetY;

                        requestAnimationFrame(function() {
                            popup.style.left = newX + 'px';
                            popup.style.top = newY + 'px';
                        });
                    }
                });

                document.addEventListener('mouseup', function() {
                    isDragging = false;
                });
            }

            // Call the makeDraggable function for popups
            makeDraggable(document.getElementById('addTaskPopup'));
            makeDraggable(document.getElementById('editTaskPopup'));
            makeDraggable(document.getElementById('logoutPopup'));
            makeDraggable(document.getElementById('customizePopup'));
        </script>

        <!-- Include jQuery and Morris JS libraries, and custom JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
        <script src="../JS/tasks.js"></script>
</body>

</html>