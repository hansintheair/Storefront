<?php

include "StoreDB.php";

session_start();

$id_user = $_SESSION["user_id"];

// Sanitize for security
$id_item = filter_input(INPUT_POST, 'id_item', FILTER_SANITIZE_STRING);
$name = filter_input(INPUT_POST, 'item_name', FILTER_SANITIZE_STRING);
$desc = filter_input(INPUT_POST, 'item_desc', FILTER_SANITIZE_STRING);
$price = filter_input(INPUT_POST, 'item_price', FILTER_SANITIZE_STRING);
$quant = filter_input(INPUT_POST, 'item_quant', FILTER_SANITIZE_STRING);

error_log("ID_ITEM: ".$id_item);  //DEBUG
error_log("NAME: ".$name);  //DEBUG
error_log("DESC: ".$desc);  //DEBUG
error_log("PRICE: ".$price);  //DEBUG
error_log("QUANT: ".$quant);  //DEBUG

function updateCatalogItem($id_item, $desc, $price, $quant) {
    // error_log("IN addItemToCart");  //DEBUG
    $store_db = new StoreDB();

    $store_db->connect();
    $store_db->setCatalogItem($id_item, $desc, $price, $quant);
    $store_db->disconnect();
}

updateCatalogItem($id_item, $desc, $price, $quant);

header("Location: AdminCatalog.php");