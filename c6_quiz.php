<?php
require 'includes/numerusdatabase.php'; // Include your database connection file
require 'includes/config_session.inc.php';

$quiz_id = isset($_GET['quiz_id']) ? intval($_GET['quiz_id']) : 1;
$child_id = isset($_SESSION['child_ID']) ? $_SESSION['child_ID'] :null; 
$question_id = isset($_GET['question_id']) ? intval($_GET['question_id']) : null;
$correct = isset($_GET['correct']) ? intval($_GET['correct']) : 0;
$incorrect = isset($_GET['incorrect']) ? intval($_GET['incorrect']) : 0;

// Fetch all Question_IDs for the given Quiz_ID in ascending order
$stmt = $pdo->prepare("SELECT Question_ID FROM quiz_question WHERE Quiz_ID = :quiz_id ORDER BY Question_ID ASC");
$stmt->execute(['quiz_id' => $quiz_id]);
$questionIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

// If no question_id is provided, fetch the first question_id for the given quiz_id
if ($question_id === null) {
    $stmt = $pdo->prepare("SELECT MIN(Question_ID) AS first_question_id FROM quiz_question WHERE Quiz_ID = :quiz_id");
    $stmt->execute(['quiz_id' => $quiz_id]);
    $question_id = $stmt->fetchColumn();
    if ($question_id === false) {
        echo "No questions found for this quiz.";
        exit;
    }
}

// Find the index of the current Question_ID
$currentQuestionIndex = array_search($question_id, $questionIds);

// Determine the next Question_ID
$nextQuestionId = isset($questionIds[$currentQuestionIndex + 1]) ? $questionIds[$currentQuestionIndex + 1] : null;

// Fetch quiz details for the current question
$stmt = $pdo->prepare("SELECT q.Quiz_Title, qq.Ques_Text, qq.URL, qc.Choice_Text, qc.Answer, qc.Choice_ID, qq.Question_ID 
                       FROM quiz q
                       JOIN quiz_question qq ON q.Quiz_ID = qq.Quiz_ID
                       JOIN quiz_choice qc ON qq.Question_ID = qc.Question_ID
                       WHERE q.Quiz_ID = :quiz_id AND qq.Question_ID = :question_id");
$stmt->execute(['quiz_id' => $quiz_id, 'question_id' => $question_id]);
$quizDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if there are any questions
if (empty($quizDetails)) {
    echo "No questions found for this quiz.";
    exit;
}

// Group choices by question
$question = [];
foreach ($quizDetails as $detail) {
    $question['Ques_Text'] = $detail['Ques_Text'];
    $question['URL'] = "quiz_image/" . $detail['URL']; // Added a '/' after 'quiz_image'
    $question['choices'][] = ['text' => $detail['Choice_Text'], 'answer' => $detail['Answer'], 'choice_id' => $detail['Choice_ID']];
}

// Fetch the total number of questions for the quiz
$stmt = $pdo->prepare("SELECT COUNT(*) FROM quiz_question WHERE Quiz_ID = :quiz_id");
$stmt->execute(['quiz_id' => $quiz_id]);
$totalQuestions = $stmt->fetchColumn();


// Fetch the current question number
$stmt = $pdo->prepare("SELECT COUNT(*) FROM quiz_question WHERE Quiz_ID = :quiz_id AND Question_ID <= :question_id");
$stmt->execute(['quiz_id' => $quiz_id, 'question_id' => $question_id]);
$currentQuestionNumber = $stmt->fetchColumn();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="CSS/quiz.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    
    <script>
        function textToSpeech(text) {
            const speech = new SpeechSynthesisUtterance(text);
            window.speechSynthesis.speak(speech);
        }
    </script>

    <style>
        .next, .finish{
            margin-left: 2rem;
            margin-bottom: 2rem;
            color: rgb(255, 255, 255); font-size: 21px; line-height: 21px; 
            padding: 10px; border-radius: 10px; 
            font-weight: normal; text-decoration: none; font-style: normal; font-variant: normal; 
            text-transform: none; background-image: linear-gradient(to right, rgb(28, 110, 164) 0%, rgb(35, 136, 203) 50%, rgb(20, 78, 117) 100%); 
            box-shadow: rgb(0, 0, 0) 5px 5px 15px 5px; border: 2px solid rgb(28, 110, 164); display: inline-block;
        }

        .next, .finish:hover {
            background: #1C6EA4; 
        }
        .next, .finish:active {
            background: #144E75; 
        }
        .choice-label {
    display: block;
    padding: 20px;
    cursor: pointer;
    font-size: 20px; /* Adjust this value to make the text larger or smaller */
}

.choice-cell {
    padding: 20px;
}


        
    </style>
</head>
<body>
<center><h1>Quiz</h1></center>
    <form id="quizForm" method="POST" action="save_result.php">
        <table class="ques">
            <tr>
                <td class="ques1" width="30%">Question <?php echo $currentQuestionNumber; ?>:</td>
                <td rowspan="2" class="ques2"><?php echo htmlspecialchars($question['Ques_Text']); ?></td>
            </tr>
            <tr>
                <td class="audio-player">
                    <button type="button" onclick="textToSpeech('<?php echo htmlspecialchars($question['Ques_Text']); ?>')">
                        <i class='fas fa-volume-up' style='font-size:100px;'></i>
                    </button>
                    <audio id="audio" src="#"></audio>              
                </td>
            </tr>
        </table>
        <table class="selection">
            <tr>
                <td rowspan="4" width="60%">
                    <img src="<?php echo htmlspecialchars($question['URL']); ?>">
                </td>
                <?php foreach ($question['choices'] as $index => $choice): ?>
                    <td class="<?php echo $index % 2 == 0 ? 'blue' : 'yellow'; ?> choice-cell">
                        <label for="choice<?php echo $index; ?>" class="choice-label">
                            <input type="radio" name="answer" value="<?php echo $choice['choice_id']; ?>" id="choice<?php echo $index; ?>" style="margin-right: 20px;">
                            <?php echo htmlspecialchars($choice['text']); ?>
                        </label>
                    </td>
                </tr>
                <?php if ($index < 3): ?>
                <tr>
                <?php endif; ?>
                <?php endforeach; ?>
            </tr>
        </table>


        <div class="navigation">
            <?php if ($nextQuestionId): ?>
            <a href="c6_quiz.php?quiz_id=<?php echo $quiz_id; ?>&question_id=<?php echo $nextQuestionId; ?>&correct=<?php echo $correct; ?>&incorrect=<?php echo $incorrect; ?>">
                <button type="button" class="next">Next</button>
            </a>
        <?php else: ?>
            <button type="submit" class="finish">Finish</button>
        <?php endif; ?>
    </div>
        <input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">
        <input type="hidden" name="child_id" value="<?php echo $child_id; ?>">
        <input type="hidden" name="correct" id="correct" value="<?php echo $correct; ?>">
        <input type="hidden" name="incorrect" id="incorrect" value="<?php echo $incorrect; ?>">
        <input type="hidden" name="result" id="result" value="0">
    </form>

</body>
<script src="https://kit.fontawesome.com/5eb408bf40.js" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        let nextButton = document.querySelector('.next');
    if (nextButton) {
        nextButton.addEventListener('click', function(event) {
            event.preventDefault();
            let selectedAnswer = document.querySelector('input[name="answer"]:checked');
            if (selectedAnswer) {
                let correctAnswer = <?php echo json_encode(array_column($question['choices'], 'answer', 'choice_id')); ?>;
                let correct = <?php echo $correct; ?>;
                let incorrect = <?php echo $incorrect; ?>;
                if (correctAnswer[selectedAnswer.value] == 1) {
                    correct++;
                } else {
                    incorrect++;
                }
                let nextQuestionId = <?php echo json_encode($nextQuestionId); ?>;
                if (nextQuestionId) {
                    window.location.href = `c6_quiz.php?quiz_id=<?php echo $quiz_id; ?>&question_id=${nextQuestionId}&correct=${correct}&incorrect=${incorrect}`;
                } else {
                    alert("No more questions available.");
                }
            } else {
                alert("Please select an answer before proceeding.");
            }
        });
    }

    let quizForm = document.getElementById('quizForm');
    if (quizForm) {
        quizForm.addEventListener('submit', function(event) {
            event.preventDefault();
            let selectedAnswer = document.querySelector('input[name="answer"]:checked');
            let correct = <?php echo $correct; ?>;
            let incorrect = <?php echo $incorrect; ?>;
            if (selectedAnswer) {
                let correctAnswer = <?php echo json_encode(array_column($question['choices'], 'answer', 'choice_id')); ?>;
                if (correctAnswer[selectedAnswer.value] == 1) {
                    correct++;
                } else {
                    incorrect++;
                }
            }
            let totalQuestions = <?php echo $totalQuestions; ?>;
            let result = (correct / totalQuestions) * 100;
            document.getElementById('correct').value = correct;
            document.getElementById('incorrect').value = incorrect;
            document.getElementById('result').value = result.toFixed(2);
            quizForm.submit();
        });
    }
});
</script>
</html>