<?php
require_once 'numerusdatabase.php'; // Include your database connection file
require_once 'config_session.inc.php';

$child_id = $_SESSION['child_ID'];
if (isset($child_id)) {
    try {
        // 1. Retrieve child, user, and parent details
        $stmt = $pdo->prepare("SELECT c.Email as c_email, c.Name as c_name, c.Identification_Number as c_nric,
                                      c.DoB as c_DoB, p.Name as p_name, u.password as c_password
                                FROM child c
                                JOIN user u ON c.Email = u.Email
                                JOIN parent p ON c.Parent_id = p.Parent_ID
                                WHERE c.Child_ID = ?");
        $stmt->execute([$child_id]);
        $child = $stmt->fetch();

        // 2. Check if child data was retrieved
        if ($child) {
            // Assign values to variables
            $name = htmlspecialchars($child['c_name']);
            $nric = htmlspecialchars($child['c_nric']);
            $dob = htmlspecialchars($child['c_DoB']);
            $email = htmlspecialchars($child['c_email']);
            $parent_name = htmlspecialchars($child['p_name']);
            $password = htmlspecialchars($child['c_password']);

            // 3. Retrieve avatar Image_ID using child_ID
            $stmt2 = $pdo->prepare("SELECT Image_ID FROM child_avatar WHERE Child_ID = ? AND Current_Status = 1");
            $stmt2->execute([$child_id]);
            $avatar_data = $stmt2->fetch();

            if ($avatar_data) {
                $image_id = $avatar_data['Image_ID'];

                // 4. Retrieve the Image_URL using Image_ID
                $stmt3 = $pdo->prepare("SELECT Image_URL FROM avatar WHERE Image_ID = ?");
                $stmt3->execute([$image_id]);
                $avatar = $stmt3->fetchColumn();

                // Ensure the avatar is safely encoded for HTML output
                $avatar = htmlspecialchars($avatar);
            } else {
                $avatar = 'default-avatar.png'; // Fallback to a default avatar if not found
            }
        } else {
            echo "No profile found with the given ID.";
            exit;
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
} else {
    echo "No profile found.";
    exit;
}
?>
