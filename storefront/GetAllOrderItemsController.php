<?php

include "StoreDB.php";


function getAllOrderItemsJSON() {
    $store_db = new StoreDB();

    $store_db->connect();
    $cart_data = $store_db->getAllOrderItems();
    $store_db->disconnect();

    return json_encode($cart_data);
}

header("Content-Type: application/json;charset=utf8;");
echo getAllOrderItemsJSON();