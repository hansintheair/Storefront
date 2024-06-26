<?php


include "StoreDB.php";


function getOrderHistoryJSON() {
    $store_db = new StoreDB();

    $store_db->connect();
    $data = $store_db->getAllOrders();
    $store_db->disconnect();

    return json_encode($data);
}

header("Content-Type: application/json;charset=utf8;");
echo getOrderHistoryJSON();