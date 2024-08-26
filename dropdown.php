<?php

session_start();
if (!isset($_SESSION['Child_ID'])) {
    $_SESSION['Child_ID'] = 1; // i just put to test, pls replace w login
} 

include "includes/numerusdatabase.php"; 

// Get the selected level ID from the URL or default to 1
$level_id = isset($_GET['level']) ? intval($_GET['level']) : 1;
$child_id = $_SESSION['Child_ID'];

// Fetch chapters for the selected level
$stmt = $pdo->prepare("SELECT * FROM chapters WHERE Level_ID = :level_id");
$stmt->execute(['level_id' => $level_id]);
$chapters = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Menu</title>
    <link rel="stylesheet" href="CSS/beta.css">
    <link rel="stylesheet" href="CSS/kidheader.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    
    <style>
        :root{
        /* colors */
        --colour1:#FFFFFF;
        --colour2:#5C9DF2;
        --colour3:#98BDFF;
        --colour4:#7978E9;
        --colour5:#34495E;
        --colour6:#FFEBCD;
        --colour7:#F8A5C2;
        --colour8:#94BDF2;
        --colour9:#F4F4F4; 
        --colour10:#F3797E;
        
        /* landng page */
        --ff: Verdana, Geneva, Tahoma, sans-serif;
        --h1: bold max(36px, 4vw) / max(28px, 5vw) var(--ff);
        --h2: bold max(24px, 3vw) / max(36px, 3.5vw) var(--ff);
        --h3: bold max(18px, 2vw) / max(24px, 2.5vw) var(--ff);
        --links: 18px/18px var(--ff);
        --p: max(14px, 1.5vw) / max(24px, 2vw) var(--ff);
        --transition: 0.3s ease-in-out;
        --shadow: #00000030 0px 0px 10px 0px;
        --shadowdark: #00000030 0px 5px 10px 5px;
        --shadowcombined: var(--shadow), var(--shadowdark)
    }
        *, *::before, *::after{
            box-sizing: border-box;
        }

        .title {
            display: flex;
            width: 100%;
            height: auto;
            justify-content: center;

        }
        
        .title_box{
            width: 50%;
            padding: 1rem;
            background: var(--colour5);
            border-radius: 2rem;
            text-align: center;
            color: var(--colour1);
            box-shadow: var(--shadowcombined);
        }
        .content {
            display: flex;
            flex-direction: column;
            justify-content: start;
            align-items: center;
            width: 75%;
            height: 120vh;
            margin: 0 auto;
            border-collapse: collapse;
            margin-top: 30px;
            margin-bottom: 3rem;
        }

        .chapter-box {
        width: 100%;
        background-color: #FA8E30;
        padding: 1.5rem;
        border-radius: 1.5rem;
        cursor: pointer;
        transition: var(--transition);
        overflow: hidden;
        box-shadow: var(--shadowcombined);
        margin: 1.5rem;
        }

    .chapter-box h2 {
        margin: 0;
        text-align: center;
        color: black;
        }

    .chapter-list {
        display: none;
        margin-top: 20px;
        }

    .chapter-box.active .chapter-list {
        display: block;
        }


    .tutorial-box {
        width: 100%;
        background-color: #b8661f;
        padding: 1rem;
        border-radius: 1rem;
        cursor: pointer;
        margin: 1rem 0;
        transition: var(--transition);
    }

    .tutorial-list {
        display: none;
        margin-top: 10px;
    }

    .tutorial-box.active .tutorial-list {
        display: block;
    }
    
    .custom-checkbox {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        padding: 10px 0;
        cursor: pointer;
        font-size: 22px;
        user-select: none;
        }

    .custom-checkbox input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
        }

    .checkmark {
        position: relative;
        height: 25px;
        width: 25px;
        background-color: #eee;
        border: 2px solid;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        }

    .custom-checkbox input:checked ~ .checkmark {
        background-color: #2196F3;
        }

    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
        }

    .custom-checkbox input:checked ~ .checkmark:after {
        display: block;
        }

    .custom-checkbox .checkmark:after {
        left: 9px;
        top: 5px;
        width: 6px;
        height: 12px;
        border: solid white;
        border-width: 0 3px 3px 0;
        transform: rotate(45deg);
        }
        
    </style>
</head>
<?php include "includes/cheader.php"?>
<body>
<section class="title">
        <div class="title_box">
            <h2>Level <?php echo htmlspecialchars($level_id); ?></h2>
        </div>
    </section>
    <section class="content">
        <?php foreach ($chapters as $index => $chapter): ?>
            <?php
            // Fetch subtopics for the current chapter
            $stmt = $pdo->prepare("SELECT * FROM subtopic WHERE Chapters_ID = :chapter_id");
            $stmt->execute(['chapter_id' => $chapter['Chapters_ID']]);
            $subtopics = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Fetch quizzes for the current chapter
            $stmt = $pdo->prepare("SELECT * FROM quiz WHERE Chapters_ID = :chapter_id");
            $stmt->execute(['chapter_id' => $chapter['Chapters_ID']]);
            $quizzes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Check if all subtopics are completed
            $allSubtopicsCompleted = true;
            foreach ($subtopics as $subtopic) {
                $stmt = $pdo->prepare("SELECT Completed FROM child_progress WHERE Child_ID = :child_id AND Subtopic_ID = :subtopic_id");
                $stmt->execute(['child_id' => $child_id, 'subtopic_id' => $subtopic['Subtopic_ID']]);
                $completed = $stmt->fetchColumn();
                if (!$completed) {
                    $allSubtopicsCompleted = false;
                    break;
                }
            }
            ?>
            <div class="chapter-box" id="chapter<?php echo $chapter['Chapters_ID']; ?>">
                <h2>Chapter <?php echo ($index + 1) . ": " . htmlspecialchars($chapter['Chapters_Title']); ?></h2>
                <div class="chapter-list">
                    <div class="tutorial-box">
                        <h3>Tutorials</h3>
                        <div class="tutorial-list">
                            <?php foreach ($subtopics as $subtopic): ?>
                                <?php
                                // Check completion status
                                $stmt = $pdo->prepare("SELECT Completed FROM child_progress WHERE Child_ID = :child_id AND Subtopic_ID = :subtopic_id");
                                $stmt->execute(['child_id' => $child_id, 'subtopic_id' => $subtopic['Subtopic_ID']]);
                                $completed = $stmt->fetchColumn();
                                ?>
                                <label class="custom-checkbox" onclick="redirectToSubtopic(<?php echo $subtopic['Subtopic_ID']; ?>)">
                                    <?php echo htmlspecialchars($subtopic['Subtitle_Name']); ?>
                                    <input type="checkbox" id="tutorial<?php echo $subtopic['Subtopic_ID']; ?>" name="tutorial<?php echo $subtopic['Subtopic_ID']; ?>" <?php echo $completed ? 'checked disabled' : ''; ?> onclick="event.stopPropagation(); markCompleted(<?php echo $subtopic['Subtopic_ID']; ?>, 'subtopic');">
                                    <span class="checkmark"></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php foreach ($quizzes as $quiz): ?>
                        <?php
                        // Check completion status
                        $stmt = $pdo->prepare("SELECT Completed FROM child_progress WHERE Child_ID = :child_id AND Quiz_ID = :quiz_id");
                        $stmt->execute(['child_id' => $child_id, 'quiz_id' => $quiz['Quiz_ID']]);
                        $quizCompleted = $stmt->fetchColumn();
                        ?>
                        <label class="custom-checkbox" onclick="<?php echo $allSubtopicsCompleted ? 'redirectToQuiz(' . $quiz['Quiz_ID'] . ')' : 'alert(\'Complete all tutorials first!\')'; ?>">
                            Quiz: <?php echo htmlspecialchars($quiz['Quiz_Title']); ?>
                            <input type="checkbox" id="quiz<?php echo $quiz['Quiz_ID']; ?>" name="quiz<?php echo $quiz['Quiz_ID']; ?>" <?php echo $quizCompleted ? 'checked disabled' : 'disabled'; ?>>
                            <span class="checkmark quiz-change"></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

    <script>
        document.querySelectorAll('.chapter-box').forEach(box => {
            box.addEventListener('click', function() {
                const isActive = this.classList.contains('active');
                document.querySelectorAll('.chapter-box').forEach(b => b.classList.remove('active'));
                if (!isActive) {
                    this.classList.add('active');
                }
            });
        });

        document.querySelectorAll('.tutorial-box').forEach(box => {
            box.addEventListener('click', function(event) {
                event.stopPropagation();
                const isActive = this.classList.contains('active');
                document.querySelectorAll('.tutorial-box').forEach(b => b.classList.remove('active'));
                if (!isActive) {
                    this.classList.add('active');
                }
            });
        });

        function markCompleted(id, type) {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `complete_task.php?id=${id}&type=${type}`, true);
            xhr.send();
        }

        function redirectToSubtopic(subtopicId) {
            window.location.href = `tutorial.php?subtopic_id=${subtopicId}`;
        }

        function redirectToQuiz(quizId) {
            window.location.href = `quiz.php?quiz_id=${quizId}`;
        }

    </script>
</body>

</html> 
