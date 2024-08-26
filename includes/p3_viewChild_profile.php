<?php
require_once 'numerusdatabase.php'; // Include your database connection file
require_once 'config_session.inc.php';

$childProfiles = [];

if(isset($_SESSION['child_ids'])&& !empty($_SESSION['child_ids'])){
    $child_ids = $_SESSION['child_ids'];

    foreach ($child_ids as $child_id){
        try {
            $stmt = $pdo->prepare("SELECT c.Email as c_email, c.Name as c_name, c.Identification_Number as c_nric,
                 c.Gender as c_gender, c.DoB as c_DoB, u.password as c_password, p.Name as p_name
                FROM child c
                JOIN user u ON c.Email = u.Email
                JOIN parent p ON c.Parent_id = p.Parent_ID
                WHERE c.Child_ID = ?          
            ");
            $stmt->execute([$child_id]);
            $childProfile = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($childProfile) {

                $childProfiles[] = [
                    'name' => htmlspecialchars($childProfile['c_name']),
                    'nric' => htmlspecialchars($childProfile['c_nric']),
                    'dob' => htmlspecialchars($childProfile['c_DoB']),
                    'gender' => htmlspecialchars($childProfile['c_gender']),
                    'email' => htmlspecialchars($childProfile['c_email']),
                    'password' => htmlspecialchars($childProfile['c_password']),
                    'parent_name' => htmlspecialchars($childProfile['p_name']),
                
                ];
                //print_r($childProfiles);
                 // Assign values to variables
                /*$name = htmlspecialchars($childProfile['c_name']);
                $nric = htmlspecialchars($childProfile['c_nric']);
                $dob = htmlspecialchars($childProfile['c_DoB']);
                $gender = htmlspecialchars($childProfile['c_gender']);
                $email = htmlspecialchars($childProfile['c_email']);
                $password = htmlspecialchars($childProfile['c_password']); // In practice, you should not display plain passwords
                $parent_name = htmlspecialchars($childProfile['p_name']);*/
                } else {
                echo "No child found with the given ID.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
} else {
    echo "No children found.";
}
?>