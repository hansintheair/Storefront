<?php

session_start();

include "StoreDB.php";


$id_user = $_SESSION["user_id"];

function getCartJSON($id_user) {
    $store_db = new StoreDB();

    $store_db->connect();
    $cart_data = $store_db->getCart($id_user);
    $store_db->disconnect();

    return json_encode($cart_data);
}

header("Content-Type: application/json;charset=utf8;");
echo getCartJSON($id_user);