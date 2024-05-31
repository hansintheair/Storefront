<?php

include "StoreDB.php";

session_start();

$id_user = $_SESSION["user_id"];

// Sanitize for security
$id_item= filter_input(INPUT_POST, 'id_item', FILTER_SANITIZE_STRING);

error_log("ID_ITEM: ".$id_item);  //DEBUG

function delCatalogItem($id_item) {
    // error_log("IN addItemToCart");  //DEBUG
    $store_db = new StoreDB();

    $store_db->connect();
    $store_db->delItemInCatalog($id_item);
    $store_db->disconnect();
}

delCatalogItem($id_item);

header("Location: AdminCatalog.php");