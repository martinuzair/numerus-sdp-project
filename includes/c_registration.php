<?php
require_once 'numerusdatabase.php'; // Database connection file
require_once 'c_registration.contr.php'; // Functions for validation and checks
require_once 'config_session.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"] ?? ''; // Fixed form field name
    $nric = $_POST["nric"] ?? '';
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';
    $confirm_password = $_POST["confirm_password"] ?? '';  
    $gender = $_POST["gender"] ?? '';  
    $dob = $_POST["dob"] ?? ''; 
    $parent_id = $_SESSION['parent_ID'];
    $selected_avatar_id = $_POST["imageID"] ?? null; // Fetch selected avatar ID


    $errors = [];

    // Error Handlers
    if (is_email_invalid($email)) {
        $errors["invalid_email"] = "Invalid Email Used!";
    }
    if (is_email_taken($pdo, $email)) {
        $errors["email_taken"] = "Email already taken!";
    }
    if (is_input_empty($fullname, $nric, $email, $password, $confirm_password, $gender, $dob )){
        $errors["empty_fields"] = "All fields must be filled!";
    }
    if (is_exactly_12_digits($nric)){
        $errors["nric"] = "IC Number must be 12 digits without - !";
    }
    

    if($errors){
        $_SESSION['error_registration'] = $errors;
        header("Location: ../p2_childRegistration.php");
        die();
    }

    if (empty($errors)) {
        if($password === $confirm_password){
            try {
                
                $pdo->beginTransaction();

                // Insert data to users table
                $query = "INSERT INTO user (Email, password, role) VALUES (:email, :password, 'Children');";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":email", $email);
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $stmt->bindParam(":password", $password); // Hash password
                $stmt->execute();

                // Insert data to parent table
                $query = "INSERT INTO child (Email, Name, Identification_Number, Gender, DoB, Parent_id) 
                VALUES (:email, :fullname, :nric, :gender, :dob, :parent_ID);";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":fullname", $fullname); // Fixed parameter name
                $stmt->bindParam(":nric", $nric);
                $stmt->bindParam(":gender", $gender);
                $stmt->bindParam(":dob", $dob);
                $stmt->bindParam(":parent_ID", $parent_id); // Fixed parameter name
                $stmt->execute();

                $child_id = $pdo->lastInsertId();

                $query = "SELECT Image_ID FROM avatar"; // Fetch all avatar IDs
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $avatars = $stmt->fetchAll(PDO::FETCH_COLUMN, 0); // Fetch avatar IDs

                foreach ($avatars as $avatar_id) {
                    $query = "INSERT INTO child_avatar (Child_ID, Image_ID, Current_Status) VALUES (:child_id, :avatar_id, 0)";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(":child_id", $child_id);
                    $stmt->bindParam(":avatar_id", $avatar_id);
                    $stmt->execute();
                }
                if ($selected_avatar_id) {
                    $query = "UPDATE child_avatar SET Current_Status = 1 WHERE Image_ID = :avatar_id AND Child_ID = :child_id";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(":child_id", $child_id);
                    $stmt->bindParam(":avatar_id", $selected_avatar_id);
                    $stmt->execute();
                }
                // Commit the transaction
                $pdo->commit();
                $_SESSION['success_msg'] = "Registration Successfull";
                header("Location: ../p2_childRegistration.php");
                //echo $success_msg;
                die();
            } catch (Exception $e) { 
                // Rollback the transaction on error
                $pdo->rollBack();
                error_log("Error: " . $e->getMessage()); 
                echo "An error occurred. Please try again later.";
            }
        } else {
            $_SESSION['password_not_match'] = "Password not match!";
            header("Location: ../p2_childRegistration.php");
        }
    }


        $pdo = NULL;
} else {
    header("Location: ../p2_childRegistration.php");
    exit();
}
?>








