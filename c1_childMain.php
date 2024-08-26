<?php
require 'includes/config_session.inc.php';
require 'includes/numerusdatabase.php';

$childID = isset($_SESSION['child_ID']) ? $_SESSION['child_ID'] :null;
$childName ='';
if ($childID){
$sql = "SELECT Name FROM child WHERE Child_ID = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$childID]);
$children = $stmt->fetch(PDO::FETCH_ASSOC);
$childName = $children['Name'];

}else{
    echo("No id provided");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="CSS/childMain.css"> 
    <link rel="stylesheet" href="CSS/kidheader.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Creepster&display=swap" rel="stylesheet">
    
</head>
<body>
    <?php include "includes/cheader.php" ?>
    <div class="page1">
        <div class="title">
            
            <h2 class="main">Math Explorers: <?php echo $childName?></h2>
            <h2>Journey To <br>Numberland</h2>
            <button onclick="scrollToSection('page-3')">Get into the adventure!</button>
        </div>
        
        <div class="container">
            <img src="image/girl.png" class="girl-image">
            <img src="image/castle.png" class="castle-image" >
        </div>
        <img src="image/math.png" class="math-image">
        <img src="image/color.png" class="color-image">
    </div>
    <div class="page3">
        <div class="bg">
            <div class="bubbles">
                <span style="--i:11">+</span>
                <span style="--i:12">-</span>
                <span style="--i:24">÷</span>
                <span style="--i:19">x</span>
                <span style="--i:20">≈</span>
                <span style="--i:17">()</span>
                <span style="--i:22">=</span>
                <span style="--i:27">√a</span>
                <span style="--i:16">%</span>
            </div>
        </div>
        <div class="intro" id="page-3">
            <h1>Dark clouds gathered over the land, <br>and a Math Rainstorm began.</h1>
            <img src="image/run.png" class="run-image">
        </div>
    </div>

    <div class="page4">
        <div class="storm-effect">
            <img src="image/storm1.png" class="storm-image" >
            
            <br>
            <h1 class="title">They are swirled into adventures...</h1>
        </div>
    </div>
    
    <div class="page5">
        <div class="carousel">
            <div class="list">
                <div class="item">
                    <img src="image/one.jpg">
                    <div class="content">
                        <div class="des">
                            In the darkened realm of the Numberland, they confront exceptionally difficult challlenges.
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="image/two.jpg">
                    <div class="content">
                        <div class="des">
                            In the darkened realm of the Numberland, they confront exceptionally difficult challlenges.
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="image/three.png">
                    <div class="content">
                        <div class="des">
                            In the darkened realm of the Numberland, they confront exceptionally difficult challlenges.
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="image/four.png">
                    <div class="content">
                        <div class="des">
                            In the darkened realm of the Numberland, they confront exceptionally difficult challlenges.
                        </div>
                    </div>
                </div>
            </div>
                <div class="thumbnail">
                    <div class="thumb-item">
                        <img src="image/two.jpg">
                    </div>
                    <div class="thumb-item">
                        <img src="image/three.png">
                    </div>
                    <div class="thumb-item">
                        <img src="image/four.png">
                    </div>
                    <div class="thumb-item">
                        <img src="image/one.jpg">
                    </div>
                </div>
                <div class="arrows">
                    <button id="prev"><</button>
                    <button id="next">></button>
                </div>
            
            </div>
    </div>
    <div class="page6">
        <div class="girl">
        </div>
        <h1>With determination, <br> they discovered a tool <br>that illuminates the brilliance of the kingdom.</h1>
    </div>
    <div class="page7">
        <a href="c5_learningLevels.php">
            <button>Get started!</button>
        </a>
        <div class="spotlight"></div>
        <h1>lighting the way for <br>Kids with Dyscalculia</h1>
    </div>

    <script src="main.js">
        
      </script>
</body>
</html>