<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="CSS/kidheader.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Creepster&display=swap" rel="stylesheet">
    <style>
        *{
  font-family: "Lilita One", sans-serif;
  font-weight: 400;
  font-style: normal;
}

body {
  font-family: "Lilita One", sans-serif;
  font-weight: 400;
  font-style: normal;
  background: linear-gradient(#ffffff 0%,#0072C6 16%, #0072C6 100%);
  background-repeat:no-repeat;
  background-position: center;
  background-size: cover;
  overflow-x: hidden;
  background-attachment: fixed;
  height: 580vh;
}
    </style>
        
</head>
<body>
<div class="header">
        <div class="logo">
            <a href="c1_childMain.php">
                <img src="image/Logo.png" alt="Logo">
            </a>
        </div>
    
        
            <nav>
                <ul>
                    <li>
                        <a href="c5_learningLevels.php">Learning Levels</a>
                        <ul class="levelDropDown">
                            <li><a href="c5_learningLevels.php?level=1" style="background-color: #F3CB00;">Level 1</a></li>
                            <li><a href="c5_learningLevels.php?level=2" style="background-color: #FA8E30;">Level 2</a></li>
                            <li><a href="c5_learningLevels.php?level=3" style="background-color: #F04B28;">Level 3</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="profile-menu">
                <a href="c12_cprofile.php">
                    <img src="image/profile.png" alt="Profile">
                </a>
                <div class="profile-dropdown">
                    <a href="c12_cprofile.php" style="background-color: #F3CB00;">View Profile</a>
                    <a href="includes/logOut.inc.php" style="background-color: #FA8E30;">Logout</a>
            </div>
    </div>
    </div>
</body>
</html>