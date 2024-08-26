<?php
require_once 'includes/a2_userManagement.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management Page</title>
    <link rel="stylesheet" href="CSS/design.css">
</head>
<body>
<div class="unscrollable-page">
    <?php include "includes/adminheader.php"?>
        <center>
            <div class="searchbar-box">
                <form action="a2_userManagement.php" method="POST">
                    <input type="text" name="search_email" class="searchbar-input" placeholder="Enter user email to Search">
                    <button type="submit">Search</button>
                </form>
            </div>
        
            <div class="scrollable-box">
                <?php 
                if(!empty($profiles)){
                    foreach($profiles as $profile){
                        if($profile['role'] === 'Children'){
                            echo '<a href="a3_viewProgression.php?Child_ID=' . htmlspecialchars($profile['Child_ID']) . '">';
                        }
                        echo '<div class="accountprofile-box">';
                        echo '<div class="profilename-text">' . htmlspecialchars("Name: " . $profile['Name']) . '</div>';
                        echo '<div class="profilerole-text">' . htmlspecialchars("Role: " . $profile['role']) . '</div>';
                        echo '<div class="profileemail-text">' . htmlspecialchars("Email: " . $profile['Email']) . '</div>';

                        if($profile['role'] === 'Parent'){
                            echo '<div class="profilenric-text">' . htmlspecialchars("IC: " . $profile['nric']) . '</div>';
                            echo '<div class="profilephone-text">' . htmlspecialchars("Phone Number:" . $profile['phone']) . '</div>';
                        } elseif($profile['role'] === 'Children'){
                            echo '<div class="profilenric-text">' . htmlspecialchars("IC: " . $profile['nric']) . '</div>';
                            echo '<div class="profileparentid-text">' . htmlspecialchars("Parent ID:" . $profile['Parent_id']) . '</div>';
                        }
                        echo '</div>';
                        if($profile['role'] === 'Children'){
                            echo '</a>';
                        }
                    }
                } else {
                    echo '<p> No profiles found! </p>';
                }
                ?>
            </div>
        </center>
    </div>

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
    </script>
</body>
</html>