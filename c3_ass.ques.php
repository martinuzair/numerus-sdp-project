<?php
require_once 'includes/c3_ass.ques.inc.php';
require_once 'includes/numerusdatabase.php';
require_once 'includes/config_session.inc.php';

$number = (int)$_GET['n'];
// Selecting total number of questions
$query = "SELECT COUNT(*) FROM assess_question";
$stmt = $pdo->prepare($query);
$stmt->execute();

$total = $stmt->fetchColumn();



// Fetch the question data
$query = "SELECT Ques_ID, Ques_Text, URL FROM assess_question WHERE Ques_ID = :number";
$stmt = $pdo->prepare($query);
$stmt->execute(['number' => $number]);
$question = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch the choices for the current question
$query = "SELECT Choice_ID, Choice_Text, Answer FROM assess_choice WHERE Ques_ID = :number";
$stmt = $pdo->prepare($query);
$stmt->execute(['number' => $number]);
$choices = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessment</title>
    <link rel="stylesheet" href="CSS/ass.ques.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="image/Logo.png" alt="Logo">
        </div>
        <div class="title">
            Assessment
        </div>
    </div>
    <h3 class="question_number">Question <?php echo htmlspecialchars($question['Ques_ID']); ?> of <?php echo $total; ?>:</h3>
    <div class="question-container">
        <div class="quizimg">
            <?php echo '<img src="assess_image/' . htmlspecialchars($question['URL']). ' ">'; ?>
        </div>
        <div class="question">
            
            <p><?php echo htmlspecialchars($question['Ques_Text']); ?></p>
        </div>
    </div>
    <form action="includes/c3_ass.ques.inc.php" method="post">
    <ul class="choices">
        <?php foreach ($choices as $choice): ?>
            <li class="choice">
                <label>
                    <input name="choice" type="radio" value="<?php echo $choice['Choice_ID']; ?>"/>
                    <?php echo htmlspecialchars($choice['Choice_Text']); ?>
                </label>
            </li>
        <?php endforeach; ?>
    </ul>

        <div class="navigation-buttons">
            <input class="back" type="submit" name="action" value="Back"/>
            <input class="next" type="submit" name="action" value="Next"/>
        </div>
        <input type="hidden" name="number" value="<?php echo htmlspecialchars($number); ?>"/>
    </form>           
    

       
</body>
</html>