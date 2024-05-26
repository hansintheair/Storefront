<?php

session_start();

include "StoreDB.php";


$uid = $_SESSION["user_id"];

// Sanitize for security
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);

echo "EMAIL: ".$email;
echo "UID: ".$_SESSION["user_id"];

// Validate email format
$email_pattern = "/^[A-Za-z0-9._\-]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$/";
if (!preg_match($email_pattern, $email)) {
    $_SESSION["email_update_error"] = "invalid e-mail format";
    header("Location: UserProfile.php");
    exit;
}

$store_db = new StoreDB();

// Get user profile data
$store_db->connect();
$userdata = $store_db->getUserByID($uid);

// Update user profile data
$userdata["EMAIL"] = $email;

// Save user profile data
$store_db->setUserEmailByID($uid, $email);
$store_db->disconnect();


$_SESSION["email_update_success"] = true;
unset($_SESSION["email_error"]);
header("Location: UserProfile.php");