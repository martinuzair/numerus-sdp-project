<?php
require_once 'includes/numerusdatabase.php';

$sql = "SELECT u.Email, u.role,
            COALESCE(a.Name, p.Name, c.Name) AS Name,
            COALESCE(p.Identification_Number, c.Identification_Number) AS nric,
            p.phone, c.Parent_id, c.Child_ID
        FROM user u
        LEFT JOIN admin a ON u.Email = a.Email
        LEFT JOIN parent p ON u.Email = p.Email
        LEFT JOIN child c ON u.Email = c.Email";
$stmt = $pdo->query($sql);
$profiles = $stmt->fetchAll(PDO::FETCH_ASSOC);

$searchEmail = isset($_POST['search_email']) ? $_POST['search_email'] : '';

if (!empty($searchEmail)) {
    $profiles = array_filter($profiles, function($profile) use ($searchEmail) {
        return $profile['Email'] === $searchEmail;
    });
}
