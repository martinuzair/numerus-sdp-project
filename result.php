<?php
require 'includes/numerusdatabase.php'; // Include your database connection file
require 'includes/config_session.inc.php';

$child_id = isset($_SESSION['child_ID']) ? $_SESSION['child_ID'] :null;;
$quiz_id = $_SESSION['quiz_id'];
$result = $_SESSION['quiz_result'];

// Check if the user passed the quiz
$passed = $result == 100;

// If the user passed, update the child_progress table
if ($passed) {
    $stmt = $pdo->prepare("INSERT INTO child_progress (Child_ID, Subtopic_ID, Quiz_ID, Completed) VALUES (:child_id, 0, :quiz_id, 1)");
    $stmt->execute(['child_id' => $child_id, 'quiz_id' => $quiz_id]);
}
$stmt = $pdo->prepare("
    SELECT c.Level_ID
    FROM quiz q
    JOIN chapters c ON q.Chapters_ID = c.Chapters_ID
    WHERE q.Quiz_ID = :quiz_id
");
$stmt->execute(['quiz_id' => $quiz_id]);
$level = $stmt->fetch(PDO::FETCH_ASSOC);
$level_id = $level['Level_ID'] ?? null;
// Clear the session variables
unset($_SESSION['quiz_result']);
unset($_SESSION['quiz_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/result.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Wendy+One&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Result Page</title>
</head>
<body>
    <div>
        <h1 class="title">Quiz Result</h1>
        <div class="marks-container">
            <h2 class="marks"><?php echo htmlspecialchars($result); ?>%</h2>
        </div>
    </div>
    <div class="message-container">
        <p class="message">
            <?php if ($passed): ?>
                Congratulations!
                <br>
                You may move on to the next chapter!!!
            <?php else: ?>
                Sorry, you did not pass the quiz.
                <br>
                Please try again.
            <?php endif; ?>
        </p>
    </div>
    <div class="proceed-container">
        <p>PROCEED</p>
        <button type="button" value="Proceed" name="Proceed" onclick="window.location.href='c5_learningLevels.php?level=<?php echo htmlspecialchars($level_id); ?>'">
            <img src="image/proceed.png" alt="">
        </button>
    </div>
    <div>
        <img src="image/trophy.png" class="people-image">
    </div>
</body>
</html>