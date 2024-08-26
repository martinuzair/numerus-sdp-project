<?php
require 'includes/numerusdatabase.php'; // Include your database connection file
require 'includes/config_session.inc.php';

$child_id = isset($_SESSION['child_ID']) ? $_SESSION['child_ID'] :null; ;
$subtopic_id = $_GET['subtopic_id'];

// Mark subtopic as completed
$stmt = $pdo->prepare("INSERT INTO child_progress (Child_ID, Subtopic_ID, Completed) VALUES (:child_id, :subtopic_id, 1) ON DUPLICATE KEY UPDATE Completed = 1");
$stmt->execute(['child_id' => $child_id, 'subtopic_id' => $subtopic_id]);

// Redirect to subtopic page
header("Location: subtopic.php?subtopic_id=" . $subtopic_id);
exit;
?>
