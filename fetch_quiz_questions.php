<?php
require 'includes/numerusdatabase.php';

$quizID = isset($_GET['quiz_id']) ? (int)$_GET['quiz_id'] : 0;

header('Content-Type: application/json');

try {
    $sql = "SELECT Question_ID, Ques_text FROM quiz_question WHERE Quiz_ID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$quizID]);
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($questions);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
