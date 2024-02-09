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
    <title>ScheDone - Read More</title>
    <!-- Add Favicon -->
    <link rel="icon" href="../Images/1.png" type="image/png">
    <!-- Include Line Awesome CSS library -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!-- Include Morris.js CSS library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- Include custom CSS file "about.css" -->
    <link rel="stylesheet" href="../CSS/members.css">
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
                    <!-- About Link (marked as active) -->
                    <a href="about.php" class="active">
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

        <!-- Mission, Vision, and Goals Section -->
        <section class="mission-vision-goals">
            <h1 class="heading">Mission, <span class="heading1">Vision, <span class="heading2">Goals</span></h1>
        <!-- Mission Section -->
        <section class="mission-section">
            <h2>Mission</h2>
            <p>Our mission at SCHEDONE is to empower students by providing a comprehensive task management system that streamlines their academic workload. We are committed to enhancing productivity, fostering organization, and promoting accountability among students. By offering a centralized platform for managing tasks, deadlines, and progress, we strive to contribute to students' success in their academic journey.</p>
        </section>

        <!-- Vision Section -->
        <section class="vision-section">
            <h2>Vision</h2>
            <p>Our vision is to emerge as the foremost provider of student task management systems, recognized for our user-friendly interface, innovative features, and steadfast commitment. We aspire to contribute significantly to the academic success and personal growth of students. At SCHEDONE, we envision a future where every student possesses the necessary tools to excel in both studies and responsibilities, fostering a community of learners who are well-organized, motivated, and equipped to confront the challenges of education. Our goal is to make a meaningful impact on the educational landscape by continuously enhancing and adapting our platform to meet the evolving needs of students and the changing educational environments.</p>
        </section>

        <!-- Goals Section -->
        <section class="goals-section">
            <h2>Goals</h2>
            <ul>
                <li>Empower Students: Provide a user-friendly platform that empowers students to take control of their academic responsibilities, promoting self-management and a sense of accomplishment.</li>
                <li>Enhance Productivity: Develop features that streamline tasks, deadlines, and progress tracking, ultimately enhancing students' productivity and reducing academic stress.</li>
                <li>Facilitate Time Management: Enable students to create personalized schedules, set goals, and break down activities into manageable parts, fostering effective time management skills.</li>
                <li>Promote User Adoption: Implement user education and support initiatives to overcome resistance to change, ensuring widespread adoption and utilization of the system.</li>
                <li>Stand Out in a Crowded Market: Develop a potent marketing and sales strategy to differentiate SCHEDONE in a competitive market, ensuring sustained profitability and growth.</li>
            </ul>
    </section>

        <!-- Separator -->
        <hr class="section-separator">

        <!-- Team Members Section -->
        <section class="members" id="members">
            <h1 class="heading">Team <span class="members-color">Members</span></h1>
            <div class="members-container">
                
                <div class="members-box" data-info="Nichole Bantiling" data-description="<p>UI/UX Designer & Technical Writer</p><br><br>
                <p1>Hello, everyone! My name is Nichole Bantiling, and I'm currently a 4th-year college student pursuing a Bachelor of Science degree in Computer Science at the Polytechnic University of the Philippines. I am passionate about the world of computer and information sciences, and I've had the incredible opportunity to be part of a team that developed this website!</p1><br><br>
                <p1>As a UI/UX and technical writer, I excel in crafting user-centric interfaces and creating comprehensive technical documentation. Collaborating closely with my team, we successfully translated our ideas into a functional design, ensuring a seamless user experience. Witnessing the impact of our work on the digital landscape is truly fulfilling.</p1><br><br>
                <p1>My passion for this industry goes beyond my academic pursuits. I've always been fascinated by the power of technology and its ability to shape our world. In particular, I find myself constantly engrossed in reading news about the current trends in artificial intelligence. AI's advancements and potential applications never cease to amaze me, and staying updated with these developments will help me grow as a professional in the field.</p1><br><br>
                <p1>In addition to my love for technology, I am an avid gamer. Playing online video games has been a critical factor in my decision to pursue a degree in computer science. Through gaming, I've developed problem-solving skills, honed my strategic thinking, and experienced the dynamic nature of online communities. These experiences have reinforced my passion for the world of computers and inspired me to explore the depths of this ever-evolving field.</p1>">
                <img src="../images/nichoy.jpg" alt="">
                <div class="members-layer">
                    <h4>Nichole Bantiling</h4>
                    <a href="#"><i class='bx bx-link-external'></i></a>
                </div>
            </div>

                    
            <div class="members-box" data-info="Stephen Rae A. Domingo" data-description="<p>UI/UX Designer & Technical Writer</p><br><br>
                <p1>Hi there to all of you! I am Stephen Rae A. Domingo, a fourth-year student majoring in computer science at the Polytechnic University of the Philippines. I actively participated in the creation of a website as part of a cooperative team effort since I am passionate about the fields of computer and information sciences.</p1><br><br>
                <p1>I'm an expert UI/UX designer and technical writer with a focus on creating user-centered interfaces and thorough technical documentation. My team and I worked closely together to effectively transform our concepts into a functional design, resulting in a smooth user experience that has had a noticeable effect on the digital environment.</p1><br><br>
                <p1>I have a deep fascination with technology's ability to transform, which goes beyond my academic studies and drives my passion for the sector. I am fascinated by the ongoing developments and possible uses of artificial intelligence that are reshaping our world, so I spend a lot of time reading news about these trends. For me to advance professionally in this industry, it is essential that I keep up with these advances.</p1><br><br>
                <p1>Along with my hobbies, I also play video games really well. A major factor in my decision to seek a computer science degree was my participation in online video games. I've embraced the dynamic nature of online networks and developed my problem-solving and strategic thinking skills through gaming. My passion to investigate the always changing realm of computers was stoked by these encounters, which also cemented my allegiance to it.</p1>">
                    <img src="../images/Stephen.jpg" alt="">
                    <div class="members-layer">
                        <h4>Stephen Rae Domingo</h4>
                        <a href="#"><i class='bx bx-link-external'></i></a>
                    </div>
                </div>

                <div class="members-box" data-info="Ina Cassandra Morales" data-description="<p>Software Developer & System Analyst</p><br><br>
                    <p1>Hello there! I'm Ina Cassandra Morales, a 21-year-old student currently in my 4th year at the Polytechnic University of the Philippines, pursuing a degree in Computer and Information Sciences.</p1><br><br>
                    <p1>Since my early years, my fascination with technology has propelled me into the captivating realm of software development. As a dedicated Software Developer/Programmer, my responsibilities encompass the entire software development life cycle – from designing and coding to testing and maintaining applications. I specialize in both system and web development, crafting innovative solutions to address diverse needs.</p1><br><br>
                    <p1>Aside from being a software developer, I am also the System Analyst of the team. One of the aspects of my role as a system analyst involves playing a crucial role in analyzing and optimizing system functionality to ensure seamless operation. This includes evaluating user requirements and tailoring software to meet their specific needs. This commitment to understanding and fulfilling user needs is central to my approach as a developer.</p1><br><br>
                    <p1>What sets me apart is not only my technical proficiency but also my genuine passion for the field. My interests extend beyond the professional realm, reflecting in my love for gaming, where I find joy in exploring and creating virtual worlds. This passion seamlessly aligns with my commitment to coding and crafting usable software that enhances user experiences.</p1><br><br>
                    <p1>The dynamic nature of the technology field never ceases to captivate me. Witnessing constant innovation and growth, I am inspired by how technology addresses real-world problems and improves lives across various domains. From communication to transportation, education, healthcare, and beyond, technology has reshaped our world. As a member of the tech community, I feel privileged to contribute to this ongoing evolution. The excitement and wonder I experience in this field fuel my passion for computer science, propelling me to strive for excellence in every aspect of my work.</p1><br><br>
                    <p1>Being part of a collaborative team of like-minded individuals in software design allows me to leverage my diverse interests. Working alongside fellow enthusiasts, I value the exchange of ideas and perspectives, recognizing that diversity is a driving force behind groundbreaking solutions. This synergy not only enhances the quality of our projects but also cultivates a supportive and dynamic atmosphere where each team member contributes their unique strengths. As I continue my journey in software development, I am excited about the possibilities that lie ahead and am dedicated to making meaningful contributions to our shared goals.</p1>">
                    <img src="../images/Cassie.jpeg" alt="">
                    <div class="members-layer">
                      <h4>Ina Cassandra Morales</h4>
                      <a href="#"><i class='bx bx-link-external'></i></a>
                    </div>
                  </div>
                  

                <div class="members-box" data-info="Cedric Noah P. Vico" data-description="<p>Project Leader & QA Tester</p><br><br>
                <p1>Greetings! I'm Cedric Noah P. Vico, a dedicated project manager and quality assurance (QA) tester currently pursuing my Bachelor of Science in Computer Science (BSCS) degree at the esteemed Polytechnic University of the Philippines. With a passion for technology and a keen eye for detail, I thrive in the dynamic intersection of project management and software quality assurance.</p1><br><br>
                <p1>As a student in the BSCS 4-3 program, I'm committed to honing my skills in software development, project management, and quality assurance. My academic journey at Polytechnic University of the Philippines has equipped me with a strong foundation in programming languages, software engineering principles, and agile methodologies. Alongside my studies, I actively engage in practical projects and real-world scenarios to deepen my understanding and application of industry best practices.</p1><br><br>
                <p1>With a natural knack for leadership and organization, I excel in guiding projects from conception to completion. As a project manager, I leverage my communication skills and collaborative approach to streamline workflows, allocate resources efficiently, and ensure timely delivery of milestones. I'm adept at defining project scopes, setting realistic timelines, and mitigating risks to maximize project success.</p1>">
                    <img src="../images/ced.jpg" alt="">
                    <div class="members-layer">
                        <h4>Cedric Noah Vico</h4>
                        <a href="#"><i class='bx bx-link-external'></i></a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Popup Container for Member Information -->
        <div class="popup-container" id="popupContainer">
            <h2 class="popupTitle">MEMBER INFORMATION</h2>
            <img id="popupImage" src="" alt="">
            <h4 id="popupTitle" class="popupTitle"></h4>
            <p id="popupDescription" class="popupDescription"></p>
            <button onclick="closePopup()">Close</button>
        </div>

        <!-- Separator -->
        <hr class="section-separator">
            
        <!-- Connect with Us Section -->
        <section class="connect-with-us">
            <h1 class="heading">Connect <span class="heading1">With <span class="heading2">Us</span></h1>

            <div class="connect-container">
                <!-- Facebook Container -->
                <div class="connect-box">
                    <div class="connect-icon">
                        <span class="lab la-facebook"></span>
                    </div>
                    <div class="connect-text">
                        <a href="#" target="_blank">Facebook</a>
                    </div>
                </div>

                <!-- Twitter Container -->
                <div class="connect-box">
                    <div class="connect-icon">
                        <span class="lab la-twitter"></span>
                    </div>
                    <div class="connect-text">
                        <a href="#" target="_blank">Twitter</a>
                    </div>
                </div>

                <!-- Gmail Container -->
                <div class="connect-box">
                    <div class="connect-icon">
                        <span class="las la-envelope"></span>
                    </div>
                    <div class="connect-text">
                        <a href="mailto:schedone@gmail.com">Gmail</a>
                    </div>
                </div>

                <!-- Telephone Number Container -->
                <div class="connect-box">
                    <div class="connect-icon">
                        <span class="las la-phone"></span>
                    </div>
                    <div class="connect-text">
                        <span>Telephone Number</span>
                        <p>+123-456-7890</p>
                    </div>
                </div>
            </div>
            <!-- Go Back Link -->
            <a href="about.php" class="read-more">Go Back?</a>
        </section>

    <!-- Label for closing mobile menu -->
    <label class="close-mobile-menu" for="menu-toggle"></label>

    <!-- Logout Confirmation Popup Container -->
    <div class="logout-popup-container" id="logoutPopup">
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

    <!-- Include JavaScript libraries and the main.js file -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="../JS/members.js"></script>

</body>

</html>