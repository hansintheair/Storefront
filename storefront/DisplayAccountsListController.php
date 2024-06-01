<?php

session_start();

include "StoreDB.php";

function getUsersJSON() {
    $store_db = new StoreDB();

    $store_db->connect();
    $users_data = $store_db->getUsers();
    $store_db->disconnect();
    
    // error_log(json_encode($catalog_data));  //DEBUG
    return json_encode($users_data);
}

header("Content-Type: application/json;charset=utf8;");
echo getUsersJSON();