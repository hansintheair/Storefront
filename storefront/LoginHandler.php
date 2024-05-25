<?php
session_start();

include "StoreDB.php";

$store_db = new StoreDB();
 
// Sanitize for security
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

//echo "email: ".$email."<br>";  //DEBUG
//echo "PASSWORD: ".$password."<br>";  //DEBUG
 
// Verify user credentials
$store_db->connect();
$userdata = $store_db->getUser($email);
$store_db->disconnect();     
if (!($userdata["EMAIL"] == $email && password_verify($password, $userdata["PASSWORD"]))) {
    $_SESSION["login_error"] = "Invalid email or password";
    header("Location: Home.php");
   exit;
}

// Login redirect
// User login
if ($userdata["TYPE"] == 0) {
    $_SESSION["user_id"] = $userdata["USER_UID"];
    header("Location: UserCatalog.php");
}
// Admin login
else {
    //header("Location: Admin.php");  //NOT IMPLEMENTED
}

