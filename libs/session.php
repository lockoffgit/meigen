<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    /*
    $objDb = new db_util();
    $objDb->insert("items", array("id" => "321", "price" => "1234"));
    $objDb->select("SELECT * FROM items WHERE id > ?", array("1"));
     */
    class session_util{
        
        function __construct() {
            session_start();
        }
        
        function setSession($key, $val){
            $_SESSION[$key] = $val;
            return true;
        }
        
        function getSession($key){
            if(isset($_SESSION[$key])) {
                return $_SESSION[$key];
            }
        }
        
        function deleteSession($key) {
            if(isset($_SESSION[$key])) {
                unset($_SESSION[$key]);
                return true;
            }
            return false;
        }
        
    }
