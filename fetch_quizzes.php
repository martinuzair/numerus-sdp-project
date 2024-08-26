<?php
require 'includes/numerusdatabase.php';

$chapterID = isset($_GET['chapter_id']) ? (int)$_GET['chapter_id'] : 0;

$sql = "SELECT Quiz_ID, Quiz_Title FROM quiz WHERE Chapters_ID = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$chapterID]);
$quizzes = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($quizzes);
?>
