<?php

session_start();

include "StoreDB.php";

$store_db = new StoreDB();

// Sanitize for security
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);

//echo "PASSWORD: ".$password."<br>";  //DEBUG
//echo "EMAIL: ".$email."<br>";  //DEBUG

// Validate password complexity
$pword_pattern = "((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,20})";
if (!preg_match($pword_pattern, $password)) {
    $_SESSION["register_error"] = "password does not meet required complexity";
    header("Location: CreateAccount.php");
    exit;
}

// Validate email format
$email_pattern = "^[_A-Za-z0-9-]+(\.[_A-Za-z0-9-]+)*@[A-Za-z0-9]+(\.[A-Za-z0-9]+)*(\.[A-Za-z]{2,})$";
if (!preg_match($email_pattern, $email)) {
    $_SESSION["register_error"] = "invalid e-mail format";
    header("Location: CreateAccount.php");
    exit;
}

// Check if user is already in the database
$store_db->connect();
$exists = $store_db->checkUserExists($email);
$store_db->disconnect();
if ($exists) {
    $_SESSION["register_error"] = "A user with that e-mail already exists";
    header("Location: CreateAccount.php");
    exit;
}

// Validate password
if (!$password) {  //TODO: Could use some extra validation
    $_SESSION["register_error"] = "Account and password do not match";
    header("Location: CreateAccount.php");
    exit;
}

// Store user data
$password_hashed = password_hash($password, PASSWORD_DEFAULT);  // Hash password for security
$store_db->connect();
$store_db->addUser($email, $password_hashed);
$store_db->disconnect();

$_SESSION["register_success"] = true;
$_SERVER["register_error"] = "";
header("Location: CreateAccount.php");

 