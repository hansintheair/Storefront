<?php

include "StoreDB.php";

session_start();

$id_user = $_SESSION["user_id"];

// Sanitize for security
$name = filter_input(INPUT_POST, 'item_name', FILTER_SANITIZE_STRING);
$desc = filter_input(INPUT_POST, 'item_desc', FILTER_SANITIZE_STRING);
$price = filter_input(INPUT_POST, 'item_price', FILTER_SANITIZE_STRING);
$quant = filter_input(INPUT_POST, 'item_quant', FILTER_SANITIZE_STRING);

error_log("NAME: ".$name);  //DEBUG
error_log("DESC: ".$desc);  //DEBUG
error_log("PRICE: ".$price);  //DEBUG
error_log("QUANT: ".$quant);  //DEBUG

function addCatalogItem($name, $desc, $price, $quant) {
    // error_log("IN addItemToCart");  //DEBUG
    $store_db = new StoreDB();

    $store_db->connect();
    
    if ($store_db->checkItemInCatalog($name)) {
        $_SESSION["catalog_add_error"] = "Item already exists";
        header("Location: AdminCatalog.php");
       exit;
    }
    
    $store_db->addItemToCatalog($name, $desc, $price, $quant);
    $store_db->disconnect();
}

addCatalogItem($name, $desc, $price, $quant);

$_SESSION["catalog_add_success"] = true;
unset($_SESSION["catalog_add_error"]);
header("Location: AdminCatalog.php");