<?php
session_start();

include "StoreDB.php";

$store_db = new StoreDB();
 
// Sanitize for security
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

//echo "USERNAME: ".$username."<br>";  //DEBUG
//echo "PASSWORD: ".$password."<br>";  //DEBUG

// Hash password for security
$password_hashed;
if ($password) {
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
}

//echo "PASSWORD HASHED: ".$password_hashed."<br>";  //DEBUG
 
// Only now check database
$userdata;
 if ($password_hashed) {
     $store_db->connect();
     $userdata = $store_db->getUser($username);
     $store_db->disconnect();
     
     
    if ($userdata["USERNAME"] == $username && $userdata["PASSWORD"] == $password) {

        $_SESSION["login_error"] = "FOUND ".$username."<br>";
        header("Location: Home.php");
    }
    $_SESSION["login_error"] = "Incorrect username or password";
    header("Location: Home.php");
 }

