<?php
require_once 'numerusdatabase.php'; // Database connection file
require_once 'u2_signup.contr.php'; // Functions for validation and checks
require_once 'config_session.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"] ?? ''; // Fixed form field name
    $nric = $_POST["nric"] ?? '';
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';
    $telephone = $_POST["telephone"] ?? '';    
    $gender = $_POST["gender"] ?? '';  
    $dob = $_POST["dob"] ?? ''; 

    $errors = [];

    // Error Handlers
    if (is_email_invalid($email)) {
        $errors["invalid_email"] = "Invalid Email Used!";
    }
    if (is_email_taken($pdo, $email)) {
        $errors["email_taken"] = "Email already taken!";
    }
    if (is_input_empty($fullname, $nric, $email, $password, $telephone, $gender, $dob )){
        $errors["empty_fields"] = "All fields must be filled!";
    }
    if (is_exactly_12_digits($nric)){
        $errors["nric"] = "IC Number must be 12 digits without - !";
    }
    if (is_10_to_11_digits($telephone)){
        $errors["telephone"] = "Telephone Number must be 10 - 11 digits wihout space or - !";
    }

    if($errors){
        $_SESSION['error_registration'] = $errors;
        header("Location: ../u2_login.php");
        die();
    }

    if (empty($errors)) {
        try {
            // Start a transaction
            $pdo->beginTransaction();

            // Insert into users table
            $query = "INSERT INTO user (Email, password, role) VALUES (:email, :password, 'Parent');";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":email", $email);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bindParam(":password", $password); // Hash password
            $stmt->execute();

            // Insert into parent table
            $query = "INSERT INTO parent (Email, Name, Identification_Number, Gender, DoB, Phone) 
            VALUES (:email, :fullname, :nric, :gender, :dob, :telephone);";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":fullname", $fullname); // Fixed parameter name
            $stmt->bindParam(":nric", $nric);
            $stmt->bindParam(":gender", $gender);
            $stmt->bindParam(":dob", $dob);
            $stmt->bindParam(":telephone", $telephone); // Fixed parameter name
            $stmt->execute();

            // Commit the transaction
            $pdo->commit();
            $_SESSION['success_msg'] = "Registration Successfull";
            header("Location: ../u2_login.php");
            //echo $success_msg;
            die();
        } catch (Exception $e) { // Catch the general exception
            // Rollback the transaction on error
            $pdo->rollBack();
            error_log("Error: " . $e->getMessage()); // Log the error message
            echo "An error occurred. Please try again later.";
        }
    } 


    $pdo = NULL;
} else {
    header("Location: ../u2_login.php");
    exit();
}
?>








