<?php
include "includes/numerusdatabase.php";

$sql = "SELECT * FROM avatar";
$stmt = $pdo->prepare($sql);

if ($stmt->execute()) {
    $avatars = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo '<div class="avatar-grid">';
    foreach ($avatars as $avatar) {
        echo '<div class="avatar-item" onclick="selectAvatar(\'' . $avatar['Image_URL'] . '\', \'' . $avatar['Image_ID'] . '\')">';
        echo '<img src="/Children2/avatar/' . $avatar['Image_URL'] . '">';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo "Error fetching avatars.";
}
?>
<style>
/* Modal container */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
}

/* Modal content */
.modal-content {
    background-color: #fefefe;
    margin: 6% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
    border-radius: 10px;
}

/* Close button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Avatar grid */
.avatar-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
    padding: 20px;
}

.avatar-item {
    text-align: center;
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 8px;
    background-color: #f9f9f9;
}

.avatar-item img {
    width: 200px;
    height: auto;
    cursor: pointer;
}

</style>
