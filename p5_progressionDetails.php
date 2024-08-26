<?php
include 'includes/header.php';

include "includes/numerusdatabase.php"; 

// Fetch Child_ID from the URL
$child_id = isset($_GET['Child_ID']) ? intval($_GET['Child_ID']) : 1; // Default to 1 if not provided

// Fetch child's name
$stmt = $pdo->prepare("SELECT Name FROM child WHERE Child_ID = :child_id");
$stmt->execute(['child_id' => $child_id]);
$child_name = $stmt->fetchColumn();

if (!$child_name) {
    echo "Error: Child not found.";
    exit;
}

// Get the selected level ID from the URL or default to 1
$level_id = isset($_GET['level']) ? intval($_GET['level']) : 1;

// Fetch chapters for the selected level
$stmt = $pdo->prepare("SELECT * FROM chapters WHERE Level_ID = :level_id");
$stmt->execute(['level_id' => $level_id]);
$chapters = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check adventure game completion status
$stmt = $pdo->prepare("SELECT Completed FROM child_progress WHERE Child_ID = :child_id AND Game_ID = :level_id");
$stmt->execute(['child_id' => $child_id, 'level_id' => $level_id]);
$gameCompleted = $stmt->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Child Report</title>
    <style>
        *, *::before, *::after{
            box-sizing: border-box;
        }

        body{
            background-image: linear-gradient(to right, var(--colour1), var(--colour2));
            padding: 0; margin: 0;
        }


        h1 {
        font: var(--h1);
        margin-top: .5rem;
        }

        h2 {
            font: var(--h2);
            margin-top: .5rem;
        }

        h3 {
            font: var(--h3);
            margin-top: .3rem;
        }

        a {
            font: var(--links);
            margin-top: .3rem;
        }

        p {
            font: var(--p);
            margin-top: .3rem;
        }

        .title {
            display: flex;
            width: 100%;
            height: auto;
            justify-content: center;

        }
        
        .title_box{
            margin-top: 7rem;
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
    background-color: var(--colour6);
    padding: 1.5rem;
    border-radius: 1.5rem;
    cursor: pointer;
    transition: var(--transition);
    overflow: hidden;
    box-shadow: var(--shadowcombined);
    margin: 1.5rem;
    max-height: 300px; 
    position: relative; 
}

.chapter-list {
    display: none;
    margin-top: 20px;
    max-height: 200px; 
    overflow-y: auto; 
    margin-bottom:30px;
}

/* Optional: Style the scrollbar for better appearance */
.chapter-list::-webkit-scrollbar {
    width: 8px;
}

.chapter-list::-webkit-scrollbar-thumb {
    background: var(--colour4); /* Adjust the scrollbar color */
    border-radius: 4px;
}

.chapter-list::-webkit-scrollbar-track {
    background: var(--colour7); /* Adjust the track color */
}

    .chapter-box.active .chapter-list {
        display: block;
        }


    .tutorial-box {
        width: 100%;
        background-color: var(--colour3);
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
        
        .ls{
            font-size: 22px;
            text-align:center;
            width: 30%;
            height: 10%;
        background-color: var(--colour6);
        padding: 0.5rem;
        border-radius: 1.5rem;
        cursor: pointer;
        transition: var(--transition);
        overflow: hidden;
        box-shadow: var(--shadowcombined);
        margin: 1.5rem;
        max-height: 300px; 
        position: relative; 
    }
        

        
        
    </style>
</head>
<body>
<section class="title">
            <div class="title_box">
                <h2><?php echo htmlspecialchars($child_name); ?></h2>
                <form action="p5_progressionDetails.php" method="GET">
                    <input type="hidden" name="Child_ID" value="<?php echo $child_id; ?>">
                    <select class="ls" name="level" onchange="this.form.submit()">
                        <option value="1" <?php echo $level_id == 1 ? 'selected' : ''; ?>>Level 1</option>
                        <option value="2" <?php echo $level_id == 2 ? 'selected' : ''; ?>>Level 2</option>
                        <option value="3" <?php echo $level_id == 3 ? 'selected' : ''; ?>>Level 3</option>
                    </select>
                </form>
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
                                    <label class="custom-checkbox">
                                        <?php echo htmlspecialchars($subtopic['Subtitle_Name']); ?>
                                        <input type="checkbox" id="tutorial<?php echo $subtopic['Subtopic_ID']; ?>" name="tutorial<?php echo $subtopic['Subtopic_ID']; ?>" <?php echo $completed ? 'checked' : ''; ?> disabled>
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
                            <label class="custom-checkbox">
                                Quiz: <?php echo htmlspecialchars($quiz['Quiz_Title']); ?>
                                <input type="checkbox" id="quiz<?php echo $quiz['Quiz_ID']; ?>" name="quiz<?php echo $quiz['Quiz_ID']; ?>" <?php echo $quizCompleted ? 'checked' : ''; ?> disabled>
                                <span class="checkmark quiz-change"></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="chapter-box" id="adventureGame">
                <h2>Adventure Game</h2>
                <label class="custom-checkbox">
                    Adventure Game
                    <input type="checkbox" id="adventureGameCheckbox" name="adventureGameCheckbox" <?php echo $gameCompleted ? 'checked' : ''; ?> disabled>
                    <span class="checkmark quiz-change"></span>
                </label>
            </div>
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
    </script>
</body>

</html> 