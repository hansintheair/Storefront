<?php

include "StoreDB.php";

session_start();

$id_user = $_SESSION["user_id"];

echo "IN PlaceOrderController.php";

function placeOrder($id_user) {
    $store_db = new StoreDB();

    $store_db->connect();
    $store_db->placeOrder($id_user);
    $store_db->disconnect();
}

placeOrder($id_user);