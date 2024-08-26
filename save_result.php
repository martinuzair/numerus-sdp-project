<?php
require 'includes/numerusdatabase.php'; // Include your database connection file
require 'includes/config_session.inc.php';

$child_id = isset($_SESSION['child_ID']) ? $_SESSION['child_ID'] :null;;
$quiz_id = isset($_POST['quiz_id']) ? intval($_POST['quiz_id']) : 0;
$correct = isset($_POST['correct']) ? intval($_POST['correct']) : 0;
$incorrect = isset($_POST['incorrect']) ? intval($_POST['incorrect']) : 0;
$result = isset($_POST['result']) ? floatval($_POST['result']) : 0;

// Debugging: Print the values before saving
echo "Child ID: $child_id<br>";
echo "Quiz ID: $quiz_id<br>";
echo "Correct: $correct<br>";
echo "Incorrect: $incorrect<br>";
echo "Result: $result<br>";

// Save the result to the database
$stmt = $pdo->prepare("INSERT INTO result (Child_ID, Quiz_ID, Correct, Incorrect, Result) VALUES (:child_id, :quiz_id, :correct, :incorrect, :result)");
$stmt->execute([
    'child_id' => $child_id,
    'quiz_id' => $quiz_id,
    'correct' => $correct,
    'incorrect' => $incorrect,
    'result' => $result
]);

// Store the result in the session to pass to result.php
$_SESSION['quiz_result'] = $result;
$_SESSION['quiz_id'] = $quiz_id;

// Reset session variables
$_SESSION['correctAnswers'] = 0;
$_SESSION['incorrectAnswers'] = 0;

// Redirect to result.php
header("Location: result.php");
echo "<script>
    console.log('Result saved successfully.');
    console.log('Quiz ID: " . htmlspecialchars($quiz_id, ENT_QUOTES, 'UTF-8') . "');
    console.log('Child ID: " . htmlspecialchars($child_id, ENT_QUOTES, 'UTF-8') . "');
    console.log('Correct Answers: " . htmlspecialchars($correct, ENT_QUOTES, 'UTF-8') . "');
    console.log('Incorrect Answers: " . htmlspecialchars($incorrect, ENT_QUOTES, 'UTF-8') . "');
    console.log('Result: " . htmlspecialchars($result, ENT_QUOTES, 'UTF-8') . "');
</script>";
exit;
?>
