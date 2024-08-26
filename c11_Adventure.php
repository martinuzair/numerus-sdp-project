<?php
require 'includes/numerusdatabase.php'; // Include your database connection file
require 'includes/config_session.inc.php';

$child_id = isset($_SESSION['child_ID']) ? $_SESSION['child_ID'] :null;
$level = isset($_GET['level']) ? intval($_GET['level']) : 1;

// Store Child_ID in session
$_SESSION['child_ID'] = $child_id;
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Adventure.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Wendy+One&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Adventure Home Page</title>
</head>
<body>
    <div>
        <h1 class="title">
            Adventure Game
        </h1>
        <div class="Adventure-container">
            <h2 class="Adventure">
                Adventure Game
            </h2>
        </div>
    </div>
    <div class="message-container">
        <p class="message">
            
                Be Ready....
                <br>
                For the final Challenge!!!
                   
        </p>
    </div>
    <div class="proceed-container">
        <p>PLAY</p>
        <button type="button" value="Proceed" name="Play" onclick="window.location.href='game.php?level=<?php echo $level; ?>'">
            <img src="image/proceed.png" alt="">
        </button>
    </div>
    <div>
        <img src="image/Knight.png">
        <img src="image/Symbols.png">
    </div>
</body>
</html>