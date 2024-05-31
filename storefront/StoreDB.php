<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of db_access
 *
 * @author hanne
 */
class StoreDB {

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "storefront";
    private $db;
    
    function connect() {
        $this->db = new mysqli(
            $this->servername,
            $this->username,
            $this->password,
            $this->db_name
        );
        
//        echo "Connecting to ".$this->db_name."... ";
        
        // Check connection
//        if ($this->db->connect_error) {
//            die("Connection failed<br>".$this->db->connect_error);
//        }
        
//        echo "Succeeded<br>";
    }
    
    function disconnect() {
        
//        echo "Disconnecting from ".$this->db_name."... ";

        if (!$this->db) {
//            echo "Nothing to disconnect.<br>";
            return;
        }
        
//        if ($this->db->close()) {
//            echo "Succeeded<br>";
//        }
//        else {
//            echo "Failed<br>";
//        }
    }
    
    function checkUserExists($email) {
        $query = "
        SELECT 
            *
        FROM
            `".$this->db_name."`.`entity_users` AS `entity_users`
        WHERE
            `email` = '".$email."'";
        return (bool)$this->db->query($query)->fetch_assoc();
    }
    
    function getUser($email) {
        $query = "
        SELECT 
            `id_user` AS `USER_UID`,
            `email` AS `EMAIL`,
            `password` AS `PASSWORD`,
            `type` AS `TYPE`
        FROM
            `".$this->db_name."`.`entity_users` AS `entity_users`
        WHERE
            `email` = '".$email."'";
        return $this->db->query($query)->fetch_assoc();
    }
    
    function setUserEmailByID($id_user, $email) {
        $query = "
        UPDATE 
                `".$this->db_name."`.`entity_users` 
        SET 
            `email` = '".$email."'
        WHERE
            `id_user` = '".$id_user."'";
        $this->db->query($query);
    }
    
    function setUserPwordByID($id_user, $new_password) {
        $query = "
        UPDATE
            `".$this->db_name."`.`entity_users` 
        SET 
            `password` = '".$new_password."'
        WHERE
            `id_user` = '".$id_user."'";
        $this->db->query($query);
    }
    
    function getUserByID($id_user) {
        $query = "
        SELECT 
            `id_user` AS `USER_UID`,
            `email` AS `EMAIL`,
            `password` AS `PASSWORD`,
            `type` AS `TYPE`
        FROM
            `".$this->db_name."`.`entity_users` AS `entity_users`
        WHERE
            `id_user` = '".$id_user."'";
        return $this->db->query($query)->fetch_assoc();
    }
    
    function delUserById($id_user) {
        $query = "
        DELETE FROM
                `".$this->db_name."`.`entity_users`
        WHERE
                `id_user` = '".$id_user."'";
        $this->db->query($query);
    }
    
    function addUser($email, $password, $type) {
        $query = "
        INSERT INTO
                `".$this->db_name."`.`entity_users` (`email`, `password`, `type`)
        VALUES
                ('".$email."', '".$password."', '".$type."')";
        $this->db->query($query);
    }
    
    function getCatalog($id_user) {
        $query = "
        SELECT 
            `entity_items`.`id_item` AS `ID_ITEM`, 
            `entity_items`.`name` AS `NAME`, 
            `entity_items`.`desc` AS `DESC`, 
            `entity_catalogitems`.`price` AS `PRICE`, 
            `entity_catalogitems`.`quant` AS `STOCK`,
            CASE
                WHEN `entity_cartitems`.`id_item` IS NOT NULL THEN true
                ELSE false
            END AS `IN_CART`
        FROM 
            `".$this->db_name."`.`entity_items` AS `entity_items`
        JOIN 
            `".$this->db_name."`.`entity_catalogitems` AS `entity_catalogitems`
            ON `entity_catalogitems`.`id_catalogitem` = `entity_items`.`id_catalogitem`
        LEFT JOIN 
            `".$this->db_name."`.`entity_cartitems` AS `entity_cartitems`
            ON `entity_cartitems`.`id_item` = `entity_items`.`id_item`
            AND `entity_cartitems`.`id_cartitem` IN (
                SELECT `id_cartitem` FROM `storefront`.`xref_users_cartitems` WHERE `id_user` = '".$id_user."'
            )
        WHERE 
            `entity_catalogitems`.`id_catalogitem` = `entity_items`.`id_catalogitem`
        ORDER BY
            `entity_items`.`name`";
//        error_log(json_encode($this->db->query($query)->fetch_all(MYSQLI_ASSOC)));  //DEBUG
        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
    }
    
    function setCatalogItem($id_item, $name, $desc, $price, $quant) {
        $query = "
        UPDATE 
            `".$this->db_name."`.`entity_catalogitems` 
        SET 
            `price` = '".$price."',
            `quant` = '".$quant."'
        WHERE
            `id_catalogitem` = '".$id_item."'";
        $this->db->query($query);
        
        $query = "
        UPDATE 
            `".$this->db_name."`.`entity_items` 
        SET 
            `name` = '".$name."',
            `desc` = '".$desc."'
        WHERE
            `id_item` = '".$id_item."'";
        $this->db->query($query);
    }
    
    function setCatalogItemQuant($id_item, $quant) {
        $query = "
        UPDATE 
            `".$this->db_name."`.`entity_catalogitems` 
        SET 
            `quant` = '".$quant."'
        WHERE
            `id_catalogitem` = '".$id_item."'";
        $this->db->query($query);
    }
    
    function setItemCatalogReference($id_item) {
        $query = "
        UPDATE 
            `".$this->db_name."`.`entity_items` 
        SET 
            `id_catalogitem` = '".$id_item."'
        WHERE
            `id_item` = '".$id_item."'";
        $this->db->query($query);
    }
    
    function delItemInCatalog($id_item) {

//        error_log("IN delItemInCart");  //DEBUG
        
        // Delete cart item record in the entity_cartitems table
        $query = "
        DELETE FROM 
            `".$this->db_name."`.`entity_catalogitems`
        WHERE 
            `id_catalogitem` = '".$id_item."'";
//        error_log("QUERY1: ".$query);  //DEBUG
        $this->db->query($query);
        
        // Delete the cross reference record in the xref_users_cartitems table
        $query = "
        DELETE FROM
            `".$this->db_name."`.`entity_items`
        WHERE
            `id_item` = '".$id_item."'";
//        error_log("QUERY2: ".$query);  //DEBUG
        $this->db->query($query);
    }
    
    function addItemToCatalog($name, $desc, $price, $quant) {
        
        // Check if item by that name is already in the catalog
//        if ($this->checkItemInCatalog($name)) {
////            error_log("THAT ITEM ALREADY EXISTS");  //DEBUG
//            return;
//        }
        
        // Insert a new item record into the entity_items table
        $query = "
        INSERT INTO
            `".$this->db_name."`.`entity_items` (`name`, `desc`)
        VALUES
            ('".$name."', '".$desc."')";
        $this->db->query($query);
        
        // Get id of inserted item
        $id_item = $this->db->insert_id;
        
        // Set id_catalogitem (to same as id_item)
        $this->setItemCatalogReference($id_item);
        
        // Insert a new catalogitem record into the entity_catalogitems table
        $query = "
        INSERT INTO
            `".$this->db_name."`.`entity_catalogitems` (`id_catalogitem`, `price`, `quant`)
        VALUES
            ('".$id_item."', '".$price."', '".$quant."')";
        $this->db->query($query);
    }
    
    function getCart($id_user) {
        $query = "
        SELECT 
            `entity_cartitems`.`id_cartitem` AS `ID_CARTITEM`,
            `entity_items`.`id_item` AS `ID_ITEM`,
            `entity_items`.`name` AS `NAME`,
            `entity_items`.`desc` AS `DESC`,
            `entity_catalogitems`.`price` AS `PRICE`,
            `entity_catalogitems`.`quant` AS `STOCK`,
            `entity_cartitems`.`quant` AS `QUANT`
        FROM
            `".$this->db_name."`.`xref_users_cartitems` AS `xref_users_cartitems`,
            `".$this->db_name."`.`entity_users` AS `entity_users`,
            `".$this->db_name."`.`entity_cartitems` AS `entity_cartitems`,
            `".$this->db_name."`.`entity_items` AS `entity_items`,
            `".$this->db_name."`.`entity_catalogitems` AS `entity_catalogitems`
        WHERE
            `entity_users`.`id_user` = '".$id_user."'
                AND `xref_users_cartitems`.`id_user` = `entity_users`.`id_user`
                AND `entity_cartitems`.`id_cartitem` = `xref_users_cartitems`.`id_cartitem`
                AND `entity_items`.`id_item` = `entity_cartitems`.`id_item`
                AND `entity_catalogitems`.`id_catalogitem` = `entity_items`.`id_catalogitem`
        ORDER BY
            `entity_items`.`name`";
        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
    }
    
    function getItemInCart($id_user, $id_item) {
        $query = "
        SELECT 
            `entity_cartitems`.`id_cartitem` AS `ID_CARTITEM`,
            `entity_items`.`id_item` AS `ID_ITEM`,
            `entity_items`.`name` AS `NAME`,
            `entity_items`.`desc` AS `DESC`,
            `entity_catalogitems`.`price` AS `PRICE`,
            `entity_catalogitems`.`quant` AS `STOCK`,
            `entity_cartitems`.`quant` AS `QUANT`
        FROM
            `".$this->db_name."`.`xref_users_cartitems` AS `xref_users_cartitems`,
            `".$this->db_name."`.`entity_users` AS `entity_users`,
            `".$this->db_name."`.`entity_cartitems` AS `entity_cartitems`,
            `".$this->db_name."`.`entity_items` AS `entity_items`,
            `".$this->db_name."`.`entity_catalogitems` AS `entity_catalogitems`
        WHERE
            `entity_users`.`id_user` = '".$id_user."'
                AND `entity_cartitems`.`id_item` = '".$id_item."'
                AND `xref_users_cartitems`.`id_user` = `entity_users`.`id_user`
                AND `entity_cartitems`.`id_cartitem` = `xref_users_cartitems`.`id_cartitem`
                AND `entity_items`.`id_item` = `entity_cartitems`.`id_item`
                AND `entity_catalogitems`.`id_catalogitem` = `entity_items`.`id_catalogitem`";
        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
    }
    
    function checkItemInCart($id_user, $id_item) {
        $query = "
        SELECT 
            *
        FROM
            `".$this->db_name."`.`xref_users_cartitems` AS `xref_users_cartitems`,
            `".$this->db_name."`.`entity_users` AS `entity_users`,
            `".$this->db_name."`.`entity_cartitems` AS `entity_cartitems`,
            `".$this->db_name."`.`entity_items` AS `entity_items`,
            `".$this->db_name."`.`entity_catalogitems` AS `entity_catalogitems`
        WHERE
            `entity_users`.`id_user` = '".$id_user."'
                AND `entity_cartitems`.`id_item` = '".$id_item."'
                AND `xref_users_cartitems`.`id_user` = `entity_users`.`id_user`
                AND `entity_cartitems`.`id_cartitem` = `xref_users_cartitems`.`id_cartitem`
                AND `entity_items`.`id_item` = `entity_cartitems`.`id_item`
                AND `entity_catalogitems`.`id_catalogitem` = `entity_items`.`id_catalogitem`";
        return (bool)$this->db->query($query)->fetch_assoc();
    }
    
    function delItemInCart($id_cartitem) {

//        error_log("IN delItemInCart");  //DEBUG
        
        // Delete cart item record in the entity_cartitems table
        $query = "
        DELETE FROM 
            `".$this->db_name."`.`entity_cartitems`
        WHERE 
            `id_cartitem` = '".$id_cartitem."'";
//        error_log("QUERY1: ".$query);  //DEBUG
        $this->db->query($query);
        
        // Delete the cross reference record in the xref_users_cartitems table
        $query = "
        DELETE FROM
            `".$this->db_name."`.`xref_users_cartitems`
        WHERE
            `id_cartitem` = '".$id_cartitem."'";
//        error_log("QUERY2: ".$query);  //DEBUG
        $this->db->query($query);
    }
    
    function addItemToCart($id_user, $id_item, $quant) {
        
        // Check if item is already in the user's cart
        if ($this->checkItemInCart($id_user, $id_item)) {
//            error_log("THAT ITEM ALREADY EXISTS");  //DEBUG
            return;
        }
        
        // Insert a new cart item record into the entity_cartitems table
        $query = "
        INSERT INTO
            `".$this->db_name."`.`entity_cartitems` (`id_item`, `quant`)
        VALUES
            ('".$id_item."', '".$quant."')";
        $this->db->query($query);
        
        // Get id of inserted item
        $id_cartitem = $this->db->insert_id;
        
        // Insert a cross reference record into the xref_users_cartitems table
        $query = "
        INSERT INTO
            `".$this->db_name."`.`xref_users_cartitems` (`id_user`, `id_cartitem`)
        VALUES
            ('".$id_user."', '".$id_cartitem."')";
        $this->db->query($query);
    }
    
    function setCartItemQuant($id_cartitem, $quant) {
        $query = "
        UPDATE 
            `".$this->db_name."`.`entity_cartitems` 
        SET 
            `quant` = '".$quant."'
        WHERE
            `id_cartitem` = '".$id_cartitem."'";
        $this->db->query($query);
    }
    
    function getOrders($id_user) {
        $query = "
        SELECT 
            `entity_orders`.`id_order` AS `ID_ORDER`,
            `entity_orders`.`order_date` AS `ORDER_DATE`
        FROM
            `".$this->db_name."`.`xref_users_orders` AS `xref_users_orders`,
            `".$this->db_name."`.`entity_users` AS `entity_users`,
            `".$this->db_name."`.`entity_orders` AS `entity_orders`
        WHERE
            `entity_users`.`id_user` = '".$id_user."'
            AND `xref_users_orders`.`id_user` = `entity_users`.`id_user`
            AND `entity_orders`.`id_order` = `xref_users_orders`.`id_order`";
        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
}

    function getOrderItems($id_user, $id_order) {
        $query = "
        SELECT 
            `xref_orders_orderitems`.`id_orderitem` AS `ID_ORDERITEM`,
            `entity_orderitems`.`id_item` AS `ID_ITEM`,
            `entity_items`.`name` AS `NAME`,
            `entity_items`.`desc` AS `DESC`,
            `entity_orderitems`.`price_per_unit` AS `PRICE`,
            `entity_orderitems`.`quant` AS `QUANT`
        FROM
            `".$this->db_name."`.`xref_users_orders` AS `xref_users_orders`,
            `".$this->db_name."`.`entity_users` AS `entity_users`,
            `".$this->db_name."`.`xref_orders_orderitems` AS `xref_orders_orderitems`,
            `".$this->db_name."`.`entity_orderitems` AS `entity_orderitems`,
            `".$this->db_name."`.`entity_items` AS `entity_items`
        WHERE
            `entity_users`.`id_user` = '".$id_user."'
                AND `xref_orders_orderitems`.`id_order` =  '".$id_order."'
                AND `xref_users_orders`.`id_user` = `entity_users`.`id_user`
                AND `xref_orders_orderitems`.`id_order` = `xref_users_orders`.`id_order`
                AND `entity_orderitems`.`id_orderitem` = `xref_orders_orderitems`.`id_orderitem`
                AND `entity_items`.`id_item` = `entity_orderitems`.`id_item`";
        return $this->db->query($query)->fetch_all(MYSQLI_ASSOC);
    }
    
    function addItemToOrder($id_order, $id_item, $quant, $price) {
               
        // Insert a new cart item record into the entity_cartitems table
        $query = "
        INSERT INTO
            `".$this->db_name."`.`entity_orderitems` (`id_item`, `quant`, `price_per_unit`)
        VALUES
            ('".$id_item."', '".$quant."', '".$price."')";
        $this->db->query($query);
        
        // Get id of inserted item
        $id_orderitem = $this->db->insert_id;
        
        // Insert a cross reference record into the xref_orders_orderitems table
        $query = "
        INSERT INTO
            `".$this->db_name."`.`xref_orders_orderitems` (`id_order`, `id_orderitem`)
        VALUES
            ('".$id_order."', '".$id_orderitem."')";
        $this->db->query($query);
    }
    
    function addOrder($id_user, $order_date) {
        $query = "
        INSERT INTO
            `".$this->db_name."`.`entity_orders` (`order_date`)
        VALUES
            ('".$order_date."')";
        $this->db->query($query);
        
        // Get id of inserted order
        $id_order = $this->db->insert_id;
        
        // Insert a cross reference record into the xref_users_cartitems table
        $query = "
        INSERT INTO
            `".$this->db_name."`.`xref_users_orders` (`id_user`, `id_order`)
        VALUES
            ('".$id_user."', '".$id_order."')";
        $this->db->query($query);
        
        return $id_order;
    }
    
    function placeOrder($id_user) {
//        error_log("IN StoreDB.placeOrder");  //DEBUG

        $cart_items = $this->getCart($id_user);

        if (empty($cart_items)) {
            return false;
        }
        
        $datetime = new DateTime("now", new DateTimeZone('UTC'));
        $datetime_str = $datetime->format('Y-m-d H:i:s');
        $id_order = $this->addOrder($id_user, $datetime_str);

//        $i = 0;  //DEBUG
//        echo "<br>";  //DEBUG
        foreach($cart_items as $cart_item) {
//            echo "[".$i."]<br>";  //DEBUG
            $id_item = $cart_item["ID_ITEM"];
//            echo "id_item: ".$id_item."<br>";  //DEBUG
            $id_cartitem = $cart_item["ID_CARTITEM"];
//            echo "id_cartitem: ".$id_cartitem."<br>";  //DEBUG
            $quant = $cart_item["QUANT"];
//            echo "quant: ".$quant."<br>";  //DEBUG
            $price= $cart_item["PRICE"];
//            echo "price: ".$price."<br>";  //DEBUG
            $stock = $cart_item["STOCK"];
//            echo "stock: ".$stock."<br>";  //DEBUG
            $new_stock = $stock - $quant;
//            echo "new_stock: ".$new_stock."<br>";  //DEBUG
//            $i++;  //DEBUG
            
            $this->addItemToOrder($id_order, $id_item, $quant, $price);
            $this->delItemInCart($id_cartitem);
            $this->setCatalogItemQuant($id_item, $new_stock);
        }
        return true;
    }
    
}
