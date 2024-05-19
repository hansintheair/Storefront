<?php
session_start();

include "StoreDB.php";

$store_db = new StoreDB();
 
// Sanitize for security
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

//echo "email: ".$email."<br>";  //DEBUG
//echo "PASSWORD: ".$password."<br>";  //DEBUG
 
// Verify user credentials and redirect
$userdata;
 if ($email && $password) {
     $store_db->connect();
     $userdata = $store_db->getUser($email);
     $store_db->disconnect();     
    if ($userdata["EMAIL"] == $email && password_verify($password, $userdata["PASSWORD"])) {
        $_SESSION["login_error"] = "WOHOO! PASSWORD VERIFIED!";  //DEBUG
        header("Location: Home.php");  //DEBUG
//        header("Location: User.php");  //NOT IMPLEMENTED
        exit;
    }
 }
$_SESSION["login_error"] = "Invalid email or password";
header("Location: Home.php");

