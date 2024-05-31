<?php

session_start();

include "StoreDB.php";


$id_user = $_SESSION["user_id"];

function getCatalogJSON($id_user) {
    $store_db = new StoreDB();

    $store_db->connect();
    $catalog_data = $store_db->getCatalog($id_user);
    $store_db->disconnect();
    
    // error_log(json_encode($catalog_data));  //DEBUG
    return json_encode($catalog_data);
}

header("Content-Type: application/json;charset=utf8;");
echo getCatalogJSON($id_user);