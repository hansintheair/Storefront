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
        
        echo "Connecting to ".$this->db_name."... ";
        
        // Check connection
        if ($this->db->connect_error) {
            die("Connection failed<br>".$this->db->connect_error);
        }
        
        echo "Succeeded<br>";
    }
    
    function disconnect() {
        
        echo "Disconnecting from ".$this->db_name."... ";

        if (!$this->db) {
            echo "Nothing to disconnect.<br>";
            return;
        }
        
        if ($this->db->close()) {
            echo "Succeeded<br>";
        }
        else {
            echo "Failed<br>";
        }
    }
    
    function getUser($username) {
        $query = "SELECT `id_user` AS `USER_UID`, `username` AS `USERNAME`, `first_name` AS `FIRST_NAME`, `middle_name` AS `MIDDLE_NAME`, `last_name` AS `LAST_NAME`, `email` AS `EMAIL`, `password` AS `PASSWORD` FROM `storefront`.`entity_users` AS `entity_users` WHERE `username` = '".$username."'";
    
        return $result = $this->db->query($query)->fetch_assoc();
    }
    
    

}
