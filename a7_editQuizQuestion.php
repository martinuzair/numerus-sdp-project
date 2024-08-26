<?php
require 'includes/numerusdatabase.php';

$questionID = isset($_GET['question_id']) ? (int)$_GET['question_id'] : 0;

$sql = "SELECT Ques_text, URL FROM quiz_question WHERE Question_ID = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$questionID]);
$question = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT Choice_ID, Choice_Text, Answer FROM quiz_choice WHERE Question_ID = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$questionID]);
$choices = $stmt->fetchAll(PDO::FETCH_ASSOC);

usort($choices, function ($a, $b) {
    return $b['Answer'] - $a['Answer'];
});
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Quiz Question</title>
    <link rel="stylesheet" href="CSS/design.css">
</head>
<body>
    <div class="unscrollable-page">
    <?php include "includes/adminheader.php"?>

    <center>
            <form action="update_quiz_question.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="chapter_id" value="<?php echo $chapterID; ?>">
                <div class="image-box">
                    <img id="imagePreview" src="quiz_image/<?php echo htmlspecialchars($question['URL']); ?>"  width="500" height="300">
                    
                </div>
                <div class="update-box">
                <input type="file" id="url" name="url">
                </div>
                <div class="question-box">
                    <input type="text" id="ques_text" name="ques_text" value="<?php echo htmlspecialchars($question['Ques_text']); ?>">
                </div>
                <label for="answer" class="correct-answer">Correct Answer:</label>
                <select id="answer" name="answer">
                    <?php foreach ($choices as $index => $choice): ?>
                        <option value ="<?php echo ($index + 1); ?>"> <?php echo htmlspecialchars($choice['Choice_Text']); ?></option>
                    <?php endforeach; ?>
                </select>
                <?php foreach ($choices as $index => $choice): ?>
                <div class="option-<?php echo ($index + 1); ?>">
                    <input type="hidden" name="choice_ids[]" value="<?php echo $choice['Choice_ID']; ?>">
                    <input type="text" id="choice_<?php echo ($index + 1); ?>" name="choices[]" value="<?php echo htmlspecialchars($choice['Choice_Text']); ?>" oninput="updateOption(<?php echo $index + 1; ?>, this.value)">
                </div>
            <?php endforeach; ?>

            <br>


            <button type="button" class="cancel-button" onclick="window.history.back();">Cancel</button>
            <button type="submit" class="submit-button">Submit</button>
            <input type="hidden" name="question_id" value="<?php echo $questionID; ?>">

            </form>
        </center>
    </div>

    <script src = "script.js"></script>
</body>
</html>