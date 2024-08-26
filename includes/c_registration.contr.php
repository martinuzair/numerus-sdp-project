<?php

function is_email_invalid($email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL) ){
        return true;
    }else{
        return false;
    }
}

function is_email_taken(object $pdo, $email){
    if(get_email($pdo,  $email)){
        return true;
    }else{
        return false;
    }
}

function get_email(object $pdo, $email){
    $query = "SELECT Email FROM user WHERE Email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function is_input_empty($fullname, $nric, $email, $password, $confirm_password, $gender, $dob  ) {
    if (empty($fullname) || empty($nric) || empty($email) || empty($password) || 
    empty($confirm_password) || empty($gender) || empty($dob)) {
        return true;
    } else {
        return false;
    }
}

function is_exactly_12_digits($nric) {
    if (preg_match('/^\d{12}$/', $nric)) {
        return false;
    } else {
        return true;
    }
}

