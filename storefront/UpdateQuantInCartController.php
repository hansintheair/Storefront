<?php

include "StoreDB.php";

session_start();

$id_user = $_SESSION["user_id"];

// Sanitize for security
$id_cartitem = filter_input(INPUT_POST, 'id_cartitem', FILTER_SANITIZE_STRING);
$quant = filter_input(INPUT_POST, 'quant', FILTER_SANITIZE_STRING);

error_log("ID_CARTITEM: ".$id_cartitem);  //DEBUG
error_log("QUANT: ".$quant);  //DEBUG

function updateQuantInCart($id_cartitem, $quant) {
//    error_log("IN addItemToCart");
    $store_db = new StoreDB();

    $store_db->connect();
    $store_db->setCartItemQuant($id_cartitem, $quant);
    $store_db->disconnect();
}

updateQuantInCart($id_cartitem, $quant);