<?php
require 'includes/numerusdatabase.php'; // Include your database connection file
require 'includes/config_session.inc.php';

$child_id = isset($_SESSION['child_ID']) ? $_SESSION['child_ID'] :null;;
$id = $_GET['id'];
$type = $_GET['type'];

if ($type == 'subtopic') {
    $stmt = $pdo->prepare("INSERT INTO child_progress (Child_ID, Subtopic_ID, Completed) VALUES (:child_id, :id, 1) ON DUPLICATE KEY UPDATE Completed = 1");
    $stmt->execute(['child_id' => $child_id, 'id' => $id]);
    header("Location: subtopic.php?subtopic_id=" . $id);
} elseif ($type == 'quiz') {
    $stmt = $pdo->prepare("INSERT INTO child_progress (Child_ID, Quiz_ID, Completed) VALUES (:child_id, :id, 1) ON DUPLICATE KEY UPDATE Completed = 1");
    $stmt->execute(['child_id' => $child_id, 'id' => $id]);
    header("Location: c6_quiz.php?quiz_id=" . $id);
} elseif ($type == 'game') {
    $stmt = $pdo->prepare("INSERT INTO child_progress (Child_ID, Subtopic_ID, Quiz_ID, Completed, Game_ID) VALUES (:child_id, 0, 0, 1, :id) ON DUPLICATE KEY UPDATE Completed = 1");
    $stmt->execute(['child_id' => $child_id, 'id' => $id]);
    header("Location: c5_learningLevels.php?level=" . $id);
}
exit;
?>