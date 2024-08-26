<?php
require 'includes/numerusdatabase.php'; // Include your database connection file
require 'includes/config_session.inc.php';

$child_id = isset($_SESSION['child_ID']) ? $_SESSION['child_ID'] :null;
$level = isset($_GET['level']) ? intval($_GET['level']) : 1;

// Define the URLs for each level
$gameUrls = [
    1 => "https://scratch.mit.edu/projects/1056113802/embed",
    2 => "https://scratch.mit.edu/projects/1056144181/embed",
    3 => "https://scratch.mit.edu/projects/1053358253/embed"
];

$gameUrl = isset($gameUrls[$level]) ? $gameUrls[$level] : $gameUrls[1];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adventure Game 1</title>
    <link rel="stylesheet" href="CSS/game.css"> 
</head>
<body>
    <div class="col-md-12 text-center">
        <center><h3 class="animate-charcter">Adventure Game</h3></center>
    </div>
    <p>Be sure to finish the game to wrap it all up perfectly!</p>
    <p>Hit that stop button in the top left corner to end the game!</p>
    <center><button class="modern-button" onclick="scrollToSection('game')">Click me!</button></center>

    <div class="container">
        <iframe src="<?php echo $gameUrl; ?>" id="game" allowtransparency="true" width="485" height="402" frameborder="0" scrolling="no" allowfullscreen></iframe>
    </div>
    
    <button class="button" onclick="goBack(<?php echo $level; ?>)">
        Back
        <span class="tooltip-text">Continue exploring</span>
    </button>
    
    <button class="button" onclick="finishGame(<?php echo $level; ?>)">
        Finish
        <span class="tooltip-text">Complete the game</span>
    </button>
    
    <script>
        function scrollToSection(sectionId) {
            var section = document.getElementById(sectionId);
            if (section) {
                section.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        function goBack(level) {
            window.location.href = `c5_learningLevels.php?level=${level}`;
        }

        function finishGame(level) {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `complete_task.php?id=${level}&type=game`, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    window.location.href = `c5_learningLevels.php?level=${level}`;
                } else {
                    alert("An error occurred while marking the game as completed.");
                }
            };
            xhr.send();
        }
    </script>
</body>
</html>
