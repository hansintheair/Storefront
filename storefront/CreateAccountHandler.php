<?php

session_start();

include "StoreDB.php";

$store_db = new StoreDB();

// Sanitize for security
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$isadmin = filter_input(INPUT_POST, 'isadmin', FILTER_SANITIZE_STRING);
$return_location = filter_input(INPUT_POST, 'return_location', FILTER_SANITIZE_STRING);

// error_log("PASSWORD: ".$password."<br>");  //DEBUG
// error_log("EMAIL: ".$email."<br>");  //DEBUG
// error_log("ISADMIN: ".$isadmin."<br>");  //DEBUG

// Validate password complexity
$pword_pattern = "((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,20})";
if (!preg_match($pword_pattern, $password)) {
    $_SESSION["register_error"] = "Password does not meet required complexity";
    header("Location: ".$return_location);
    exit;
}

// Validate email format
$email_pattern = "/^[A-Za-z0-9._\-]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$/";
if (!preg_match($email_pattern, $email)) {
    $_SESSION["register_error"] = "Invalid e-mail format";
    header("Location: ".$return_location);
    exit;
}

// Check if user is already in the database
$store_db->connect();
$exists = $store_db->checkUserExists($email);
$store_db->disconnect();
if ($exists) {
    $_SESSION["register_error"] = "A user with that e-mail already exists";
    header("Location: ".$return_location);
    exit;
}

// Validate password
if (!$password) {  //TODO: Could use some extra validation
    $_SESSION["register_error"] = "Account and password do not match";
    header("Location: ".$return_location);
    exit;
}

// Store user data
$password_hashed = password_hash($password, PASSWORD_DEFAULT);  // Hash password for security
$store_db->connect();
$store_db->addUser($email, $password_hashed, $isadmin);
$store_db->disconnect();

$_SESSION["register_success"] = true;
unset($_SESSION["register_error"]);
header("Location: ".$return_location);

 