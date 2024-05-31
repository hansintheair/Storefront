<?php

session_start();

include "StoreDB.php";


$id_user = $_SESSION["user_id"];

error_log("IN DisplayOrderHistoryItemsController.php");

// Sanitize for security
$id_order = filter_input(INPUT_POST, 'id_order', FILTER_SANITIZE_STRING);

error_log("ID_ORDER: ".$id_order);  //DEBUG
error_log("ID_ORDER: ".$id_user);  //DEBUG

function getOrderHistoryItemsJSON($id_user, $id_order) {
    $store_db = new StoreDB();

    $store_db->connect();
    $order_data = $store_db->getOrderItems($id_user, $id_order);
    $store_db->disconnect();

    return json_encode($order_data);
}

header("Content-Type: application/json;charset=utf8;");
echo getOrderHistoryItemsJSON($id_user, $id_order);
