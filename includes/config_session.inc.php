<?php

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 3600,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true, // Make sure your environment supports HTTPS
    'httponly' => true,
]);

session_start();

if (isset($_SESSION["user_id"])) {
    if (!isset($_SESSION['last_regeneration'])) {
        regenerate_session_id_loggedin();
    } else {
        $interval = 60 * 15; // 15 minutes
        if (time() - $_SESSION['last_regeneration'] >= $interval) {
            regenerate_session_id_loggedin();
        }
    }
} else {
    if (!isset($_SESSION['last_regeneration'])) {
        regenerate_session_id();
    } else {
        $interval = 60 * 15; // 15 minutes
        if (time() - $_SESSION['last_regeneration'] >= $interval) {
            regenerate_session_id();
        }
    }
}

function regenerate_session_id_loggedin() {
    session_regenerate_id(true);

    $role_specific_identifier = "";
    if (isset($_SESSION['admin_ID'])) {
        $role_specific_identifier = "ADMIN_" . $_SESSION['admin_ID'];
    } elseif (isset($_SESSION['parent_ID'])) {
        $role_specific_identifier = "PARENT_" . $_SESSION['parent_ID'];
    } elseif (isset($_SESSION['child_ID'])) {
        $role_specific_identifier = "CHILD_" . $_SESSION['child_ID'];
    }

    if (!empty($role_specific_identifier)) {
        $user_id = $_SESSION["user_email"];
        $newSessionID = session_create_id($role_specific_identifier . "_" . $user_id . "_");
        session_id($newSessionID);
    }

    $_SESSION['last_regeneration'] = time();
}

function regenerate_session_id() {
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}
?>
