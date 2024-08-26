<?php include "includes/numerusdatabase.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div class="admin-header">
        <div class="logo">
            <a href="a1_adminHomePage.php">
                <img src="image/Logo.png" alt="Logo">
            </a>
        </div>
        <div class="profile-icon header-dropdown">
            <a href="a8_View_AdminProfile.php">
                <img src="image/profile.png" alt="Profile Icon">
            </a>
            <ul class="profile-dropdown-menu">
                <li><a href="a8_View_AdminProfile.php">View Profile</a></li>
                <li><a href="includes/logOut.inc.php">Log Out</a></li>
            </ul>
        </div>
        
    </div>
    

    <nav>
        <ul>
            <a href="a2_userManagement.php">
                <li class="user-management">User Management</li>
            </a>
            <li class="learning-level-management header-dropdown">
                Learning Level Management
                <ul class="dropdown-menu">
                    <li class="level" data-level="1">Level 1
                        <ul class="sub-menu">
                            <a href="a4_viewTutorial.php?level=1">
                                <li>Tutorial Management</li>
                            </a>
                            <a href="a6_QuizManagement.php?level=1">
                                <li>Quiz Management</li>
                            </a>
                        </ul>
                    </li>
                    <li class="level" data-level="2">Level 2
                        <ul class="sub-menu">
                            <a href="a4_viewTutorial.php?level=2">
                                <li>Tutorial Management</li>
                            </a>
                            <a href="a6_QuizManagement.php?level=2">
                                <li>Quiz Management</li>
                            </a>
                        </ul>
                    </li>
                    <li class="level"  data-level="3">Level 3
                        <ul class="sub-menu">
                            <a href="a4_viewTutorial.php?level=3">
                                <li>Tutorial Management</li>
                            </a>
                            <a href="a6_QuizManagement.php?level=3">
                                <li>Quiz Management</li>
                            </a>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </nav> 
</nav>
</body>
<script src="script.js"></script>
</html>