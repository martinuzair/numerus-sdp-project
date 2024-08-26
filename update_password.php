<?php
    require_once 'includes/numerusdatabase.php';
    require_once 'includes/config_session.inc.php';
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        $newPassword = $_POST['newPassword'];
        if(isset($_SESSION['child_ID'])){
            $child_id = $_SESSION['child_ID'];
            try{
                $stmt = $pdo ->prepare("UPDATE user u JOIN child c ON c.Email = u.Email
                                        SET u.password = ?
                                        WHERE c.Child_ID =?");
                $stmt ->execute([$newPassword, $child_id]);
                echo "Password updated successfully";
                
                
            }catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }}
                

?>