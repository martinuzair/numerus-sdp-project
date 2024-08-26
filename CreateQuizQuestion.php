<?php
require 'includes/numerusdatabase.php';

$chapterID = isset($_GET['chapter_id']) ? (int)$_GET['chapter_id'] : 0;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Quiz Question</title>
    <link rel="stylesheet" href="CSS/design.css">
</head>
<body>
    <div class="unscrollable-page">
    <?php include "includes/adminheader.php"?>

        <center>
            <form action="insert_quiz_question.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="chapter_id" value="<?php echo $chapterID; ?>">
                <div class="image-box">
                    <label for="myfile">Select a file:</label>
                    <input type="file" id="url" name="url" required>
                </div>
                <div class="question-box">
                    <input type="text" id="ques_text" name="ques_text" placeholder="Enter Your Question">
                </div>
                <div class="correct-answer-box">
                    <label for="answer" class="correct-answer-label">Correct Answer:</label>
                    <select id="answer" name="answer">
                        <option value="1">Choice A</option>
                        <option value="2">Choice B</option>
                        <option value="3">Choice C</option>
                        <option value="4">Choice D</option>
                    </select>
                </div>
                <div class="option-1">
                    <input type="text" id="choice_1" name="choices[]" placeholder="Choice A">
                </div>
                <div class="option-2">
                    <input type="text" id="choice_2" name="choices[]" placeholder="Choice B"><br>
                </div>
                <div class="option-3">
                    <input type="text" id="choice_3" name="choices[]" placeholder="Choice C">
                </div>
                <div class="option-4">
                    <input type="text" id="choice_4" name="choices[]" placeholder="Choice D">
                </div>

                <br>


                <button type="button" class="cancel-button" onclick="window.history.back();">Cancel</button>
                <button type="submit" class="submit-button">Submit</button>
            </form>
        </center>
    </div>

    <script src = "script.js"></script>
</body>
</html>