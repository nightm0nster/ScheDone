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
    <title>ScheDone - Help</title>
    <!-- Add Favicon -->
    <link rel="icon" href="../Images/1.png" type="image/png">
    <!-- Link to Line Awesome icons library -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!-- Link to Morris CSS library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- Link to a custom stylesheet (help.css) -->
    <link rel="stylesheet" href="../CSS/help.css">
</head>

<body>
    <!-- Checkbox for mobile menu toggle -->
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
                    <!-- Help link (marked as active) -->
                    <a href="help.html" class="active">
                        <span class="las la-hands-helping"></span>
                        <span>Help</span>
                    </a>
                </li>

                <li>
                   <!-- Logout link with onClick event -->
                    <a href="#" onclick="showPopup('logoutPopup')">
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
        </header>

         <!-- Card content -->
        <main>
          <div class="cards">
            <!-- Overview and Introduction Card -->
            <div class="card" onclick="showPopup('overviewPopup')">
                <div class="card-icon follow">
                    <span class="las la-headset"></span>
                </div>
                <div class="card-info">
                    <h1>Overview and Introduction</h1>
                    <small>Welcome to our Customer Support Chatbot! Our chatbot is here to help you quickly find answers to common questions and resolve issues without waiting for a support agent.</small>
                </div>
            </div>
    
            <!-- Getting Started Card -->
            <div class="card" onclick="showPopup('gettingStartedPopup')">
                <div class="card-icon likes">
                    <span class="las la-play-circle"></span>
                </div>
                <div class="card-info">
                    <h1>Getting Started</h1>
                    <small>To access the chatbot, click on the message button on the bottom right to start a conversation with the chatbot. Use simple phrases or keywords to ask questions.</small>
                </div>
            </div>
    
            <!-- Chatbot Capabilities Card -->
            <div class="card" onclick="showPopup('capabilitiesPopup')">
                <div class="card-icon follow">
                    <span class="lab la-rocketchat"></span>
                </div>
                <div class="card-info">
                    <h1>Chatbot Capabilities</h1>
                    <small>Frequently Asked Questions: The chatbot can answer common FAQs related to ScheDone system. It gives information about the functionalities of the system and how it works.</small>
                </div>
            </div>
    
            <!-- Best Practices and Tips Card -->
            <div class="card" onclick="showPopup('bestPracticesPopup')">
                <div class="card-icon comment">
                    <span class="lab la-gratipay"></span>
                </div>
                <div class="card-info">
                    <h1>Best Practices and Tips</h1>
                    <small>Be Specific: Provide specific details when asking a question to receive more accurate answers. Include relevant information when discussing an ongoing issue for better support.</small>
                </div>
            </div>
    
            <!-- Contact Human Support Card -->
            <div class="card" onclick="showPopup('contactSupportPopup')">
                <div class="card-icon likes">
                    <span class="las la-user"></span>
                </div>
                <div class="card-info">
                    <h1>Contact Human Support</h1>
                    <small>If the chatbot cannot assist you or you prefer to talk to a human agent. Contact us through this number: +123-456-7890.</small>
                </div>
            </div>
    
            <!-- Feedbacks and Suggestions Card -->
            <div class="card" onclick="showPopup('feedbacksPopup')">
                <div class="card-icon comment">
                    <span class="las la-comment-dots"></span>
                </div>
                <div class="card-info">
                    <h1>Feedbacks and Suggestions</h1>
                    <small>We value your feedback! Let us know about your chatbot experience and any suggestions for improvement.</small>
                </div>
            </div>
        </div>
    
        <!-- Popup containers for each card -->
        <!-- Overview and Introduction Popup -->
        <div class="popup-container" id="overviewPopup">
          <span class="las la-headset"></span>
            <div class="popup-content">
                <div class="close-button" onclick="closePopup('overviewPopup')">&times;</div> 
                <h2>Overview and Introduction</h2>
                <p>Greetings from SCHEDONE! Our Customer Support Chatbot is your dedicated assistant, available around the clock to streamline your experience on our student task management platform. 
                  No more waiting for support agents – the chatbot is here to provide instant solutions. Whether you're curious about SCHEDONE's features or facing a technical hiccup, the chatbot is your first line of assistance. 
                  Let us make your journey with SCHEDONE smoother and more efficient.</p>
            </div>
        </div>
    
        <!-- Getting Started Popup -->
        <div class="popup-container" id="gettingStartedPopup">
          <span class="las la-play-circle"></span>
            <div class="popup-content">
                <div class="close-button" onclick="closePopup('gettingStartedPopup')">&times;</div>
                <h2>Getting Started</h2>
                <p>Embarking on your SCHEDONE journey is as easy as clicking a button. To access our chatbot, simply locate the message button at the bottom right corner of your screen. 
                  Initiating a conversation is a breeze; just use simple phrases or keywords to pose your questions. The chatbot is designed to understand your queries and guide you through any hurdles you may encounter while using SCHEDONE.</p>
            </div>
        </div>

        <!-- Chatbot Capabilities Popup -->
        <div class="popup-container" id="capabilitiesPopup">
          <span class="lab la-rocketchat"></span>
            <div class="popup-content">
                <div class="close-button" onclick="closePopup('capabilitiesPopup')">&times;</div>
                <h2>Chatbot Capabilities</h2>
                <p>Uncover the wealth of information at your fingertips with our chatbot's capabilities. It specializes in answering frequently asked questions related to the SCHEDONE system, offering insights into functionalities and usage. 
                  Whether you're exploring features or seeking guidance on system operations, the chatbot is your knowledgeable companion throughout your SCHEDONE experience.</p>
            </div>
        </div>
    
        <!-- Best Practices and Tips Popup -->
        <div class="popup-container" id="bestPracticesPopup">
          <span class="lab la-gratipay"></span>
            <div class="popup-content">
                <div class="close-button" onclick="closePopup('bestPracticesPopup')">&times;</div>
                <h2>Best Practices and Tips</h2>
                <p>Optimize your interactions with the chatbot by adopting best practices. Being specific when asking questions ensures you receive accurate and tailored responses. 
                  For ongoing issues, providing relevant details is key to the chatbot offering effective support. Make the most out of your conversations, ensuring that your queries are met with precision and that you receive the assistance you need promptly.</p>
            </div>
        </div>
    
        <!-- Contact Human Support Popup -->
        <div class="popup-container" id="contactSupportPopup">
          <span class="las la-user"></span>
            <div class="popup-content">
                <div class="close-button" onclick="closePopup('contactSupportPopup')">&times;</div>
                <h2>Contact Human Support</h2>
                <p>While our chatbot is a powerhouse of assistance, we understand that sometimes you may prefer the human touch. If the chatbot can't address your needs or if you simply prefer speaking to a human agent, our support team is just a phone call away at +123-456-7890. 
                  We're here to ensure that you receive personalized assistance and the human connection you may be seeking.</p>
            </div>
        </div>
    
        <!-- Feedbacks and Suggestions Popup -->
        <div class="popup-container" id="feedbacksPopup">
          <span class="las la-comment-dots"></span>
            <div class="popup-content">
                <div class="close-button" onclick="closePopup('feedbacksPopup')">&times;</div>
                <h2>Feedbacks and Suggestions</h2>
                <p>Your feedback is the compass guiding our improvement efforts. We value your thoughts on the chatbot experience and are eager to hear any suggestions you may have for enhancements. Your input plays a crucial role in shaping the future of SCHEDONE, ensuring that it continues to meet and exceed your expectations. 
                  Help us make SCHEDONE the best it can be by sharing your insights and recommendations!</p>
            </div>
        </div>

            <!-- Chatbox container -->
            <div class="container">
                <!-- Chatbox main element -->
                <div class="chatbox">
                    <!-- Chatbox support section -->
                    <div class="chatbox__support">
                        <!-- Header of the chatbox -->
                        <div class="chatbox__header">
                            <!-- Image in the header (e.g., user avatar) -->
                            <div class="chatbox__image--header">
                                <img
                                    src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-5--v1.png"
                                    alt="image">
                            </div>
                            <!-- Header content -->
                            <div class="chatbox__content--header">
                                <!-- Header content -->
                                <h4 class="chatbox__heading--header">ScheDone Chat Support</h4>
                                <p class="chatbox__description--header">Good Day! How can I help you?</p>
                            </div>
                        </div>

                        <!-- Messages container within the chatbox -->
                        <div class="chatbox__messages">
                            <!-- Messages container within the chatbox -->
                            <div></div>
                        </div>

                        <!-- Footer section with message input and send button -->
                        <div class="chatbox__footer">
                            <!-- Footer section with message input and send button -->
                            <input type="text" placeholder="Write a message...">
                            <button class="chatbox__send--footer send__button">Send</button>
                        </div>
                    </div>

                    <!-- Button to open the chatbox -->
                    <div class="chatbox__button">
                        <!-- Button to open the chatbox -->
                        <button><img src="../Images/chatbox-icon.svg" /></button>
                    </div>
                </div>
            </div>


         <!-- Label for closing the mobile menu -->
        <label class="close-mobile-menu" for="menu-toggle"></label>

                <!-- Logout Popup Container -->
        <div class="popup-container" id="logoutPopup">
            <div class="popup-content">
                <img src="../Images/lock.png" alt="Logo" class="logo-image">
                <h2>Logout Confirmation</h2>
                <p>Are you sure you want to logout?</p>
                <!-- Buttons for confirming or canceling logout -->
                <div class="button-container">
                    <button class="btn" onclick="confirmLogout()">YES</button>
                    <button class="btn closeBtn" onclick="closePopup('logoutPopup')">NO</button>
                </div>
            </div>
        </div>


        <!-- Script section for handling JavaScript functionality -->
        <script>

        // Function to show a popup by setting its display style to "block"
        function showPopup(popupId) {
            const popupContainer = document.getElementById(popupId);
            if (popupContainer) {
                popupContainer.style.display = "block";
            }
        }

        // Function to close a popup by setting its display style to "none"
        function closePopup(popupId) {
            const popupContainer = document.getElementById(popupId);
            if (popupContainer) {
                popupContainer.style.display = "none";
            }
        }

        // Event listener for when the DOM content is fully loaded
        document.addEventListener("DOMContentLoaded", function () {
        const chatboxButton = document.querySelector(".chatbox__button button");
        const chatboxSupport = document.querySelector(".chatbox__support");
        const chatboxMessages = document.querySelector(".chatbox__messages div");
        const userInputField = document.querySelector(".chatbox__footer input");

        // Toggle chatbox visibility when the chatbox button is clicked
        chatboxButton.addEventListener("click", function () {
            chatboxSupport.classList.toggle("show-chatbox");
            chatboxSupport.classList.toggle("chatbox--active");
        });

        // Function to handle user input in the chatbox
        function handleUserInput() {
        const userInput = userInputField.value.trim();
        if (userInput !== "") {
            chatboxMessages.innerHTML += `<p><strong>User:</strong> ${userInput}</p>`;

        // Simulate a delay before getting the chatbot response
        setTimeout(() => {
            const response = getChatbotResponse(userInput);
            chatboxMessages.innerHTML += `<p><strong>ScheDone Chat Support:</strong> ${response}</p>`;
        }, 2000);

        userInputField.value = "";
    }
}

        // Function to get a chatbot response based on user input
            function getChatbotResponse(userInput) {
                const lowerCaseUserInput = userInput.toLowerCase();
                for (const intent of intents) {
                    for (const pattern of intent.patterns) {
                        if (lowerCaseUserInput.includes(pattern.toLowerCase())) {
                            return getRandomResponse(intent.responses);
                        }
                    }
                }
        // If no specific pattern is matched, return a default response
        return "I'm sorry, I didn't understand that. Can you please ask in a different way?";
    }

        // Function to get a random response from an array of responses
        function getRandomResponse(responses) {
            const index = Math.floor(Math.random() * responses.length);
            return responses[index];
        }

        // Event listener for handling user input when Enter key is pressed
        userInputField.addEventListener("keyup", function (event) {
            if (event.key === "Enter") {
                handleUserInput();
            }
        });

        // Event listener for handling user input when the chatbox button is clicked
        document.querySelector(".chatbox__footer button").addEventListener("click", handleUserInput);
});

// Intents data containing predefined patterns and responses for the chatbot
const intents = [
    {
        "tag": "greeting",
        "patterns": ["Hi", "Hey", "How are you", "Is anyone there?", "Hello", "Good day"],
        "responses": ["Hey :-)", "Hello, How can I help you?", "Hi there, what can I do for you?", "Hi there, how can I help?"]
    },
    {
        "tag": "goodbye",
        "patterns": ["Bye", "See you later", "Goodbye"],
        "responses": ["Goodluck on using ScheDone! If you have any more questions, don't hesitate to ask!", "Goodluck on using ScheDone! If you have any more questions, please don't hesitate to ask!"]
    },
    {
        "tag": "thanks",
        "patterns": ["Thanks", "Thank you", "That's helpful", "Thank's a lot!"],
        "responses": ["Happy to help!", "Any time!", "My pleasure"]
    },
    {
        "tag": "overview",
        "patterns": [
            "Give me an overview of the application",
            "What is the main purpose of this website?",
            "Where can I find the introduction about this application?",
            "Can you help me find the overview and introduction?",
            "Where is the overview and introduction?"
        ],
        "responses": [
            "The Overview and Introduction can be found on the Help menu, if you want to know more about ScheDone, you may also want to look for it on the About menu.",
            "The Overview and Introduction can be found on the Help menu, but if you want to know more about ScheDone; You may also look for more description on the About menu."
        ]
    },
    {
        "tag": "dashboard",
        "patterns": [
            "What information does the dashboard display?",
            "Where can I see the number of tasks I'm currently working on?",
            "Does the dashboard automatically updates?",
            "Where can I find the number of tasks"
        ],
        "responses": [
            "The number of tasks can be seen on the Dashboard menu, take note that the dashboard automatically updates whenever you add a task.",
            "The number of tasks can be seen on the Dashboard menu, please take note that the dashboard automatically updates whenever you add a task."
        ]
    },
    {
        "tag": "addingtask",
        "patterns": [
            "Add task",
            "How to add task?",
            "How to add a task?",
            "How can I create a task?",
            "Where do I add a task?"
        ],
        "responses": [
            "You can create a task by clicking the Task menu. After clicking it, click the add task and fill in the details needed. After creating, it will display a text that you have successfully added a task.",
            "You can add a task by clicking the Task menu. After clicking it, click the add task and fill in the details needed. After creating, it will display a text that you have successfully added a task"
        ]
    },
    {
        "tag": "edittask",
        "patterns": ["Edit task", "How to edit a task?", "Edit", "Modify task", "How to edit task?"],
        "responses": ["To edit a task, go to your task list, find the task you want to edit, and click on the 'Edit' button in the action column. A container will appear with the task details, make your changes, and click 'Apply'."],
    },
    {
        "tag": "deletetask",
        "patterns": ["Delete task", "How to delete a task?", "Remove task", "Discard task", "How to delete task?"],
        "responses": ["To delete a task, go to your task list, find the task you want to delete, and click on the 'Delete' button in the action column. Confirm the deletion, and the task will be removed."],
    },
    {
        "tag": "changeaccount",
        "patterns": [
            "How can I change the details of my account?",
            "Where can I change the details of my account"
        ],
        "responses": [
            "You can change the details of account in the User menu by filling up all the necessary details that you want to change. Take note that you can't use email address and username that is already existing. ",
            "You can change the details of account in the User menu by filling up all the necessary details that you want to change. Please take note that you can't use email address and username that is already existing."
        ]
    },
    {
        "tag": "description",
        "patterns": [
            "Where can I find the description about the application?",
            "Can you help me find the part where I can see the description of ScheDone?",
            "Where can I find the description about ScheDone"
        ],
        "responses": [
            "The description about ScheDone can be found on the About menu. It also includes the developers of ScheDone and the description on how it was founded.",
            "The description about ScheDone can be found on the About menu. It also includes the developers of ScheDone and how it was founded."
        ]
    },
    {
        "tag": "contact",
        "patterns": [
            "Where can I found the contact numbers of the developers?",
            "Can you help me find the numbers of the developers?",
            "Where do I find the contacts of the authors?"
        ],
        "responses": [
            "The contacts of the developers were displayed on the Help menu. If they didn't respond to your messages and calls, try writing an email on the email address 'schedone@gmail.com'.",
            "The contacts of the developers were displayed on the Help menu. If they didn't respond to your messages, try writing an email on the email address 'schedone@gmail.com'."
        ]
    }
];
            </script>
            
            <!-- jQuery library and custom help.js script -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
            <script src="../JS/help.js"></script>
</body>
</html>