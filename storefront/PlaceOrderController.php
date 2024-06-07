<?php

include "StoreDB.php";

session_start();

$id_user = $_SESSION["user_id"];

echo "IN PlaceOrderController.php";

function placeOrder($id_user) {
    $store_db = new StoreDB();

    $store_db->connect();
    
    error_log("CART IS EMPTY: ".$store_db->isCartEmpty($id_user));
    
    if ($store_db->isCartEmpty($id_user)) {
        $_SESSION["is_empty"] = "Cart is empty";
         header("Location: UserCart.php");
         exit;
    }
    
    $store_db->placeOrder($id_user);
    $store_db->disconnect();
}

placeOrder($id_user);

$_SESSION["order_placed"] = true;
unset($_SESSION["is_empty"]);
header("Location: UserCart.php");