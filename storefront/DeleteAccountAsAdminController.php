<?php

include "StoreDB.php";


$store_db = new StoreDB();

// Sanitize for security
$id_user = filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_STRING);

// Delete account
$store_db->connect();
$store_db->delUserById($id_user);
$store_db->disconnect();

include 'AdminAccountsManager.php';