<?php
require_once 'numerusdatabase.php'; // Include your database connection file
require_once 'config_session.inc.php';

$admin_id = $_SESSION['admin_ID'];
$editMode = isset($_GET['edit']) && $_GET['edit'] === 'true';
if(isset($_SESSION['admin_ID'])){
    
        try {
            $stmt = $pdo->prepare("SELECT a.Email as a_email, a.Name as a_name, u.password as a_password
                FROM admin a
                JOIN user u ON a.Email = u.Email
                WHERE a.Admin_id = ?          
            ");
            $stmt->execute([$admin_id]);
            $admin = $stmt->fetch();
            
            if ($admin) {

                 // Assign values to variables
                $name = htmlspecialchars($admin['a_name']);
                $email = htmlspecialchars($admin['a_email']);
                $password = htmlspecialchars($admin['a_password']);
                
                } else {
                echo "No profile found with the given ID.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
    echo "No profile found.";
}
?>