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

// Fetch subtopics based on the selected chapter (if any)
$subtopics = [];

if ($selectedChapterID) {
    $sql = "SELECT * FROM subtopic WHERE Chapters_ID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$selectedChapterID]);
    $subtopics = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial Management Page - Level <?php echo $level; ?></title>
    <link rel="stylesheet" href="CSS/design.css">
</head>
<body>
    <div class="unscrollable-page">
    <?php include "includes/adminheader.php"?>
        <center>
            <div class="chapter-dropdown-wrapper">
                <div class="page-text">Tutorial<br> Management - Level <?php echo $level; ?></div>
                <div class="dropdown">
                    <button class="dropbtn" id="selected-chapter">Select Chapter</button>
                    <div class="dropdown-content" id="tutorial-chapter-dropdown-content">
                        <?php foreach ($chapters as $chapter): ?>
                            <a href="#" data-chapter-id="<?php echo $chapter['Chapters_ID']; ?>"><?php echo "Chapter " . $chapter['Chapters_ID']; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="dropbtn" id="selected-subtopic">Select Subtopic</button>
                    <div class="dropdown-content" id="subtopic-dropdown-content">
                        <!-- Subtopics will be dynamically loaded here -->
                    </div>
                </div>
            </div>

            <!-- Hidden inputs to store selected chapter and subtopic -->
            <input type="hidden" name="chapter_id" id="chapter_id">
            <input type="hidden" name="subtopic_id" id="subtopic_id">

            <h1 class="video-text">Video</h1>
            <button type="button" class="edit-button-1">Edit</button>
            <div class="video-box" id="video-box">
                
            </div>

            <h1 class="property-text">Description</h1>
            <button type="button" class="edit-button-2">Edit</button>
            <div class="notes-box" id="notes-box">
                
            </div>
        </center>
    </div>

    <script>
        
        const level = <?php echo json_encode($level); ?>;
    
        const chapterID = <?php echo json_encode($selectedChapterID); ?>;
    </script>
    
    <script src="script.js"></script>
</body>
</html>
