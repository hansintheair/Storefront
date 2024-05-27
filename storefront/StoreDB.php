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

        error_log("IN delItemInCart");  //DEBUG
        
        // Delete cart item record in the entity_cartitems table
        $query = "
        DELETE FROM 
            `".$this->db_name."`.`entity_cartitems`
        WHERE 
            `id_cartitem` = '".$id_cartitem."'";
//        error_log("QUERY1: ".$query);
        $this->db->query($query);
        
        // Delete the cross reference record in the xref_users_cartitems table
        $query = "
        DELETE FROM
            `".$this->db_name."`.`xref_users_cartitems`
        WHERE
            `id_cartitem` = '".$id_cartitem."'";
        error_log("QUERY2: ".$query);
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

}
