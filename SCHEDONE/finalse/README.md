### ScheDone ###

SCHEDONE: A Student Task Management System" is a cutting-edge software solution meticulously crafted to empower students in navigating the complexities of their academic workload with ease and efficiency. Tailored exclusively for students, this comprehensive platform serves as a centralized hub for seamlessly organizing tasks, deadlines, and progress, thereby fostering enhanced organization and accountability in their academic endeavors.

The primary purpose of "SCHEDONE" is to revolutionize how students manage their academic responsibilities by offering a range of powerful features designed to optimize task management processes. By providing a centralized and intuitive interface, the system enables students to plan, organize, monitor, and complete their outstanding tasks efficiently, leading to heightened productivity and invaluable time-saving benefits.
 




### How to Set Up and Run the System ### 

1. Select an Integrated Development Environment (IDE): An IDE is essential for efficient coding and project management. Consider choosing an IDE such as Visual Studio Code, Sublime Text, JetBrains PhpStorm, Eclipse, or any other preferred development environment.

• Visual Studio Code (VS Code) is a lightweight and versatile IDE that supports various programming languages, including PHP, HTML, CSS, and JavaScript. It offers features like IntelliSense for code completion, debugging support, Git integration, and a rich ecosystem of extensions for enhanced functionality.

• Sublime Text is another popular choice known for its speed and simplicity. It provides a distraction-free interface, powerful search and navigation capabilities, and extensive customization options through plugins and packages.

• JetBrains PhpStorm is a specialized IDE specifically designed for PHP development. It offers advanced code analysis, refactoring tools, version control integration, and seamless integration with popular frameworks like Laravel, Symfony, and WordPress.

• NetBeans: NetBeans is a free, open-source IDE primarily used for Java development but also supports web development with HTML, CSS, JavaScript, and PHP. It offers features like code templates, debugging, and project management tools.

• Notepad++: Notepad++ is a lightweight text editor for Windows with support for syntax highlighting and plugins. While not as feature-rich as some IDEs, it's simple and efficient for basic web development tasks.

• Eclipse is a comprehensive IDE widely used for Java development but also supports PHP through plugins like Eclipse PDT (PHP Development Tools). It provides features like syntax highlighting, code formatting, debugging, and project management tools.

• Choose an IDE that best suits your preferences, workflow, and project requirements. Regardless of the IDE chosen, ensure it supports PHP development and provides the necessary tools and features to streamline your development process.



2. Install XAMPP: XAMPP is required for handling PHP and managing the database. It provides an open-source administration tool. To install XAMPP, download the appropriate version for your operating system from the official website and follow the installation instructions.

• After installing XAMPP, open the XAMPP Control Panel and start the Apache and MySQL services. This can typically be done by clicking the "Start" button next to each service. Ensure that both Apache and MySQL services are running properly by checking the status indicators next to their names. They should show as "Running" without any errors.

• The XAMPP Control Panel provides a convenient interface for managing your local server environment. From here, you can start and stop services, access server logs, configure settings, and more. Make sure to keep the XAMPP Control Panel open while you're working on your project to monitor the status of the Apache and MySQL services.



3. Download Files from the Repository: Download Files from the Repository: Access the relevant repository where the system files are stored (Specifically the repository provided here). Navigate to the repository's page and locate the option to download the files. Typically, you'll find a "Download ZIP" button or a similar option.

• After downloading the ZIP file, locate it in your computer's file explorer and extract its contents. This can usually be done by right-clicking the ZIP file and selecting "Extract All" or using a file archiving tool like WinRAR or 7-Zip. Extracting the files will create a folder containing all the project files and directories.

• Before importing the extracted files into your IDE, take a moment to review the directory structure and familiarize yourself with the contents. This can help you understand how the project is organized and locate specific files or resources more easily during development.

• Once the files are extracted and organized, you can proceed to import them into your chosen IDE for further development and customization. Depending on your IDE, this process may involve creating a new project or simply opening the extracted folder directly within the IDE's workspace.



4. Access Localhost PHP MyAdmin: Once you have XAMPP installed and its services running, including MySQL, you can access the PHPMyAdmin interface. Open your preferred web browser and type "localhost/phpmyadmin" into the address bar. Press Enter to navigate to the PHPMyAdmin login page.

• PHPMyAdmin is a web-based tool that provides a graphical user interface for managing MySQL databases. It allows you to perform various database management tasks such as creating, deleting, and modifying databases, tables, and records.

• Upon reaching the PHPMyAdmin login page, you may be prompted to enter a username and password. By default, if you're using XAMPP, the username is "root" and there is no password. However, if you've set a password during the XAMPP installation process, you'll need to enter that password here.

• After successfully logging in, you'll be presented with the PHPMyAdmin dashboard, which displays an overview of your databases and provides access to various database management tools. From here, you can create a new database for your system, import database files, execute SQL queries, and perform other administrative tasks necessary for setting up and maintaining your system's database.



5. Create the Database: Within PHPMyAdmin, navigate to the "Databases" tab located at the top of the page. Enter "tasker" as the name for the new database in the provided field and click the "Create" button. This will create a new empty database named "tasker" that will store the data for your system.

• Once the "tasker" database is created, navigate to it by selecting it from the list of available databases on the left-hand side of the PHPMyAdmin interface.

• Next, locate the "Import" tab within PHPMyAdmin, typically located at the top of the page. Click on the "Choose File" button and select the "register.sql" file from the "DATABASE" folder that you extracted earlier from the repository. This file contains the SQL code necessary to create the "register" table and populate it with initial data.

• After selecting the "register.sql" file, click the "Go" or "Import" button to execute the import process. PHPMyAdmin will read the SQL code from the file and execute it, creating the "register" table within the "tasker" database and inserting the provided data.

• Repeat the same process for the "tasks.sql" file, selecting it from the "DATABASE" folder and importing it into the "tasker" database. This file contains the SQL code to create the "tasks" table and populate it with initial data related to tasks within the system.

• Once both files have been imported successfully, you'll have a fully functional database named "tasker" containing the necessary tables and data to support your system's functionality. You can now proceed with integrating the database into your system code and developing the remaining features of your application.



6. Explore the Project Structure: After importing the files into your IDE, take some time to familiarize yourself with the project's directory structure. This will help you understand how the various files and folders are organized and where to find specific resources when working on the system.

• Components: This directory contains PHP files that encapsulate different components and functionalities of the system. These files represent modular units of code responsible for specific tasks, such as user authentication, data processing, and database interactions.

• CSS: Within this folder, you'll find Cascading Style Sheets (CSS) files used to define the visual appearance and layout of the system's web pages. CSS rules in these files control aspects like typography, colors, margins, and responsive design to ensure a cohesive and visually appealing user experience.

• DATABASE: This folder houses database-related files necessary for setting up and managing the system's database. It includes SQL scripts for creating database tables, defining relationships between entities, inserting sample data, or performing database migrations.

• HTML: HTML files in this directory define the structure and content of the system's web pages. Each HTML file corresponds to a specific page or view within the application and contains markup to organize text, images, forms, and other elements on the page.

• Images: Any images used within the system, such as logos, icons, or product photos, are stored in this folder. Including images in a separate directory helps keep the project organized and makes it easier to manage and update visual assets as needed.

• JS: JavaScript files reside in this folder and provide client-side scripting functionality to enhance the interactivity and responsiveness of the system's user interface. These files include code for form validation, DOM manipulation, AJAX requests, and implementing dynamic behaviors.

• Lugrasimo: This folder may contain miscellaneous resources for the fonts used on the website.

• Index.html: This file, located outside the folders, serves as the entry point for initializing and running the system. It typically contains the initial HTML code to display the system's homepage or login page. You can customize this file to define the initial user interface and functionality of the system.

• README.md: The README.md file located outside the folders serves as a central point of reference for the project. It contains essential information about the system, including installation instructions, usage guidelines, project overview, contributor guidelines, system functionalities and features, and any other important details necessary for understanding and contributing to the project. 





### User Interfaces and Functionalities ### 

The user interfaces of "SCHEDONE: A Student Task Management System" comprise various elements designed to facilitate seamless user interaction. Below are the primary user interfaces featured in SCHEDONE

• Welcome Page: The welcome page of the ScheDone website offers an inviting introduction to its Student Task Management System. Upon entering the site, visitors are greeted with a vibrant header featuring navigation options for signing up and logging in. The central focus of the page is a warm welcome message accompanied by a succinct description of ScheDone's purpose: to assist students in organizing their tasks efficiently. A carousel of images further enhances the visual appeal, providing glimpses into the functionality of the system. Below the welcome message, three key features of ScheDone are highlighted, emphasizing its ability to simplify task tracking, monitor progress, and provide a user-friendly interface. Through thoughtful design and informative content, the welcome page effectively communicates ScheDone's value proposition and encourages users to explore further.

• Login Page: On the welcome page of ScheDone, users can easily navigate to the login form to access their accounts within the system if they already have an account. This login form prominently features two input fields: one for the user's password and the other for their unique identifier, such as a username or email. Users are required to input their credentials here to gain access to the system's functionalities. Additionally, the login page may include elements such as "Remember me" checkboxes for convenient access for returning users, thereby enhancing the user experience.

• Signup Page: On the welcome page of ScheDone, new users can navigate to the signup form as well to register for an account. This form collects essential information such as their name, username, email address, contact number, and password. Additionally, users are presented with a checkbox where they should agree to the terms and conditions and privacy statement of ScheDone. By checking this box, users signify their consent to abide by the terms outlined in these documents. Should users wish to review the terms and conditions or privacy statement before agreeing, they can do so by clicking on the respective links provided. These links navigate users to dedicated pages where they can thoroughly review the terms and conditions as well as the privacy statement of ScheDone. After completing this form during the registration process, users create their accounts and gain access to ScheDone. The signup form may also include validation checks to ensure the accuracy and security of user-provided information.

• Privacy Statement Page: The privacy statement page of ScheDone provides detailed information about how user data is collected, used, and protected within the system. It outlines the measures taken to safeguard user privacy and explains the types of information collected, such as personal data and usage data. Additionally, the privacy statement clarifies how user data is processed, shared with third parties (if applicable), and the rights users have regarding their personal information.

• Terms & Conditions Page: The terms and conditions page of ScheDone outlines the rules, obligations, and responsibilities governing the use of the platform. It covers various aspects such as user conduct, intellectual property rights, limitations of liability, and dispute resolution mechanisms. By reviewing the terms and conditions, users gain a comprehensive understanding of their rights and obligations while using ScheDone. This page ensures transparency and establishes clear guidelines for user interaction with the platform.

• Menu Tabs: Displayed prominently on the right side of the screen, the menu tabs serve as clickable alternatives that provide effortless navigation to various functions and sections within the ScheDone system. These tabs offer users convenient access to essential features such as the Task List, Dashboard, User Profile, and Settings. Additionally, users can find support and guidance through the Help tab, learn more about the system via the About tab, and log out securely using the Logout tab. This intuitive layout ensures users can easily explore and utilize ScheDone's full range of functionalities while maintaining accessibility and user-friendliness.

• Dashboard: The dashboard provides users with a comprehensive, high-level overview of their workload and task status within the system. Users can efficiently monitor their workload by accessing key information, including the total number of tasks, productivity points, locked rewards, and level progress. Additionally, the dashboard features a Timeline of Monthly Finished Tasks, enabling users to track their completed tasks over time, along with notifications to stay updated on important events and activities.

• Task List: Users can conveniently view and add tasks through the task list feature. It presents a table layout comprising columns for category, subject, task description, deadline, status, priority level, comments, and action buttons for editing and deleting tasks. Moreover, the task list offers customization options, allowing users to tailor the display according to their preferences. This includes adjusting font size, style, and family, selecting colors, and sorting tasks based on criteria such as deadline, priority level, and status.

• About: In this section, users can find out more about Schedone and what it stands for. Clicking on "Read More" provides access to additional details, such as the company's mission, vision, goals, team members, and links to its social media profiles. Users can gain a deeper understanding of Schedone's values and objectives, enabling them to align with the company's ethos and engage meaningfully with its initiatives. Additionally, this section serves as a hub for users to connect with Schedone's community and stay updated on its latest developments and endeavors across various social media platforms.

• User Information: This section allows users to access and review their profile information. Here, users can conveniently view details such as their name, email address, profile picture, and any other relevant personal information associated with their account. Moreover, users have the option to update and edit their credentials as needed, ensuring that their profile remains accurate and up-to-date. This feature provides users with control over their account information, allowing them to manage their profile effectively within the system
 
• Help: Users can access this section whenever they require assistance or guidance while using the system. Here, they can seek support and advice on utilizing the system effectively. The Help feature provides comprehensive support for troubleshooting, offers solutions to frequently encountered problems, and details various SCHEDONE features and capabilities. Additionally, the system features an interactive chatbot designed to provide real-time assistance. This chatbot is readily available to help users navigate through the system, resolve issues, and gain insights into SCHEDONE's diverse functionalities. Whether users need general guidance or encounter specific challenges, the chatbot offers personalized support, ensuring a seamless and user-friendly experience for all users.

• Logout: This feature allows users to securely log out of their SCHEDONE account. By clicking on the Logout option, users can ensure that their account session is terminated, preventing unauthorized access to their account and maintaining the security of their personal information. Upon logging out, users will be directed to the welcome page, providing a smooth transition and ensuring a seamless user experience.

