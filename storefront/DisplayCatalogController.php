<?php

include "StoreDB.php";


function getCatalogJSON() {
    $store_db = new StoreDB();

    $store_db->connect();
    $catalog_data = $store_db->getCatalog();
    $store_db->disconnect();

    return json_encode($catalog_data);
}

header("Content-Type: application/json;charset=utf8;");
echo getCatalogJSON();