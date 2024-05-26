<?php

session_start();

include "StoreDB.php";


$store_db = new StoreDB();

$uid = $_SESSION["user_id"];

// Sanitize for security
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

// Get user profile data
$store_db->connect();
$userdata = $store_db->getUserByID($uid);
$store_db->disconnect();

// Verify old password
if (!(password_verify($password, $userdata["PASSWORD"]))) {
    $_SESSION["delete_account_error"] = "Invalid password";
    header("Location: UserProfile.php");
   exit;
}

// Delete account
$store_db->connect();
$store_db->delUserById($uid);
$store_db->disconnect();

include 'LogoutHandler.php';