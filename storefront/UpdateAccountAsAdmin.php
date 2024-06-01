// DISABLED

<?php

//session_start();
//
//include "StoreDB.php";
//
//// Sanitize for security
//$id_user = filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_STRING);
//$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
//
//// Validate email format
//$email_pattern = "/^[A-Za-z0-9._\-]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$/";
//if (!preg_match($email_pattern, $email)) {
//    $_SESSION["email_update_error"] = "invalid e-mail format";
//    header("Location: AdminAccountsManager.php");
//    exit;
//}
//
//$store_db = new StoreDB();
//
//// Save user profile data
//$store_db->connect();
//$store_db->setUserEmailByID($id_user, $email);
//$store_db->disconnect();
//
//
//$_SESSION["email_update_success"] = true;
//unset($_SESSION["email_update_error"]);
//header("Location: AdminAccountsManager.php");