<?php
require 'includes/numerusdatabase.php';

$questionID = isset($_POST['question_id']) ? (int)$_POST['question_id'] : 0;
$quesText = isset($_POST['ques_text']) ? $_POST['ques_text'] : '';
$choices = isset($_POST['choices']) ? $_POST['choices'] : [];
$choiceIDs = isset($_POST['choice_ids']) ? $_POST['choice_ids'] : [];
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
          
            // Update the ImageUrl field in the database
            $sql = "UPDATE quiz_question SET URL = ? WHERE Question_ID = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$url, $questionID]);
        } else {
            echo json_encode(['success' => false, 'message' => 'There was an error uploading the file.']);
            exit;
        }
    }

    // Update the question text
    $sql = "UPDATE quiz_question SET Ques_text = ? WHERE Question_ID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$quesText, $questionID]);

    // Set all choices as incorrect initially
    $sql = "UPDATE quiz_choice SET Answer = 0 WHERE Question_ID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$questionID]);

    // Update the choices
    foreach ($choices as $index => $choiceText) {
        $choiceID = $choiceIDs[$index];
        $isAnswer = ($index + 1 == $answer) ? 1 : 0;
        $sql = "UPDATE quiz_choice SET Choice_Text = ?, Answer = ? WHERE Choice_ID = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$choiceText, $isAnswer, $choiceID]);
    }

    $pdo->commit();
    header("Location: a6_QuizManagement.php");
    exit;
} catch (Exception $e) {
    $pdo->rollBack();
}
?>
