<?php

require_once 'includes/a8_viewAdmin_profile.php';
require_once 'aheader.php';
$editMode = isset($_GET['edit']) && $_GET['edit'] === 'true';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Menu</title>
    <link rel="stylesheet" href="CSS/design.css">
</head>
<body>
 
    
    <div class="unscrollable-page">
        <center>
            <div class="profile-box">
                <div class="profile-header">
                    <form action="<?php echo $editMode ? 'includes/a8_editAdmin.profile.php' : ''; ?>" method="<?php echo $editMode ? 'post' : 'get'; ?>">
                        <h1>ADMIN</h1>
                        </div>
                        <h2>Name:</h2>
                        
                        <div class="profile-name"><?php echo isset($name) ? $name :'' ;?></div>
                        
                        <h2>Email:</h2>
                        <input class="email-box" type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" 
                            <?php echo $editMode ? 'readonly' : 'readonly'; ?> placeholder="Email" required>
                        <h2>Password</h2>
                        <input class="password-box" type="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>" 
                            <?php echo $editMode ? '' : 'readonly'; ?> placeholder="Password" required>
                        <?php
                        if(isset($_SESSION['success_msg'])){
                            echo '<p class="success_msg">' . htmlspecialchars($_SESSION['success_msg']) . '</p>';
                            unset($_SESSION['success_msg']);
                        }
                        ?>
                        <div>
                        <?php if(!$editMode): ?>
                            <button type="submit" name="edit" value="true" class="edit_button">Edit</button>
                        <?php else: ?>
                            <button type="submit" name="edit"  class="edit_button">Save Edit</button>
                        </div>
                        <?php endif; ?>
                    </form>
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




