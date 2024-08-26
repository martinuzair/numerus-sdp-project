<?php
require_once 'numerusdatabase.php'; // Include your database connection file
require_once 'config_session.inc.php';

$parent_id = $_SESSION['parent_ID'];
$editMode = isset($_GET['edit']) && $_GET['edit'] === 'true';
if(isset($_SESSION['parent_ID'])){
    
        try {
            $stmt = $pdo->prepare("SELECT p.Email as p_email, p.Name as p_name, p.Identification_Number as p_nric,
                 p.DoB as p_DoB, p.Gender as p_gender, p.Phone as p_phone, u.password as u_password
                FROM parent p
                JOIN user u ON p.Email = u.Email
                WHERE p.Parent_ID = ?          
            ");
            $stmt->execute([$parent_id]);
            $parent = $stmt->fetch();
            
            if ($parent) {

                 // Assign values to variables
                $name = htmlspecialchars($parent['p_name']);
                $nric = htmlspecialchars($parent['p_nric']);
                $dob = htmlspecialchars($parent['p_DoB']);
                $email = htmlspecialchars($parent['p_email']);
                $password = htmlspecialchars($parent['u_password']);
                $telephone = htmlspecialchars($parent['p_phone']);
                $gender = htmlspecialchars($parent['p_gender']);
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