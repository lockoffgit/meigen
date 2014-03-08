<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    require_once("core.php");
    /*
    $objDb = new db_util();
    $objDb->insert("items", array("id" => "321", "price" => "1234"));
    $objDb->select("SELECT * FROM items WHERE id > ?", array("1"));
     */
    class db_util{
        var $db;
        
        function db_util(){
            $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8';
            $this->db = new PDO($dsn, DB_USER, DB_PASSWORD);
        }
        
        function query($query, $params){
            $stmt = $this->db->prepare($query);
            return($stmt->execute($params));
        }
  
        function select($query, $params=array('')){
            $stmt = $this->db->prepare($query);
            if(count($params) > 0 ) {
                $stmt->execute($params);
            }
            if($result = $stmt->fetchAll()){
                return $result;
            }else{
                return array();
            }
        }        

        function insert($table, $addParams){
            if(count($addParams) == 0 ) return false;
            
            $set = implode(",", array_keys($addParams));
            $val = array_values($addParams);
            $prepare = rtrim(str_repeat('?,', count($addParams)), ',');
            $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", $table, $set, $prepare);
            $cmd = $this->db->prepare($sql);
            return $cmd->execute($val);
        }
        
    }
    
?>
