<?php
include 'includes/header.php';

include "includes/numerusdatabase.php"; 

// Fetch Child_ID from the URL
$child_id = isset($_GET['Child_ID']) ? intval($_GET['Child_ID']) : 0;

if ($child_id > 0) {
    // Fetch child's information
    $stmt = $pdo->prepare("SELECT * FROM child WHERE Child_ID = :child_id");
    $stmt->execute(['child_id' => $child_id]);
    $child = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$child) {
        echo "Error: Child not found.";
        exit;
    }

    // Fetch parent's name
    $parentStmt = $pdo->prepare("SELECT Name FROM parent WHERE Parent_ID = :parent_id");
    $parentStmt->execute(['parent_id' => $child['Parent_id']]);
    $parent = $parentStmt->fetch(PDO::FETCH_ASSOC);

    if (!$parent) {
        echo "Error: Parent not found.";
        exit;
    }

    // Fetch user's password using child's email
    $userStmt = $pdo->prepare("SELECT password FROM user WHERE Email = :email");
    $userStmt->execute(['email' => $child['Email']]);
    $user = $userStmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Error: User not found.";
        exit;
    }
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
    echo "Error: Invalid Child ID.";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $identity_card_number = $_POST['identity_card_number'] ?? '';
    $date_of_birth = $_POST['date_of_birth'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Update child's information
    $updateStmt = $pdo->prepare("
        UPDATE child 
        SET Name = :name, 
            Identification_Number = :identity_card_number, 
            DoB = :date_of_birth, 
            Gender = :gender, 
            Email = :email 
        WHERE Child_ID = :child_id
    ");
    $updateStmt->execute([
        'name' => $name,
        'identity_card_number' => $identity_card_number,
        'date_of_birth' => $date_of_birth,
        'gender' => $gender,
        'email' => $email,
        'child_id' => $child_id
    ]);

    // Update user's password
    $updateUserStmt = $pdo->prepare("
        UPDATE user 
        SET password = :password 
        WHERE Email = :email
    ");
    $updateUserStmt->execute([
        'password' => $password,
        'email' => $email
    ]);

    // Refresh the page to show updated data
    header("Location: p3_view_child_profile.php?Child_ID=$child_id");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>View Child Profile</title>

    <style>
        *, *::before, *::after{
            box-sizing: border-box;
        }

        body{
            background-image: linear-gradient(to right, var(--colour1), var(--colour2));
            padding: 0; margin: 0;
        }

        .content{
            padding-top: 6rem;
        }

        .title{
            padding-left: 2rem;
        }

        h1 {
            font: var(--h1);
            margin-top: .5rem;
        }

        h2 {
            font: var(--h2);
            margin-top: .5rem;
        }

        h3 {
            font: var(--h3);
            margin-top: .3rem;
        }

        a {
            font: var(--links);
            margin-top: .3rem;
        }

        p {
            font: var(--p);
            margin-top: .3rem;
        }

        .profile_card{
            display: flex;
            flex-direction: column;
            justify-content: start;
            align-items: center;
            width: 75%; 
            height: 90vh;
            margin: 0 auto;
            border-radius: 2rem;
            border-collapse: collapse;
            background-color: var(--colour4);
            margin-top: 30px;
            margin-bottom: 2rem;
            box-shadow: var(--shadowcombined);
            color: var(--colour1);
        }

        .profile_header {
            margin-top: 1rem;
            text-align: center;
            margin-bottom: 1rem;
        }

        .separator {
            width: 100%;
            height: 2px;
            background-color: white;
            margin: 1rem 0;
        }

        .profile_content {
            display: flex;
            width: 100%;
            align-items: center;
            margin-top: 0.5rem;
        }

        .profile_image {
            width: 30%; 
            aspect-ratio: 1;
            background-color: var(--colour8);
            border-radius: 10px;
            margin-right: 2rem;
            margin-left: 2rem;
            position: relative;
            overflow: hidden;
        }

        .profile_image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;  
        }

        .profile_details {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-around;
            width: 60%;
            padding: 1rem;
        }

        .profile_details input, .profile_details select {
            font-size: var(--p);
            margin: 0.5rem 0;
            width: 100%;
            padding: 0.5rem;
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
        }

        .edit_button {
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            width: 20%;
            background-color: var(--colour3);
            color: var(--colour1);
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
            cursor: pointer;
            font: var(--links);
        }

        .edit_button:hover {
            background-color: var(--colour5);
        }
        .readonly-select {
    background-color: #f0f0f0; /* Light gray background to indicate it's not editable */
    color: #666; /* Gray text color */
    border: 1px solid #ccc; /* Border similar to disabled state */
    cursor: not-allowed; /* Show a not-allowed cursor */
    padding: 0.5rem; /* Add padding for consistency */
    border-radius: 0.5rem; /* Match other form elements */
}

    .cancel_button,.submit_button{
        margin-top: 1rem;
                padding: 0.5rem 1rem;
                width: 20%;
                background-color: var(--colour3);
                color: var(--colour1);
                border: none;
                border-radius: 0.5rem;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
                cursor: pointer;
                font: var(--links);
    }

    .cancel_button:hover,.submit_button:hover{
        background-color: var(--colour5);
    }

    </style>
</head>
<body>
    <section class="content">
        <div class="profile_card">
            <div class="profile_header">
                <h2>Student</h2>
            </div>

            <div class="separator"></div>

            <div class="profile_content">
                <div class="profile_image"> 
                <img src="/Children2/avatar/<?php echo isset($avatar) ? $avatar: '' ?>" alt="Avatar" id="currentAvatar">
                </div>

                <div class="profile_details">
    <form method="POST" action="">
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($child['Name'] ?? ''); ?>" placeholder="Name" required readonly>
        <input type="text" name="identity_card_number" id="identity_card_number" value="<?php echo htmlspecialchars($child['Identification_Number'] ?? ''); ?>" placeholder="Identity Card Number" readonly>
        <input type="date" name="date_of_birth" id="date_of_birth" value="<?php echo htmlspecialchars($child['DoB'] ?? ''); ?>" placeholder="Date of Birth" readonly>
        <select name="gender" id="gender" class="readonly-select" disabled>
            <option value="male" <?php echo ($child['Gender'] ?? '') == 'male' ? 'selected' : ''; ?>>Male</option>
            <option value="female" <?php echo ($child['Gender'] ?? '') == 'female' ? 'selected' : ''; ?>>Female</option>
        </select>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($child['Email'] ?? ''); ?>" placeholder="Email" readonly>
        <input type="password" name="password" id="password" value="<?php echo htmlspecialchars($user['password'] ?? ''); ?>" placeholder="Password" required readonly>
        <input type="text" name="parent_name" id="parent_name" value="<?php echo htmlspecialchars($parent['Name'] ?? ''); ?>" placeholder="Parent Name" readonly>

        <button type="button" id="edit_button" class="edit_button" onclick="enableEditMode()">Edit</button>
        <button type="button" id="cancel_button" class="cancel_button" style="display:none;" onclick="cancelEditMode()">Cancel</button>
        <button type="submit" id="save_button" class="submit_button" style="display:none;">Save</button>
    </form>
</div>
                <script>
    function enableEditMode() {
        // Enable the fields
        document.getElementById('name').readOnly = false;
        document.getElementById('password').readOnly = false;

        // Show cancel and save buttons, hide edit button
        document.getElementById('edit_button').style.display = 'none';
        document.getElementById('cancel_button').style.display = 'inline-block';
        document.getElementById('save_button').style.display = 'inline-block';
    }

    function cancelEditMode() {
        // Reset the form
        document.querySelector('form').reset();

        // Re-disable the fields
        document.getElementById('name').readOnly = true;
        document.getElementById('password').readOnly = true;

        // Show edit button, hide cancel and save buttons
        document.getElementById('edit_button').style.display = 'inline-block';
        document.getElementById('cancel_button').style.display = 'none';
        document.getElementById('save_button').style.display = 'none';
    }
</script>
            </div>
        </div>
    </section>

</body>
</html>


