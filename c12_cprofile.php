<?php
require_once 'includes/c12_viewChild_profile.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Menu</title>
    <link rel="stylesheet" href="CSS/profile.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">

</head>
<body>
<?php include "includes/cheader_for_profile.php" ?>
<div class="profile_card">
    <div class="profile_header">
        <div class="rounded-bar"></div>

        <h2>STUDENT</h2>

     </div>
    <div class="name">
        <h1><?php echo isset($name) ? $name: ''; ?></h1>
    </div>
    <div class="dob">
        <h1><?php echo isset($dob) ? $dob: '' ?></h1>
    </div>
    <div class="avatar">
     <button type="button">
         <img src="/Children2/avatar/<?php echo isset($avatar) ? $avatar: '' ?>" alt="Avatar" id="currentAvatar">
    </button>

    <div class="details">
        <h1>Email</h1>
        <h2><?php echo isset($email) ? $email: '' ?></h2>
            <h1>Password</h1>
        <h2> <?php echo isset($password) ? str_repeat('*', strlen($password)) : ''; ?></h2>
        <h1>IC Number </h1>
        <h2><?php echo isset($nric) ? $nric: '' ?></h2>
        <h1>Parent's Name</h1>
        <h2><?php echo isset($parent_name) ? $parent_name: '' ?></h2>
    </div>
</div>
<button type="button" id="openAvatarModal">
    <img src="image/inventory.png" alt="Open Avatar Modal">
</button>

    <!-- <div id="Modal" class="modal">
        <div class="modal-content">
            <span class="close" id="closePasswordModal">&times;</span>
            <h2>Update Password</h2>
            <form id="passwordForm">
                <label for="newPassword">New Password:</label>
                <input type="password" id="newPassword" name="newPassword" required>
                <br>
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
                <br>
                <button type="submit">Update</button>
            </form>
        </div>
    </div> -->
    
    </div>
    <div id="popup" class="modal">
            <div class="modal-content" id="avatarModal" >
                <span id="closeAvatar" class="close">&times;</span>
                <h2>Select Avatar</h2>
                <div id="avatars-container" class="avatarList"></div>
                <button id="update_avatar">Update Avatar</button>
            </div>
        </div>
    
</div>
</div>
</div>
    <script src="profile.js">
    
    </script>
        
</body>
</html>
