<?php

session_start();

include "StoreDB.php";


$uid = $_SESSION["user_id"];

function getCartJSON($uid) {
    $store_db = new StoreDB();

    $store_db->connect();
    $cart_data = $store_db->getCart($uid);
    $store_db->disconnect();

    return json_encode($cart_data);
}

header("Content-Type: application/json;charset=utf8;");
echo getCartJSON($uid);