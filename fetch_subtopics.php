<?php
require 'includes/numerusdatabase.php';

if (isset($_POST['chapter_id'])) {
    $chapterID = (int)$_POST['chapter_id'];

    $sql = "SELECT Subtopic_ID, Chapters_ID, Video, Notes FROM subtopic WHERE Chapters_ID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$chapterID]);
    $subtopics = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($subtopics as $index => &$subtopic) {
        $subtopic['Subtopic_Number'] = 'Subtopic ' . ($index + 1);
    }

    echo json_encode($subtopics);
}

?>
