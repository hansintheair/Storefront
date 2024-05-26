<?php

session_start();

include "StoreDB.php";


$uid = $_SESSION["user_id"];

// Sanitize for security
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);

// Validate email format
$email_pattern = "/^[A-Za-z0-9._\-]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$/";
if (!preg_match($email_pattern, $email)) {
    $_SESSION["email_update_error"] = "invalid e-mail format";
    header("Location: UserProfile.php");
    exit;
}

$store_db = new StoreDB();

// Save user profile data
$store_db->connect();
$store_db->setUserEmailByID($uid, $email);
$store_db->disconnect();


$_SESSION["email_update_success"] = true;
unset($_SESSION["email_update_error"]);
header("Location: UserProfile.php");