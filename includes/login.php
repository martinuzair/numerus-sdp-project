<?php
require_once 'config_session.inc.php';
require_once 'numerusdatabase.php'; // Include your database connection file




// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    

    try {
        // Prepare and execute the query to fetch user data based on email
        $stmt = $pdo->prepare("SELECT Email, password, role FROM user WHERE Email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Check if a user with the given email exists
        if ($user) {
            // Verify password (plaintext comparison)
            if (/*password_verify($password, $user['password'])*/$password === $user['password']) {
                // Password is correct

                $_SESSION['user_email'] = $user['Email'];
                // Redirect based on user role

                

                switch ($user['role']) {
                    case 'Admin':
                        $stmt = $pdo->prepare("SELECT Admin_id FROM admin WHERE Email = ?");
                        $stmt->execute([$email]);
                        $child = $stmt->fetch();

                        $_SESSION['admin_ID'] = $child['Admin_id'];
                        regenerate_session_id_loggedin();
                        header("Location: ../a1_adminHomePage.php");
                        exit;
                    case 'Parent':
                        $stmt = $pdo->prepare("SELECT Parent_ID FROM parent WHERE Email = ?");
                        $stmt->execute([$email]);
                        $parent = $stmt->fetch();
                        
                        $_SESSION['parent_ID'] = $parent['Parent_ID'];
                        //echo $_SESSION['parent_ID'];
                        
                        $stmt = $pdo->prepare("SELECT Child_ID FROM child WHERE parent_id = ?");
                        $stmt->execute([$parent['Parent_ID']]);
                        $children = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

                        $_SESSION['child_ids'] = $children;
                        regenerate_session_id_loggedin();
                        header("Location:../p1_pmain.php");
                        exit;
                    case 'Children':
                        $stmt = $pdo->prepare("SELECT Child_ID FROM child WHERE Email = ?");
                        $stmt->execute([$email]);
                        $child = $stmt->fetch();

                        $_SESSION['child_ID'] = $child['Child_ID'];

                        $stmt = $pdo->prepare("SELECT COUNT(*) FROM assess_result WHERE Child_ID = ?");
                        $stmt->execute([$child['Child_ID']]);
                        $has_result = $stmt->fetchColumn();
                        regenerate_session_id_loggedin();

                        if($has_result > 0){
                            header("Location: ../c1_childMain.php");
                        }else{
                            header("Location: ../c2_ass.php");
                        }
                        
                        exit;
                    default:
                        // Handle invalid role
                        $_SESSION['login_error'] = "Invalid role!";
                        header("Location: ../u2_login.php");
                        exit;
                }
            } else {
                // Password is incorrect
                $_SESSION['login_error'] = "Incorrect Login Credentials!";
                header("Location: ../u2_login.php");
                exit;
            }
        } else {
            // User with given email not found
            $_SESSION['login_error'] = "Incorrect Login Credentials!";
            header("Location: ../u2_login.php");
            exit;
        }
    } catch (PDOException $e) {
        // Handle database error
        $_SESSION['login_error'] = "Database error: " . $e->getMessage();
        header("Location: ../u2_login.php");
        exit;
    }
}

// Close connection (if needed)
// $pdo = null;
?>







