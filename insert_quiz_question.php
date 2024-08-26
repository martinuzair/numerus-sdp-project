<?php
require 'includes/numerusdatabase.php';

$chapterID = isset($_POST['chapter_id']) ? (int)$_POST['chapter_id'] : 0;
$quesText = isset($_POST['ques_text']) ? $_POST['ques_text'] : '';
$choices = isset($_POST['choices']) ? $_POST['choices'] : [];
$answer = isset($_POST['answer']) ? (int)$_POST['answer'] : 0;
$url = '';

try {
    $pdo->beginTransaction();

    // Check if a file was uploaded
    if (isset($_FILES['url']) && $_FILES['url']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['url']['tmp_name'];
        $fileName = $_FILES['url']['name'];
        $fileSize = $_FILES['url']['size'];
        $fileType = $_FILES['url']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $target_dir = "C://xampp//htdocs//Children2//quiz_image//";
        $target_file = $target_dir . basename($fileName);
        $relative_path = basename($target_file);

        // Move the file to the desired directory
        if (move_uploaded_file($fileTmpPath, $target_file)) {
            $url = $relative_path; // Store the path to the file
            
        } else {
            echo json_encode(['success' => false, 'message' => 'Error: File upload failed.']);
            exit;
        }
    } else {
        if (isset($_FILES['url']['error'])) {
        }
    }
    
    // Insert question into quiz_question
    $sql = "INSERT INTO quiz_question (Quiz_ID, Ques_text, URL) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$chapterID, $quesText, $url]);
    $questionID = $pdo->lastInsertId();


    // Insert choices into quiz_choice
    foreach ($choices as $index => $choiceText) {
        $isAnswer = ($index + 1 == $answer) ? 1 : 0;
        $sql = "INSERT INTO quiz_choice (Question_ID, Choice_Text, Answer) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$questionID, $choiceText, $isAnswer]);

    }
    $pdo->commit();
    header("Location: a6_QuizManagement.php");
    exit;
} catch (Exception $e) {
    $pdo->rollBack();
}
?>
