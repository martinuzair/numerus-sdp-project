<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/numerusdatabase.php';
$admin_id = $_SESSION['admin_ID'];
if(isset($_SESSION['admin_ID'])){
    $stmt = $pdo->prepare("SELECT Name FROM admin WHERE Admin_id=?");
    $stmt->execute([$admin_id]);
    $admin = $stmt->fetch(); 
}  
$stmt = $pdo->prepare("SELECT COUNT(*) FROM child");
$stmt->execute();
$childCount = $stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT COUNT(*) FROM parent");
$stmt->execute();
$parentCount = $stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT COUNT(*) FROM chapters WHERE Level_ID = '1'");
$stmt->execute();
$Lvl1Count = $stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT COUNT(*) FROM chapters WHERE Level_ID = '2'");
$stmt->execute();
$Lvl2Count = $stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT COUNT(*) FROM chapters WHERE Level_ID = '3'");
$stmt->execute();
$Lvl3Count = $stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT COUNT(*) FROM quiz q
                            LEFT JOIN chapters c ON q.Chapters_ID = c.Chapters_ID
                            WHERE c.Level_ID = '1'");
$stmt->execute();
$QuizLvl1Count = $stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT COUNT(*) FROM quiz q
                            LEFT JOIN chapters c ON q.Chapters_ID = c.Chapters_ID
                            WHERE c.Level_ID = '2'");
$stmt->execute();
$QuizLvl2Count = $stmt->fetchColumn();
$stmt = $pdo->prepare("SELECT COUNT(*) FROM quiz q

                            LEFT JOIN chapters c ON q.Chapters_ID = c.Chapters_ID
                            WHERE c.Level_ID = '3'");
$stmt->execute();
$QuizLvl3Count = $stmt->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Home Page</title>
    <link rel="stylesheet" href="CSS/design.css">
</head>
<body>
    <?php include "includes/adminheader.php"?>

    
    
    <section class="top-row">
        <div class="welcome-box">
            <h1 id="welcome-text">Welcome <?php echo isset($admin['Name']) ? $admin['Name'] : ''; ?></h1><br>
            <h1 id="date-text"></h1><br>
            <h1 id="day-text"></h1>
        </div>
        <div class="totalUser-box">
            <h1 id="users-text">Total Users:</h1>
            <div class="total-users">
                <h2 id="user-parents">Parents:<br> <?php echo $parentCount; ?></h2>
                <div class="divide-users"></div>
                <h2 id="user-children">Children:<br> <?php echo $childCount; ?></h2>
            </div>
        </div>
    </section>

    <section class="bottom-row">
        <div class="tutorial-box">
            <h1 id="tutorial-text">Tutorial:</h1>
            <h2 class="level-text" id="level-1-text">Level 1: Easy</h2>
            <div class="divide-text-1"></div>
            <h2 class="level-text" id="level-2-text">Level 2: Medium</h2>
            <div class="divide-text-2"></div>
            <h2 class="level-text" id="level-3-text">Level 3: Hard</h2>
        </div>
        <div class="chapters-box">
            <h1 id="chapters-text">Chapters:</h1>
            <h2 class="level-chapters" id="level-1-chp">Level 1:</h2>
            <h2 class="level-chp" id="amount-1"><?php echo $Lvl1Count; ?></h2>
            <a href="a4_viewTutorial.php?level=1" id="redirect-1"> > </a>
            <div class="divide-text-1"></div>
            <h2 class="level-chapters" id="level-2-chp">Level 2:</h2>
            <h2 class="level-chp" id="amount-2"><?php echo $Lvl2Count; ?></h2>
            <a href="a4_viewTutorial.php?level=2" id="redirect-2"> > </a>
            <div class="divide-text-2"></div>
            <h2 class="level-chapters" id="level-3-chp">Level 3:</h2>
            <h2 class="level-chp" id="amount-3"><?php echo $Lvl3Count; ?></h2>
            <a href="a4_viewTutorial.php?level=3" id="redirect-3"> > </a>
        </div>
        <div class="quiz-box">
            <h1 id="quiz-text">Quiz:</h1>
            <h2 class="level-chapters" id="level-1-chp">Level 1:</h2>
            <h2 class="level-chp" id="amount-1"><?php echo $QuizLvl1Count; ?></h2>
            <a href="a6_QuizManagement.php?level=1" id="redirect-1"> > </a>
            <div class="divide-text-1"></div>
            <h2 class="level-chapters" id="level-2-chp">Level 2:</h2>
            <h2 class="level-chp" id="amount-2"><?php echo $QuizLvl2Count; ?></h2>
            <a href="a6_QuizManagement.php?level=2" id="redirect-2"> > </a>
            <div class="divide-text-2"></div>
            <h2 class="level-chapters" id="level-3-chp">Level 3:</h2>
            <h2 class="level-chp" id="amount-3"><?php echo $QuizLvl3Count; ?></h2>
            <a href="a6_QuizManagement.php?level=3" id="redirect-3"> > </a>
        </div>
    </section>
    

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const headerDropdown = document.querySelector('.header-dropdown');
            const dropdownMenu = document.querySelector('.dropdown-menu');
            const profileDropdownMenu = document.querySelector('.profile-dropdown-menu');

            let isHoveringDropdown = false;
            let isHoveringProfile = false;

            function handleDropdownMouseEnter() {
                isHoveringDropdown = true;
                dropdownMenu.style.display = 'block';
            }

            function handleDropdownMouseLeave() {
                isHoveringDropdown = false;
                setTimeout(() => {
                    if (!isHoveringDropdown && !isHoveringProfile) {
                        dropdownMenu.style.display = 'none';
                    }
                }, 300); // delay to allow hover action on the dropdown
            }

            function handleProfileMouseEnter() {
                isHoveringProfile = true;
                profileDropdownMenu.style.display = 'block';
                dropdownMenu.style.display = 'none'; // Hide other dropdowns
            }

            function handleProfileMouseLeave() {
                isHoveringProfile = false;
                setTimeout(() => {
                    if (!isHoveringDropdown && !isHoveringProfile) {
                        profileDropdownMenu.style.display = 'none';
                    }
                }, 300); // delay to allow hover action on the dropdown
            }

            headerDropdown.addEventListener('mouseenter', handleDropdownMouseEnter);
            headerDropdown.addEventListener('mouseleave', handleDropdownMouseLeave);

            dropdownMenu.addEventListener('mouseenter', () => isHoveringDropdown = true);
            dropdownMenu.addEventListener('mouseleave', handleDropdownMouseLeave);

            profileDropdownMenu.addEventListener('mouseenter', () => isHoveringProfile = true);
            profileDropdownMenu.addEventListener('mouseleave', handleProfileMouseLeave);

            // Handle profile icon hover
            document.querySelector('.profile-icon').addEventListener('mouseenter', handleProfileMouseEnter);
            document.querySelector('.profile-icon').addEventListener('mouseleave', handleProfileMouseLeave);
        });
        function updateDateAndDay() {
            const today = new Date();

            // Define options for date formatting
            const dateOptions = { day: 'numeric', month: 'long', year: 'numeric' };
            const dayOptions = { weekday: 'long' };

            // Format the date and day
            const formattedDate = today.toLocaleDateString('en-US', dateOptions);
            const formattedDay = today.toLocaleDateString('en-US', dayOptions);

            // Update the HTML elements
            document.getElementById('date-text').textContent = formattedDate;
            document.getElementById('day-text').textContent = formattedDay;
        }

        // Call the function to update date and day when the page loads
        updateDateAndDay();
    </script>
</body>
</html>