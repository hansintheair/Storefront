<?php

session_start();

include "StoreDB.php";


$uid = $_SESSION["user_id"];

// Sanitize for security
$old_password = filter_input(INPUT_POST, 'old_password', FILTER_SANITIZE_STRING);
$new_password = filter_input(INPUT_POST, 'new_password', FILTER_SANITIZE_STRING);

$store_db = new StoreDB();

// Get user profile data
$store_db->connect();
$userdata = $store_db->getUserByID($uid);
$store_db->disconnect();

// Verify old password
if (!(password_verify($old_password, $userdata["PASSWORD"]))) {
    $_SESSION["password_update_error"] = "Invalid email or password";
    header("Location: UserProfile.php");
   exit;
}

// Validate password complexity
$pword_pattern = "((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,20})";
if (!preg_match($pword_pattern, $new_password)) {
    $_SESSION["password_update_error"] = "New password does not meet required complexity";
    header("Location: UserProfile.php");
    exit;
}

$password_hashed = password_hash($new_password, PASSWORD_DEFAULT);  // Hash password for security
$store_db->connect();
$store_db->setUserPwordByID($uid, $password_hashed);
$store_db->disconnect();

$_SESSION["password_update_success"] = true;
unset($_SESSION["password_update_error"]);
header("Location: UserProfile.php");

