<?php

include "StoreDB.php";

session_start();

$id_user = $_SESSION["user_id"];

// Sanitize for security
$id_item = filter_input(INPUT_POST, 'id_item', FILTER_SANITIZE_STRING);
$quant = filter_input(INPUT_POST, 'quant', FILTER_SANITIZE_STRING);

function addItemToCart($id_user, $id_item, $quant) {
//    error_log("IN addItemToCart");
    $store_db = new StoreDB();

    $store_db->connect();
    $store_db->addItemToCart($id_user, $id_item, $quant);
    $store_db->disconnect();
}