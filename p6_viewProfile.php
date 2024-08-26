<?php
include 'includes/header.php';
require_once 'includes/p6_viewParent_profile.php';
//require_once 'includes/p6_editParent_profile.php';
$editMode = isset($_GET['edit']) && $_GET['edit'] === 'true';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>View Parent Profile</title>

    <style>
        *, *::before, *::after{
            box-sizing: border-box;
        }

        body{
            background-image: linear-gradient(to right, var(--colour1), var(--colour2));
            padding: 0; margin: 0;
        }

        .content{
            padding-top: 2rem;
        }

        .title{
            padding-left: 2rem;
        }

        h1 {
        font: var(--h1);
        margin-top: .5rem;
        }

        h2 {
            font: var(--h2);
            margin-top: .5rem;
        }

        h3 {
            font: var(--h3);
            margin-top: .3rem;
        }

        a {
            font: var(--links);
            margin-top: .3rem;
        }

        p {
            font: var(--p);
            margin-top: .3rem;
        }

        .profile_card{
            display: flex;
            flex-direction: column;
            justify-content: start;
            align-items: center;
            width: 75%; 
            height: auto;
            margin: 0 auto;
            margin-bottom: 2rem;
            border-radius: 2rem;
            border-collapse: collapse;
            background-color: #F3797E;
            margin-top: 30px;
            box-shadow: var(--shadowcombined);
            color: var(--colour1);
            padding-bottom: 2rem;
        }

        .profile_header {
            margin-top: 2rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .separator {
            width: 100%;
            height: 2px;
            background-color: white;
            margin: 1rem 0;
        }

        form{
            display: contents;
            flex-direction: column;
            justify-content: space-around;
            padding: 1rem;
            width: 100%;
            margin: 0 auto;       
        }

        form .profile_details {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            width: 60%;
            padding: 1rem;
        }

        form .profile_details input, form .profile_details select{
            font: var(--p);
            margin: 0.5rem 0;
            background-color: white; 
            color: black; 
            padding: 0.5rem;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
        }

        .edit_button, .cancel_button {

            width: 9rem;
            margin-top: 2rem;
            padding: 0.5rem 1rem;
            background-color: var(--colour5);
            color: var(--colour1);
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
            cursor: pointer;
            font: var(--links);
        }

        .edit_button:hover , .cancel_button:hover {
            background-color: var(--colour8);
        }
    </style>
</head>
<body>
    <section class="content">
        <div class="profile_card">
            <div class="profile_header">
                <h2>Parent</h2>

            </div>
            <?php //echo "Parent ID: " . $_SESSION['parent_ID']; ?>
            <div class="separator"></div>

                <form action="<?php echo $editMode ? 'includes/p6_editParent_profile.php' : ''; ?>" method="<?php echo $editMode ? 'post' : 'get'; ?>">

                    <div class="profile_details">
                        <label for="name">Name:</label><input type="text" name="name" value="<?php echo isset($name) ? $name : ''; ?>" 
                            <?php echo $editMode ? 'readonly' : 'readonly'; ?> placeholder="Name" required>
                        <label for="name">Identification Card Number:</label>
                        <input type="text" name="nric" value="<?php echo isset($nric) ? $nric : '';?>" 
                            <?php echo $editMode ? 'readonly' : 'readonly'; ?> placeholder="Identity Card Number" required>
                        <label for="name">Date of Birth:</label>
                        <input type="date" name="dob" value="<?php echo isset($dob) ? $dob : ''; ?>" 
                            <?php echo $editMode ? 'readonly' : 'readonly'; ?> placeholder="Date of Birth" required>
                            <label for="name">Gender:</label>
                            <select name="gender" disabled>
                            <option value="male" <?php echo isset($gender) && $gender === 'male' ? 'selected' : ''; ?>>Male</option>
                            <option value="female" <?php echo isset($gender) && $gender === 'female' ? 'selected' : ''; ?>>Female</option>
                        </select>
                        <label for="name">Mobile Phone:</label>
                        <input type="text" name="telephone" value="<?php echo isset($telephone) ? $telephone : ''; ?>" 
                            <?php echo $editMode ? '' : 'readonly'; ?> placeholder="Phone Number" required>
                        <label for="name">E-mail:</label>
                        <input type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" 
                            <?php echo $editMode ? 'readonly' : 'readonly'; ?> placeholder="Email" required>
                        <label for="name">Password:</label>
                        <input type="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>" 
                            <?php echo $editMode ? '' : 'readonly'; ?> placeholder="Password" required>

                        <?php
                        if(isset($_SESSION['success_msg'])){
                            echo '<p class="success_msg">' . htmlspecialchars($_SESSION['success_msg']) . '</p>';
                            unset($_SESSION['success_msg']);
                        }
                        ?>
                    </div>

                    <div>
                    <?php if(!$editMode): ?>
                        <button type="submit" name="edit" value="true" class="edit_button">Edit</button>
                    <?php else: ?>
                        <button type="submit" name="edit"  class="edit_button">Save Edit</button>
                        <button type="button" id="cancel_button" class="cancel_button" onclick="window.history.back();">Cancel</button>

                    </div>
                    <?php endif; ?>
                </form>
        </div>
    </section>
</body>
</html>
<!-- <div class="profile_details">
                    <input type="text" name="name" value="<?php echo isset($name) ? $name :''; ?>" placeholder="Name" required>
                    <input type="text" name="identity_card_number" value="<?php echo isset($nric) ? $nric : '';?>" placeholder="Identity Card Number" required>
                    <input type="date" name="date_of_birth" value="<?php echo isset($dob) ? $dob : ''; ?>" placeholder="Date of Birth" required>
                    <select name="gender" value="<?php echo isset($gender) ? $gender : ''; ?>" required>
                        <option value="male" selected>Male</option>
                        <option value="female">Female</option>
                    </select>
                    <input type="text" name="phone_number" value="<?php echo isset($telephone) ? $telepohone : ''; ?>" placeholder="Phone Number" required>
                    <input type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" placeholder="Email" required>
                    <input type="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>" placeholder="Password" required>
                </div> -->