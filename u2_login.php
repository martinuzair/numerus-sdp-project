<?php 
require_once 'includes/config_session.inc.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login&Register</title>
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div id="bg-wrap">
        <svg viewBox="0 0 100 100" preserveAspectRatio="xMidYMid slice">
        <defs>
        <radialGradient id="Gradient1" cx="50%" cy="50%" fx="0.441602%" fy="50%" r=".5"><animate attributeName="fx" dur="34s" values="0%;3%;0%" repeatCount="indefinite"></animate><stop offset="0%" stop-color="rgba(255, 0, 255, 1)"></stop><stop offset="100%" stop-color="rgba(255, 0, 255, 0)"></stop></radialGradient>
        <radialGradient id="Gradient2" cx="50%" cy="50%" fx="2.68147%" fy="50%" r=".5"><animate attributeName="fx" dur="23.5s" values="0%;3%;0%" repeatCount="indefinite"></animate><stop offset="0%" stop-color="rgba(255, 255, 0, 1)"></stop><stop offset="100%" stop-color="rgba(255, 255, 0, 0)"></stop></radialGradient>
        <radialGradient id="Gradient3" cx="50%" cy="50%" fx="0.836536%" fy="50%" r=".5"><animate attributeName="fx" dur="21.5s" values="0%;3%;0%" repeatCount="indefinite"></animate><stop offset="0%" stop-color="rgba(0, 255, 255, 1)"></stop><stop offset="100%" stop-color="rgba(0, 255, 255, 0)"></stop></radialGradient>
        <radialGradient id="Gradient4" cx="50%" cy="50%" fx="4.56417%" fy="50%" r=".5"><animate attributeName="fx" dur="23s" values="0%;5%;0%" repeatCount="indefinite"></animate><stop offset="0%" stop-color="rgba(0, 255, 0, 1)"></stop><stop offset="100%" stop-color="rgba(0, 255, 0, 0)"></stop></radialGradient>
        <radialGradient id="Gradient5" cx="50%" cy="50%" fx="2.65405%" fy="50%" r=".5"><animate attributeName="fx" dur="24.5s" values="0%;5%;0%" repeatCount="indefinite"></animate><stop offset="0%" stop-color="rgba(0,0,255, 1)"></stop><stop offset="100%" stop-color="rgba(0,0,255, 0)"></stop></radialGradient>
        <radialGradient id="Gradient6" cx="50%" cy="50%" fx="0.981338%" fy="50%" r=".5"><animate attributeName="fx" dur="25.5s" values="0%;5%;0%" repeatCount="indefinite"></animate><stop offset="0%" stop-color="rgba(255,0,0, 1)"></stop><stop offset="100%" stop-color="rgba(255,0,0, 0)"></stop></radialGradient>
        </defs>
        <rect x="13.744%" y="1.18473%" width="70%" height="70%" fill="url(#Gradient1)" transform="rotate(334.41 50 50)"><animate attributeName="x" dur="20s" values="25%;0%;25%" repeatCount="indefinite"></animate><animate attributeName="y" dur="21s" values="0%;25%;0%" repeatCount="indefinite"></animate><animateTransform attributeName="transform" type="rotate" from="0 50 50" to="360 50 50" dur="7s" repeatCount="indefinite"></animateTransform></rect>
        <rect x="-2.17916%" y="35.4267%" width="70%" height="70%" fill="url(#Gradient2)" transform="rotate(255.072 50 50)"><animate attributeName="x" dur="23s" values="-25%;0%;-25%" repeatCount="indefinite"></animate><animate attributeName="y" dur="24s" values="0%;50%;0%" repeatCount="indefinite"></animate><animateTransform attributeName="transform" type="rotate" from="0 50 50" to="360 50 50" dur="12s" repeatCount="indefinite"></animateTransform>
        </rect>
        <rect x="9.00483%" y="14.5733%" width="70%" height="70%" fill="url(#Gradient3)" transform="rotate(139.903 50 50)"><animate attributeName="x" dur="25s" values="0%;25%;0%" repeatCount="indefinite"></animate><animate attributeName="y" dur="12s" values="0%;25%;0%" repeatCount="indefinite"></animate><animateTransform attributeName="transform" type="rotate" from="360 50 50" to="0 50 50" dur="9s" repeatCount="indefinite"></animateTransform>
        </rect>
        </svg>
    </div>
    <div class="wrapper">
        <nav class="nav">
            <div class="nav-logo">
                <img src="image/Logo.png" alt="logo" class="logo">
            </div>
            <div class="nav-menu">
                <ul>
                    <li><a href="index.php" class="link active">Home</a></li>
                </ul>
            </div>
            <div class="nav-button">
                <button class="btn white-btn" id="loginBtn" onclick="login()">Sign In</button>
                <button class="btn" id="registerBtn" onclick="register()">Sign Up</button>
            </div>
        </nav>

        <div class="form-box">
            <div class="login-container" id="login">
                <div class="top">
                    <header>Login</header>

                    <?php
                    if(isset($_SESSION['success_msg'])){
                        echo '<p class="success_msg">' . htmlspecialchars($_SESSION['success_msg']) . '</p>';
                        unset($_SESSION['success_msg']);
                    }

                    if(isset($_SESSION['login_error'])){
                        echo '<p class="success_msg">' . htmlspecialchars($_SESSION['login_error']) . '</p>';
                        unset($_SESSION['login_error']);
                    }
                    ?>

                </div>          
                <div class="input-box">
                    <form action="includes/login.php" method="post">
                        <input type="email" class="input-field" name="email" placeholder="Email" required>
                        <i class="bx bx-user"></i>
                    
                        <input type="password" class="input-field" name="password" placeholder="Password" required>
                        <i class="bx bx-lock-alt"></i>
                    
                        <input type="submit" class="submit" value="Log In">
                    </form>
                </div>
                <div class="buttom">
                    <span>Don't have an account?<a href="#" onclick="register()">Sign Up</a></span>
                </div>
            </div>

            <div class="register-container" id="register">
                <div class="top">
                    <header>Sign Up</header>
                </div>

                <form action="includes/u2_signup.php" method="post">
                    <div class="input-box"> 
                        <input type="text" id="fullname" name="fullname" class="input-field" placeholder="Full Name based on IC" required>
                        <i class="bx bx-user"></i>
                    
                
                        <input type="text" name="email" class="input-field" placeholder="Email" required>
                        <i class="bx bx-envelope"></i>
                    
                    
                        <input type="password" name="password" class="input-field" placeholder="Password" required>
                        <i class="bx bx-lock-alt"></i>
                    
                    
                        <input type="text" name="nric" class="input-field" placeholder="Identification Card Number" required>
                        <i class="bx bx-id-card"></i>
                    
                    
                        <input type="tel" name="telephone" class="input-field" placeholder="Phone Number" required>
                        <i class="bx bx-phone"></i>
                    </div>

                    <div class="two-forms">
                        <div class="input-box">
                            <label for="gender" class="class"></label>
                                <select name="gender" id="gender" class="input-field" required>
                                <option value="male" disabled selected value>Gender</option>    
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <i class='bx bx-male-female'></i>
                        </div>
                        <div class="input-box">
                            <input type="date" id="dob" name="dob" class="input-field" placeholder="Date of Birth" required>
                            
                        </div> 
                    </div>

                    <?php

                    if(isset($_SESSION['error_registration'])){
                        $errors = $_SESSION["error_registration"];
        
                            echo '<br>';
        
                            foreach($errors as $error){
                                echo '<p class="form_error">' . $error . '</p>';
                            }
        
                        unset($_SESSION['error_registration']);
                    }
                    if(isset($_SESSION['success_msg'])){
                        echo '<p class="success_msg">' . htmlspecialchars($_SESSION['success_msg']) . '</p>';
                        unset($_SESSION['success_msg']);
                    }
                    ?>

                    <div class="input-box">
                        <input type="submit" class="submit" value="Register">
                    </div>
                </form>

                <div class="buttom">
                    <span>Have an account?<a href="u2_login.php" onclick="login()">Login</a></span>
                </div>
            </div>
        </div>
    </div>

    <script>
        var a = document.getElementById('loginBtn');
        var b = document.getElementById('registerBtn');
        var x = document.getElementById('login');
        var y = document.getElementById('register');

        function login(){
            x.style.left="4px";
            y.style.right="-520px";
            a.className += " white-btn";
            b.className="btn";
            x.style.opacity=1;
            y.style.opacity=0;
        }

        function register(){
            x.style.left= "-520px";
            y.style.right= "5px";
            a.className ="btn";
            b.className += " white-btn";
            x.style.opacity=0;
            y.style.opacity=1;
        }

    </script>
</body>
</html>