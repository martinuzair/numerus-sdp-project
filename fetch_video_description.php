<?php
require 'includes/numerusdatabase.php';

if (isset($_GET['subtopic'])) {
    $subtopicID = (int)$_GET['subtopic'];

    $query = "SELECT * FROM subtopic WHERE Subtopic_ID = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$subtopicID]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $response = [
            'video_available' => !empty($row['Video']),
            'video_url' => !empty($row['Video']) ? $row['Video'] : null,
            'notes_available' => !empty($row['Notes']),
            'notes_url' => !empty($row['Notes']) ? $row['Notes'] : null
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // Return an error message as JSON
        header('Content-Type: application/json');
        echo json_encode(['error' => 'No content found for the given ID']);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Subtopic ID not provided']);
}
?>
