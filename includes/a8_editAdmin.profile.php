<?php
require_once 'numerusdatabase.php'; // Include your database connection file
require_once 'config_session.inc.php';

$editMode = isset($_GET['edit']) && $_GET['edit'] === 'true';

if (isset($_SESSION['admin_ID'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email']; 
        $password = $_POST['password'];

        try {
            $pdo->beginTransaction();

          
            // Update password in the user table
            $stmt = $pdo->prepare("UPDATE user SET password = ? WHERE Email = ?");
            $stmt->execute([$password, $email]);

            $pdo->commit();
            $_SESSION['success_msg'] = "Update Successfull!";
            // Redirect to the view profile page
            header('Location: ../a8_View_AdminProfile.php');
            die(); 
        } catch (PDOException $e) {
            $pdo->rollBack();
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid request method.";
    }
} else {
    echo "No profile found.";
}
?>