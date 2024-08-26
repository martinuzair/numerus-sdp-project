<?php
include 'includes/header.php';
include 'includes/config_session.inc.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Children Registration</title>

    <style>
        *, *::before, *::after{
            box-sizing: border-box;
        }

        body{
            background-image: linear-gradient(to right, var(--colour1), var(--colour2));
            padding: 0; margin: 0;
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

        .title {
            display: flex;
            width: 100%;
            height: auto;
            justify-content: center;

        }
        
        .title_box{
            margin-top: 3rem;
            width: 50%;
            padding: 1rem;
            background: var(--colour5);
            border-radius: 2rem;
            text-align: center;
            color: var(--colour1);
            box-shadow: var(--shadowcombined);
        }

        .registration_card{
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
            width: 75%; 
            height: 90vh;
            margin: 0 auto;
            margin-bottom: 2rem;
            border-radius: 2rem;
            border-collapse: collapse;
            background-color: var(--colour4);
            margin-top: 30px;
            box-shadow: var(--shadowcombined);
            color: var(--colour1);
        }

        .account_details {
            margin-top: 2rem;
            display: flex;
            flex-direction: column;
            width: 40%;
            align-items: center;
            padding: 1rem;
        }
        
        .personal_information {
            margin-top: 2rem;
            display: flex;
            flex-direction: column;
            width: 60%;

            align-items: center;
            padding: 1rem;
        }

        .personal_information h3{
            margin-bottom: 5rem;
        }

        .account_details input, .personal_information input, .personal_information select {
            width: 70%;
            margin-bottom: 1rem;
            padding: 1rem;
            margin: 1rem;
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
        }

        .account_details img {
            width: 50%;
            aspect-ratio: 1;
            border-radius: 10px;
            margin-bottom: 1rem;
            background-color: var(--colour8);
        }

        .register_button {
            margin-top: 2rem;
            
            padding: 0.5rem 1rem;
            background-color: var(--colour3);
            color: var(--colour1);
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
            cursor: pointer;
            font: var(--links);
        }

        .register_button:hover {
            background-color: var(--colour5);
        }

        .separator {
            height: 90%;
            width: 2px;
            background-color: white;
            margin: 1rem 0;
        }

        .button1{
            margin-top: 2rem;
            
            padding: 0.5rem 1rem;
            background-color: var(--colour3);
            color: var(--colour1);
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
            cursor: pointer;
            font: var(--links);

        }
    </style>
</head>
<body>
<div class="title">
        <div class="title_box">
            <h2>Children Registration</h2>
        </div>
    </div>

    <section class="content">
        <form class="registration_card" method="post" action="includes/c_registration.php" onsubmit="return validateForm()">
            <div class="account_details">
            <button type="button" onclick="openAvatarModal()" class="button1">Choose an avatar</button>

            <!-- Selected Avatar Display -->
            <div id="selectedAvatar" style="margin-top: 20px;">
                <p>No avatar selected.</p>
            </div>

            <!-- The Modal -->
            <div id="avatarModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeAvatarModal()">&times;</span>
                    <div id="avatarContainer">
                        <!-- Avatars will be dynamically loaded here -->
                    </div>
                </div>
            </div>

                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            </div>

            <div class="separator"></div>

            <div class="personal_information">
                <h3>Personal Information</h3>

                <?php
                if(isset($_SESSION['success_msg'])){
                        echo '<p class="success_msg">' . htmlspecialchars($_SESSION['success_msg']) . '</p>';
                        unset($_SESSION['success_msg']);
                    }
                
                if(isset($_SESSION['error_registration'])){
                    $errors = $_SESSION["error_registration"];
    
                        echo '<br>';
    
                        foreach($errors as $error){
                            echo '<p class="form_error">' . $error . '</p>';
                        }
    
                    unset($_SESSION['error_registration']);
                }
                ?>

                <input type="text" name="fullname" placeholder="Name based on IC" required>
                <input type="text" name="nric" placeholder="Identification Card Number" required>
                <select name="gender" required>
                    <option value="" disabled selected>Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <input type="date" name="dob" placeholder="Date of Birth" required>
                <button type="submit" class="register_button">Register</button>
            </div>

        </form>
    </section>
    <script>
        function openAvatarModal() {
    document.getElementById("avatarModal").style.display = "block";
    fetch('fetchavatar.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById("avatarContainer").innerHTML = data;
        })
        .catch(error => console.error('Error fetching avatars:', error));
}

function closeAvatarModal() {
    document.getElementById("avatarModal").style.display = "none";
}

function selectAvatar(imageFilename, imageID) {
    // Update the selected avatar display area
    const selectedAvatarDiv = document.getElementById("selectedAvatar");
    selectedAvatarDiv.innerHTML = `
        <h3>Selected Avatar:</h3>
        <center><img src="/Children2/avatar/${imageFilename}"style="width:200px;height:200px;border-radius:50%;"></center>
        <input type="hidden" name="imageID" id="avatarID" value="${imageID}" required></input>

    
    `;
    
    // Close the modal
    closeAvatarModal();
    console.log("Image ID", $imageID);
}
function validateForm() {
            const avatarID = document.getElementById("avatarID") ? document.getElementById("avatarID").value : '';
            if (!avatarID) {
                alert("Please select an avatar.");
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }

        

    </script>
</body>