<?php
require 'includes/numerusdatabase.php';

$level = isset($_GET['level']) ? (int)$_GET['level'] : 1;
$selectedChapterID = isset($_GET['chapter']) ? (int)$_GET['chapter'] : 1;

// Ensure the level is valid 
if ($level < 1 || $level > 3) {
    die("Invalid level specified.");
}

// Fetch chapters for the selected level
$sql = "SELECT * FROM chapters WHERE Level_ID = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$level]);
$chapters = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Management Page</title>
    <link rel="stylesheet" href="CSS/design.css">

    <style>
        .question-oddBox, .question-evenBox {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }



        .quiztion-title {
            margin-right: 10px;

        }

        .question-actions {
            display: flex;                  
            flex-direction: row;         
            gap: 5px;                      
            margin-left: 10px; 
        }
        .question-actions button {
            padding: 5px 10px;              
            width: 150px;
            height: 45px;
            font-size: 20px;                
            cursor: pointer;                
            border: none;                  
            border-radius: 6px;             
            background: #fcf8df;     
            color:#3f3f3f ;                    
            transition: background-color 0.3s; 
}
        .question-actions button:hover {
            background-color: ;      
        }
    </style>
</head>
<body>
    <div class="unscrollable-page">
    <?php include "includes/adminheader.php"?>
        <center>
            <div class="chapter-dropdown-wrapper">
                <div class="page-text">Quiz Management:<br>Level - <?php echo $level; ?></div>
                <div class="dropdown">
                    <button class="dropbtn" id="selected-quiz-chapter">Select Chapter</button>
                    <div class="dropdown-content" id="quiz-chapter-dropdown-content">
                        <?php foreach ($chapters as $chapter): ?>
                            <a href="#" data-chapter-id="<?php echo $chapter['Chapters_ID']; ?>"><?php echo "Chapter " . $chapter['Chapters_ID']; ?>
                            <input type="hidden" name="chapter_id" id="chapter_id">

                        </a>
                            
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="quizMGMT-box" id="quizMGMT-box">
                <div class="quizMGMT-heading">
                    <h1 class="question-no">NO</h1><br>
                    <h1 class="question-title" id="quiz-title-header">Title</h1>
                    <button type="button" class="plus-button" onclick="createQuizQuestion()">
                        <h1 class="plus-text">+</h1>
                        <input type="hidden" id="quizID" name="quiz_id" value="">
                    </button>
                </div>
                <!-- Quiz i fetch and put here with js after select chap-->
            </div>

            <!-- Hidden inputs to store selected chapter and subtopic -->
        </center>
    </div>

    <script>
        const level = <?php echo json_encode($level); ?>;
    </script>

    <script src="script.js">
        
    </script>
</body>
</html>