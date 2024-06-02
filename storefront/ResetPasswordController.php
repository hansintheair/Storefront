<?php

session_start();

include "StoreDB.php";


// Sanitize for security
$id_user = filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_STRING);
$res_password = filter_input(INPUT_POST, 'res_password', FILTER_SANITIZE_STRING);

$store_db = new StoreDB();

$password_hashed = password_hash($res_password, PASSWORD_DEFAULT);  // Hash password for security
$store_db->connect();
$store_db->setUserPwordByID($id_user, $password_hashed);
$store_db->disconnect();

$_SESSION["password_update_success"] = true;
header("Location: AdminAccountsManager.php");

