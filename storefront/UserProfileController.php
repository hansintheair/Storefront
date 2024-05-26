<?php

session_start();

include "StoreDB.php";


$uid = $_SESSION["user_id"];

function getUserDataJSON($uid) {
    $store_db = new StoreDB();

    $store_db->connect();
    $user_data = $store_db->getUserByID($uid);
    $store_db->disconnect();

    return json_encode($user_data);
}

header("Content-Type: application/json;charset=utf8;");
echo getUserDataJSON($uid);