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
        $query = "SELECT * FROM `".$this->db_name."`.`entity_users` AS `entity_users` WHERE `email` = '".$email."'";

        return (bool)$this->db->query($query)->fetch_assoc();
    }
    
    function getUser($email) {
        $query = "SELECT `id_user` AS `USER_UID`, `email` AS `EMAIL`, `password` AS `PASSWORD`, `type` AS `TYPE` FROM `".$this->db_name."`.`entity_users` AS `entity_users` WHERE `email` = '".$email."'";
    
        return $this->db->query($query)->fetch_assoc();
    }
    
    function setUserEmailByID($uid, $email) {
        $query = "UPDATE `".$this->db_name."`.`entity_users` SET `email`='".$email."' WHERE `id_user` = '".$uid."'";
        
        $this->db->query($query);
    }
    
    function setUserPwordByID($uid, $new_password) {
        $query = "UPDATE `".$this->db_name."`.`entity_users` SET `password`='".$new_password."' WHERE `id_user` = '".$uid."'";
        
        $this->db->query($query);
    }
    
    function getUserByID($uid) {
        $query = "SELECT `id_user` AS `USER_UID`, `email` AS `EMAIL`, `password` AS `PASSWORD`, `type` AS `TYPE` FROM `".$this->db_name."`.`entity_users` AS `entity_users` WHERE `id_user` = '".$uid."'";
        
        return $this->db->query($query)->fetch_assoc();
    }
    
    function addUser($email, $password, $type) {
        $query = "INSERT INTO `".$this->db_name."`.`entity_users` (`email`, `password`, `type`) VALUES ('".$email."', '".$password."', '".$type."')";
        
        $this->db->query($query);
    }
    
    function getCatalog() {
        $query = "SELECT `entity_items`.`name` AS `NAME`, `entity_items`.`desc` AS `DESC`, `entity_catalogitems`.`price` AS `PRICE`, `entity_catalogitems`.`quant` AS `QUANT` FROM `".$this->db_name."`.`entity_catalogitems` AS `entity_catalogitems`, `".$this->db_name."`.`entity_items` AS `entity_items` WHERE `entity_catalogitems`.`id_catalogitem` = `entity_items`.`id_catalogitem`";
        
        return $this->db->query($query)->fetch_all();
    }

}
