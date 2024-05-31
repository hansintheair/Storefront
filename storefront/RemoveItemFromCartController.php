<?php

include "StoreDB.php";

session_start();

$id_user = $_SESSION["user_id"];

// Sanitize for security
$id_cartitem = filter_input(INPUT_POST, 'id_cartitem', FILTER_SANITIZE_STRING);

function removeItemFromCart($id_cartitem) {
//    error_log("IN addItemToCart");  //DEBUG
    $store_db = new StoreDB();

    $store_db->connect();
    $store_db->delItemInCart($id_cartitem);
    $store_db->disconnect();
}

removeItemFromCart($id_cartitem);