<?php
require_once 'includes/numerusdatabase.php';
require_once 'includes/config_session.inc.php';
$result = $_SESSION['score'];
$child_id = $_SESSION['child_ID'];

$query = "SELECT COUNT(*) FROM assess_question";
$stmt = $pdo->prepare($query);
$stmt->execute();
$total_questions = $stmt->fetchColumn();

$score = isset($result) ? $result : 0;
$percentage = ($result/$total_questions) * 100 ;

$query = "INSERT into assess_result(Child_ID, Result) VALUES (:Child_ID, :Result) ";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":Child_ID", $child_id, PDO::PARAM_INT);
$stmt->bindParam(":Result", $percentage, PDO::PARAM_STR);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/assresult.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
</head>
<body>
    <div class="header">
        <div class="logo">
            <a href="c1_childMain.php">
                <img src="image/Logo.png" alt="Logo">
            </a>
        </div>
        <div class="title">
            Assessment Result
        </div>
    </div>
    <h3>Your marks</h3>
    <?php //echo $result;//?>
    <h1><?php echo number_format($percentage, 2) . '%'; ?></h1>
    <div class="title">
        <h2>Recommended level:</h2>
        <?php 
            if($percentage >= 70){
                echo '<h2 class="box"> Level 3 </h2>'; 
                echo '<p class="des"> Good job! You are doing well, but there are room for improvement. </p>';
            }elseif($percentage >= 40){
                echo '<h2 class="box"> Level 2 </h2>'; 
                echo '<p class="des"> Fair effort, but you should focus on understanding the concepts better. </p>';
            }elseif($percentage < 40){
                echo '<h2 class="box"> Level 1 </h2>';
                echo '<p class="des"> It seems you had some difficulties. Let us start from the basics. </p>';
            }
            
        ?>
        
    </div>
    
    <img src="image/show.png" class="show">
    <div class="action">
        <a href="c1_childMain.php">
            <button>Proceed</button>
        </a>
        
    </div>

    
    
</body>
</html>