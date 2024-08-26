<?php
require_once 'includes/numerusdatabase.php';

session_start(); // Ensure session is started

if (isset($_SESSION['child_ID'])) {
    $child_id = $_SESSION['child_ID'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $avatar = isset($_POST['avatar']) ? $_POST['avatar'] : '';

        // Debugging
        error_log("Received avatar: " . $avatar);

        if (!empty($avatar)) {
            try {
                $pdo->beginTransaction();

                // Reset all avatars' status for the specific child
                $resetSql = "UPDATE child_avatar SET Current_Status = 0 WHERE Child_ID = :childID";
                $resetStmt = $pdo->prepare($resetSql);
                $resetStmt->bindParam(':childID', $child_id, PDO::PARAM_INT);
                $resetStmt->execute();

                // Update the selected avatar's status
                $sql = "
                    UPDATE child_avatar
                    JOIN avatar ON child_avatar.Image_ID = avatar.Image_ID
                    SET child_avatar.Current_Status = 1
                    WHERE avatar.Image_URL = :avatarURL
                      AND child_avatar.Child_ID = :childID
                ";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':avatarURL', $avatar);
                $stmt->bindParam(':childID', $child_id, PDO::PARAM_INT);
                $stmt->execute();

                // Commit transaction
                $pdo->commit();

                // Check if any rows were affected
                if ($stmt->rowCount() > 0) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'No rows updated. Check if the Image_URL is correct.']);
                }
            } catch (PDOException $e) {
                // Rollback transaction if there is an error
                $pdo->rollBack();
                error_log("PDOException: " . $e->getMessage());
                echo json_encode(['success' => false, 'message' => 'Database error occurred']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid input']);
        }
    } 
}

?>
