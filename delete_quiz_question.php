<?php
require 'includes/numerusdatabase.php';

$questionID = isset($_GET['question_id']) ? (int)$_GET['question_id'] : 0;

try {
    $sql = "DELETE FROM quiz_choice WHERE Question_ID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$questionID]);
    $sql = "DELETE FROM quiz_question WHERE Question_ID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$questionID]);

    echo json_encode(['success' => true, 'message' => 'Question deleted successfully!']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Failed to delete question: ' . $e->getMessage()]);
}
?>

