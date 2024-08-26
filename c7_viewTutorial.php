<?php
require 'includes/config_session.inc.php';
require 'includes/numerusdatabase.php'; // Include your database connection file

$subtopic_id = $_GET['subtopic_id'];
$child_id = isset($_SESSION['child_ID']) ? $_SESSION['child_ID'] :null;  // Get child_id from the URL

// Fetch subtopic details
$stmt = $pdo->prepare("SELECT * FROM subtopic WHERE Subtopic_ID = :subtopic_id");
$stmt->execute(['subtopic_id' => $subtopic_id]);
$subtopic = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch chapter title using Chapters_ID from subtopic
$chapters_id = $subtopic['Chapters_ID'];
$stmt = $pdo->prepare("SELECT Chapters_Title FROM chapters WHERE Chapters_ID = :chapters_id");
$stmt->execute(['chapters_id' => $chapters_id]);
$chapter = $stmt->fetch(PDO::FETCH_ASSOC);
$chapterTitle = $chapter['Chapters_Title'];
$stmt = $pdo->prepare("SELECT Quiz_ID FROM quiz WHERE Chapters_ID = :chapters_id");
$stmt->execute(['chapters_id' => $chapters_id]);
$quiz = $stmt->fetch(PDO::FETCH_ASSOC);
$quiz_id = $quiz['Quiz_ID'] ?? 1; // Default to 1 if no quiz ID is found
$_SESSION['quiz_id'] = $quiz_id;
$_SESSION['child_id'] = $child_id;
$stmt = $pdo->prepare("SELECT Subtopic_ID, Subtitle_Name FROM subtopic WHERE Chapters_ID = :chapters_id ORDER BY Subtopic_ID");
$stmt->execute(['chapters_id' => $chapters_id]);
$subtopics = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($subtopic['Subtitle_Name']); ?></title>
    <link rel="stylesheet" href="CSS/viewTutorial.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
</head>
<body>
    <center><h1><?php echo $chapterTitle; ?></h1></center>
    <div class="sub">
        <center><h1 class="title"><?php echo htmlspecialchars($subtopic['Subtitle_Name']); ?></h1></center>
    </div>
    <div class="video">
    <video width="800" height="500" controls class="rounded-video"
    src="tutorial_video/<?php echo htmlspecialchars($subtopic['Video']); ?>" controls>
    </video>
      </video>
    </div>
    <div class="notes">
        <p>Notes/Summary</p><br>
        <iframe src="tutorial_notes/<?php echo htmlspecialchars($subtopic['Notes']); ?>" width="100%" height="1000px"></iframe>
    </div>
    <div class="action">
        <div class="button">
            <a>
                <button class="play">↩</button>
                <button class="title" onclick="window.history.back()">Back</button>
            </a>
        </div>
        
        
    </div>
</body>
</html>