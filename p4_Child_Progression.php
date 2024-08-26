<?php
include 'includes/header.php';

include "includes/numerusdatabase.php"; 

session_start();
$parent_id = $_SESSION['parent_ID'];

// Fetch children associated with the logged-in parent
$stmt = $pdo->prepare("SELECT * FROM child WHERE Parent_ID = :parent_id");
$stmt->execute(['parent_id' => $parent_id]);
$children = $stmt->fetchAll(PDO::FETCH_ASSOC);

function calculateProgress($pdo, $child_id) {
    // Count total subtopics, quizzes, and games
    $totalStmt = $pdo->prepare("
        SELECT 
            (SELECT COUNT(DISTINCT Subtopic_ID) FROM subtopic) + 
            (SELECT COUNT(DISTINCT Quiz_ID) FROM quiz) + 
            3 AS total_tasks
    ");
    $totalStmt->execute();
    $totalTasks = $totalStmt->fetchColumn();

    // Count completed subtopics, quizzes, and games for the child
    $completedStmt = $pdo->prepare("
        SELECT 
            (SELECT COUNT(DISTINCT Subtopic_ID) FROM child_progress WHERE Child_ID = :child_id AND Subtopic_ID != 0 AND Completed = 1) + 
            (SELECT COUNT(DISTINCT Quiz_ID) FROM child_progress WHERE Child_ID = :child_id AND Quiz_ID != 0 AND Completed = 1) + 
            (SELECT COUNT(DISTINCT Game_ID) FROM child_progress WHERE Child_ID = :child_id AND Game_ID != 0 AND Completed = 1) AS completed_tasks
    ");
    $completedStmt->execute(['child_id' => $child_id]);
    $completedTasks = $completedStmt->fetchColumn();

    // Calculate progress percentage
    return ($completedTasks / $totalTasks) * 100;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Children Progression</title>
    <style>
        *, *::before, *::after{
            box-sizing: border-box;
        }

        body{
            background-image: linear-gradient(to right, var(--colour1), var(--colour2));
            padding: 0; margin: 0;
        }

        .view_children_progression{
            padding-top: 6rem;
            padding-bottom: 2rem;
        }

        .title{
            padding-left: 2rem;
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

        .view_box{
            display: flex;
            flex-direction: column;
            justify-content: start;
            align-items: center;
            width: 75%;
            margin: 0 auto;
            border-collapse: collapse;
            border-radius: 2rem;
            background-color: var(--colour9);
            margin-top: 30px;
            box-shadow: var(--shadowcombined);
            padding-bottom: 2rem;
        }

        .view_box .title{
            align-self: flex-start;
            margin: 1em;
            margin-left: 2em;
            padding-top: 1em;
        }
        

        .user_container{
            padding-top: 1em;
            display:flex;
            flex-direction: column;
            justify-content: center;
            width: 90%;
            align-items: center;
        }

        .progress_bar{
            position: relative;
            width: 90%;
            height: 5em;
            background: var(--colour6);
            border-radius: 2.5em;
            color: black;
            overflow: hidden;
        }

        .progress__fill{
            width: 0%;
            height: 100%;
            background: var(--colour8);
            transition: 0.3s ease-in-out;
        }

        .progress__text{
            position: absolute;         
            top: 50%;
            right: .5em;
            transform: translateY(-50%);
            font: bold;
        }
        .child_detail_buttons {
            background: var(--colour9);
            display: flex;
            width: 70%;
            margin: 1rem auto;
            justify-content: space-around;
            gap: 40px;
            align-items: center;
            flex-wrap: wrap;
        }
        .child_detail_buttons > *{
        cursor: pointer;
        background: var(--colour9);
        text-decoration: none;
        font: var(--p);
        padding: 12px 80px;
        border-radius: 8px;
        color: var(--color8);
        transition: var(--transition);
        }
        .child_detail_buttons > *:hover{
        transition: var(--transition);
        }

        .detail_button{
        border: solid 1px var(--colour8);
        box-shadow: 0 2px var(--colour8);
        }
        .detail_button:hover {
        box-shadow: 0 4px var(--colour8);
        }

    </style>
</head>
<body>
    <section class ="view_children_progression">
        <div class="view_box">
            <div class="title"><h2>Child Progression Record</h2></div>
            <?php foreach ($children as $child): ?>
                <?php $progress = calculateProgress($pdo, $child['Child_ID']); ?>
                <div class="user_container">
                    <div class="progress_bar">
                        <div class="progress__fill" style="width: <?php echo round($progress); ?>%;"></div>
                        <h3><span class="progress__text"><?php echo round($progress); ?>%</span></h3>
                    </div>
                    
                    <button class="child_detail_buttons">
                        <a href="p3_view_child_profile.php?Child_ID=<?php echo $child['Child_ID']; ?>" class="detail_button"><?php echo htmlspecialchars($child['Name']); ?></a>
                        <a href="p5_progressionDetails.php?Child_ID=<?php echo $child['Child_ID']; ?>" class="detail_button">Level</a>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <script>    
        function updateProgressBar(progressBar, value){
            value = Math.round(value);
            progressBar.querySelector(".progress__fill").style.width = `${value}%`;
            progressBar.querySelector(".progress__text").textContent = `${value}%`;
        }
        function handleFormSubmit(event) {
            event.preventDefault();
            const inputValue = document.getElementById('test1').value;
            const progressBar = document.querySelector('.progress_bar');
            updateProgressBar(progressBar, inputValue);
        }
        document.getElementById('progressForm').addEventListener('submit', handleFormSubmit);
    </script>
</body>
</html>