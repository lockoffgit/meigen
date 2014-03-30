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
        
        function getMeigenList($page_no = 0){
            $page_no = isset($_REQUEST['page_no']) ? ($_REQUEST['page_no'] * LIST_MAX) : 0;

            $query = "
            SELECT
                mei.*
                ,(
                    SELECT
                            COUNT(x.iotw_id)
                        FROM
                            iotws x
                        WHERE
                            x.meigen_id = mei.meigen_id
                ) AS iotw_cnt
                ,(
                    SELECT
                            COUNT(x.delete_id)
                        FROM
                            deletes x
                        WHERE
                            x.meigen_id = mei.meigen_id
                ) AS delete_cnt
                ,COALESCE(
                    mei.image_url
                    ,mem.image_url
                ) AS meigen_image_url
            FROM
                meigens AS mei LEFT OUTER JOIN members mem
                    ON (
                    mei.member_id = mem.member_id
                )
            ORDER BY
                mei.modified_at DESC
                LIMIT " . $page_no . ", " . LIST_MAX . "
            ";

            $arrMeigens = $this->select($query);
            return $arrMeigens;
        }
        
        /**
         * 
         * @param integer $member_id
         * @return array
         */
        function getMeigenData($member_id = 0){

            $query = "
            SELECT
                mei.*
                ,(
                    SELECT
                            COUNT(x.iotw_id)
                        FROM
                            iotws x
                        WHERE
                            x.meigen_id = ?
                ) AS iotw_cnt
                ,(
                    SELECT
                            COUNT(x.delete_id)
                        FROM
                            deletes x
                        WHERE
                            x.meigen_id = ?
                ) AS delete_cnt
                ,(
                    SELECT
                            COUNT(x.try_id)
                        FROM
                            tries x
                        WHERE
                            x.meigen_id = ?
                ) AS tries_cnt
                ,COALESCE(
                    mei.image_url
                    ,mem.image_url
                ) AS meigen_image_url
            FROM
                meigens AS mei LEFT OUTER JOIN members mem
                    ON (
                    mei.member_id = mem.member_id
                )
            WHERE
                mei.meigen_id = ?
            ";

            $arrMeigens = $this->select($query, array($member_id, $member_id, $member_id, $member_id));
            return $arrMeigens[0];
        }
    }
    
?>
