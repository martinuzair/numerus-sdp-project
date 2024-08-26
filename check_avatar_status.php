<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/php-error.log'); // Set the path to your log file

include('includes/numerusdatabase.php');
include('includes/config_session.inc.php');

$child_id = $_SESSION['child_ID'];

// Fetch all avatars
$query = "
    SELECT ca.CAvatar_ID, ca.Image_ID, ca.Current_Status, CONCAT('/Children2/avatar/', i.Image_URL) AS Image_URL
    FROM child_avatar ca
    JOIN avatar i ON ca.Image_ID = i.Image_ID
    WHERE ca.Child_ID = :child_id 
    ORDER BY ca.Current_Status DESC";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':child_id', $child_id, PDO::PARAM_INT);
$stmt->execute();

$avatars = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Define quiz IDs for checking clickability
$quiz_ids = [2, 5, 8]; // Quiz IDs for avatars
$quiz_results = []; // To store results for quiz IDs

// Fetch quiz results for child
$query = "SELECT Quiz_ID FROM result WHERE Child_ID = :child_id AND Quiz_ID IN (" . implode(',', $quiz_ids) . ")";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':child_id', $child_id, PDO::PARAM_INT);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_COLUMN, 0); // Fetch quiz IDs only
$quiz_results = array_flip($results); // Flip to easily check if quiz ID exists

if (empty($results)) {
    echo "No results found for the given child ID and quiz IDs.<br>";
} else {
    // echo "Quiz results: " . implode(', ', $results) . "<br>";
}

// Assign index only to avatars with Current_Status 0 and display the mapping
$index = 0;
foreach ($avatars as &$avatar) {
    if ($avatar['Current_Status'] == 1) {
        // Always clickable
        $avatar['is_clickable'] = true;
        $avatar['index'] = $index;
        // echo "Index 0 assigned to Avatar ID: {$avatar['CAvatar_ID']}, Image ID: {$avatar['Image_ID']}, Current Status: {$avatar['Current_Status']}<br>";
    }
}

// Assign indices to avatars with Current_Status = 0
$index = 1; // Start index for avatars with Current_Status = 0
foreach ($avatars as &$avatar) {
    if ($avatar['Current_Status'] == 0) {
        // Determine clickable based on quiz results
        $quiz_id = $quiz_ids[$index - 1] ?? null; // Adjust based on your quiz ID array
        $avatar['is_clickable'] = ($quiz_id && isset($quiz_results[$quiz_id]));
        $avatar['index'] = $index;
        // echo "Index {$index} assigned to Avatar ID: {$avatar['CAvatar_ID']}, Image ID: {$avatar['Image_ID']}, Current Status: {$avatar['Current_Status']}, is_clickable: {$avatar['is_clickable']}<br>";
        $index++; // Increment index for the next avatar with Current_Status 0
    }
}


// Output JSON response (if needed)
header('Content-Type: application/json');
echo json_encode(['avatars' => $avatars]);

?>